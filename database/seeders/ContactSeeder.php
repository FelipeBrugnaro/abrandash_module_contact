<?php

namespace Modules\Contact\database\seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\{Menu, Permission, Widget};
use Carbon\Carbon;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $contact = Menu::create([
            'title'  => 'contact::lang',
            'pai'    => 4,
            'code'   => 'site_contact',
            'route'  => 'admin.site_contact.index',
            'icon'   => 'message',
            'module' => 'Contact',
            'order'  => 4,
            'status' => true
        ]);

        $permission = Permission::insert([
            ['title' => 'REPLY_CONTACT', 'module' => 'Contact'],
            ['title' => 'REPLIES_HISTORIC_CONTACT', 'module' => 'Contact'],
            ['title' => 'DELETE_CONTACT', 'module' => 'Contact'],
            ['title' => 'WIDGET_LAST_CONTACT', 'module' => 'Contact'],
        ]);

        $widget = Widget::insert([
            [
                'widget' => 'Modules\Contact\app\Widgets\LastContacts',
                'title'  => 'contact::lang.widgets.title',
                'permission' => 'WIDGET_LAST_CONTACT',
                'module' => 'Contact',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]
        ]);
    }
}
