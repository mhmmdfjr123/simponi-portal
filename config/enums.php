<?php

/**
 * @author efriandika
 */
return [

    /*
    |--------------------------------------------------------------------------
    | ATTENTION
    |--------------------------------------------------------------------------
    |
    | Be carefully when updating this value, because it can damage your data.
    | Watch the maximal value.
    | Any question ? ask me: efriandika@gmail.com
    |
    */

    /*
    |--------------------------------------------------------------------------
    | Used by table: account
    | Max value: 3 Char
    |--------------------------------------------------------------------------
    */
    'user' => [
        'status' => [
            'active' => 'Y',
            'not_active' => 'N'
        ],
        'gender' => [
            'male' => 'M',
            'female' => 'F'
        ]
    ],

    /*
    |--------------------------------------------------------------------------
    | ATTENTION
    |--------------------------------------------------------------------------
    |
    | Be carefully when updating this value, because it can damage your data.
    | Watch the maximal value.
    | Any question ? ask me: efriandika@gmail.com
    |
    */

    'acl' => [
        'role' => [
            'super-administrator'   => 'super-administrator',
            'publisher'             => 'publisher'
        ]
    ],
];
