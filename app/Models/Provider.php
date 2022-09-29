<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Provider extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'name',
        'address',
        'cuit',
        'phone',
        'email',
        'site_url',
        'status',
    ];
}
