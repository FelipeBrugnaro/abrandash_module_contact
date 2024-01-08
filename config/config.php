<?php

return [
    'name' => 'Contact',

    'routes' => [
        'index'   => 'admin.site_contact.index',
        'show'    => 'admin.site_contact.show',
        'reply'   => 'admin.site_contact.reply',
        'show'    => 'admin.site_contact.show',

        'update'  => 'admin.site_contact.update',
        'delete' => 'admin.site_contact.destroy',
        'completed' => 'admin.site_contact.completed',

        'replies' => 'admin.site_contact.replies.index',
    ],
];
