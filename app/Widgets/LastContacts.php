<?php

namespace Modules\Contact\app\Widgets;

use Arrilot\Widgets\AbstractWidget;
use Modules\Contact\app\Models\Contact;

class LastContacts extends AbstractWidget
{

    public $reloadTimeout = 10;

    public function placeholder(): string
    {
        return 'Loading...';
    }

    public function run()
    {
        $contacts = Contact::where('status', 1)->orderBy('id', 'desc')->limit(3)->get();
        return view('contact::widgets.last_contacts', [
            'contacts' => $contacts,
            'config' => $this->config,
        ]);
    }
}