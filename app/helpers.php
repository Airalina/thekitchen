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
        'role.name' => 'required|string|min:3',
        'dataPermissions.permissionsSelected' => 'required',
        'dataPermissions.permissionsSelected.*' => 'required',
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
    $validation = array_merge($validationClients, $validationDelivery);
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

function validateProviders()
{
    $regex = '/^((?:www\.)(?:[-a-z0-9]+\.)*[-a-z0-9]+.*)$/';
    return [
        'provider.name' => 'required|string|min:10',
        'provider.email' => 'required|email',
        'provider.address' => 'nullable|string|min:6',
        'provider.cuit' => 'required|numeric|min:1000000|max:100000000',
        'provider.phone' => 'nullable|numeric|min:1000000000',
        'provider.status' => 'nullable|boolean',
        'provider.url' => 'nullable|regex: ' . $regex
    ];
}

function validateAdmixtures()
{
    return [
        'admixture.code' => 'required|max:20',
        'admixture.name' => 'nullable',
        'admixture.description' => 'nullable|max:500',
        'admixture.replace_id' => 'nullable',
        'admixture.stock' => 'nullable',
        'admixture.type' => 'nullable',
        'fruit' => 'sometimes',
        'fruit.classification' => 'required_if:type,1|nullable|numeric|integer',
        'fruit.preparation' => 'required_if:type,1|nullable|numeric|integer',
        'vegetable' => 'sometimes',
        'vegetable.type' => 'required_if:type,2|nullable|numeric|integer',
        'vegetable.derivation' => 'nullable',
        'meat' => 'sometimes',
        'meat.type' => 'numeric|required_if:type,3|nullable|numeric|integer',
        'meat.conservation' => 'nullable'
    ];
}
