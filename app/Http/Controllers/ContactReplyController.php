<?php

namespace Modules\Contact\app\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Contact\app\Models\ContactReply;

class ContactReplyController
{

    public function index(Request $request, ContactReply $reply)
    {

        if(!Auth::user()->permission('REPLIES_HISTORIC_CONTACT')){
            return redirect()
                ->route(config('contact.routes.index'))
                ->withInput()
                ->with('toast', [
                    'level'   => 'warning',
                    'message' => textLang('action_not_permitted', 'messages')
            ]); 
        }

        $qnt = $request->qnt ?? 10;

        $replies = $reply->orderBy('id', 'ASC')
            ->paginate($qnt)
            ->withQueryString();
        
        return view('contact::replies', [
            'replies' => $replies
        ]);
    }
}
