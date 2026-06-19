<?php

declare(strict_types=1);

return [
    'welcome_user' => [
        'title' => 'Welcome to :appName',
        'content_1' => 'Your account has been successfully created!',
        'content_2' => 'Your login details are your email address and the following password: <b>:password</b>. Please change it as soon as possible.',
    ],
    'account_activation' => [
        'title' => 'Welcome to :appName',
        'content_1' => 'Your account has been activated ! You can now log in.',
        'content_2' => 'Your account has been activated !',
    ],
    'user_create_comment' => [
        'title' => 'A new comment is written for article :title',
        'content' => 'A new comment has been written by subscriber :name. Please check it in your account.',
        'action' => 'View comment',
    ],
    'user_entry_content' => [
        'title' => 'A new content item has been added',
        'content' => 'A new item has been added to the content ":contentModelTitle" by a user. Please check it in your account.',
        'action' => 'View content',
    ],
];
