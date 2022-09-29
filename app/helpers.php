<?php

function validateUsers($view = '')
{
    return [
        'user.username' => 'required|string|min:5',
        'user.name' => 'required|string|min:10',
        'user.email' => 'required|email',
        'user.domicile' => 'required|string|min:6',
        'user.dni' => 'required|numeric|min:1000000|max:100000000',
        'user.phone' => 'required|numeric|min:1000000000',
        'user.password' => 'required_if:view,create|min:8|confirmed',
        'user.rols' => 'required|array'
    ];
}

function validateRoles()
{
    return [
        'role.name'=>'required|string|min:3',
        'dataPermissions.permissionsSelected'=>'required',
        'dataPermissions.permissionsSelected.*'=>'required',
    ];
}

function validateClients()
{
    $validationClients = [
        'client.name' => 'required|string|min:10',
        'client.email' => 'required|email',
        'client.address' => 'nullable|string|min:6',
        'client.cuit' => 'required|numeric|min:1000000|max:100000000',
        'client.phone' => 'nullable|numeric|min:1000000000',
        'client.status' => 'nullable|boolean',
    ];
    $validationDelivery = validateDeliveryAddresses();
    $validation= array_merge($validationClients, $validationDelivery);
    return $validation;
}            

function validateDeliveryAddresses()
{
    return [
        'deliveryAddress.location' => 'required|string|min:4|max:30',
        'deliveryAddress.province' => 'required|string|min:4|max:30',
        'deliveryAddress.country' => 'required|string|min:3|max:30',
        'deliveryAddress.postcode' => 'required|integer|min:1|max:100000',
    ];
}     