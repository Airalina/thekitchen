<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DeliveryAddress extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'id',
        'client_id',
        'country',
        'location',
        'postcode',
        'province',
    ];
}
