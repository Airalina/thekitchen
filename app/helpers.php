<?php

function validateUsers()
{
    return [
        'user.username' => 'required|string|min:5',
        'user.name' => 'required|string|min:10',
        'user.email' => 'required|email',
        'user.domicile' => 'required|string|min:6',
        'user.dni' => 'required|numeric|min:1000000|max:100000000',
        'user.phone' => 'required|numeric|min:1000000000',
        'user.password' => 'required|min:8|confirmed',
        'user.roles' => 'required|array'
    ];
}

