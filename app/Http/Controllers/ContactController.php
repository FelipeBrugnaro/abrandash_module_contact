<?php

namespace Modules\Contact\app\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Modules\Contact\app\Emails\ContactMail;
use Illuminate\Http\{Request, RedirectResponse};
use Modules\Contact\app\Models\{Contact, ContactReply};
use Modules\Contact\app\Http\Requests\ContactUpdateRequest;

class ContactController
{

    public function index(Request $request, Contact $contact)
    {

        $search = $request->search;
        $qnt = $request->qnt ?? 10;

        $contacts = $contact->where([
            ['message', 'like','%'.$search.'%'],
        ])->orderBy('id', 'ASC')->paginate($qnt)->withQueryString();

        foreach ($contacts as $key => $contact) {
            $contacts[$key]->completed_title = $contact->completed_id ? 'mark_not_completed' : 'mark_completed';
        }
        
        return view('contact::index', [
            'contacts' => $contacts
        ]);
    }

    public function show(Contact $contact)
    {

        return view('contact::show', [
            'contact' => $contact
        ]);
    }

    public function reply(Contact $contact)
    {

        if(!Auth::user()->permission('REPLY_CONTACT')){
            return redirect()
                ->back()
                ->withInput()
                ->with('toast', [
                    'level'   => 'warning',
                    'message' => textLang('action_not_permitted', 'messages')
            ]); 
        }

        return view('contact::reply', [
            'contact' => $contact
        ]);
    }

    // CREATE

    public function update(
        ContactUpdateRequest $request, 
        Contact $contact
    ) : RedirectResponse 
    {

        $email = Mail::to($contact->email)
            ->send(new ContactMail([
                'title'   => $request->title,
                'message' => $request->message
            ]));

        ContactReply::create([
            'contact_id' => $contact->id,
            'message'    => [
                'title'   => $request->title,
                'message' => $request->message,
            ],
            'user_id'    => Auth::user()->id,
        ]);

        if(!$email) {
            return redirect()
                ->back()
                ->withInput()
                ->with('toast', [
                    'level'   => 'warning',
                    'message' => textLang('reply_danger', 'contact::lang.messages')
            ]);
        }

        return redirect()
            ->route(config('contact.routes.index'))
            ->with('toast', [
                'level'   => 'success',
                'message' => textLang('reply_success', 'contact::lang.messages')
        ]);
    }

    // DELETE
    
    public function destroy(Contact $contact): RedirectResponse 
    {
        
        if(!$contact->delete()) {
            return redirect()
                ->back()
                ->with(['toast' => [
                    'level'   => 'danger',
                    'message' => textLang('delete_danger', 'contact::lang.messages')
            ]]);
        }

        return redirect()
            ->back()
            ->with(['toast' => [
                'level'   => 'success',
                'message' => textLang('delete_success', 'contact::lang.messages')
        ]]);
    }
    public function completed(Contact $contact): RedirectResponse 
    {

        $contact->completed_id = $contact->completed_id ? null : Auth::id();

        if(!$contact->save()) {
            return redirect()
                ->back()
                ->with(['toast' => [
                    'level'   => 'danger',
                    'message' => textLang('completed_danger', 'contact::lang.messages')
            ]]);
        }

        $return_message = $contact->completed_id ? 'completed_success' : 'not_completed_success';

        return redirect()
            ->back()
            ->with(['toast' => [
                'level'   =>'success',
                'message' => textLang($return_message, 'contact::lang.messages')
        ]]);
    }
}
