<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Combo extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'code',
        'date',
        'description',
        'usd_price',
        'customer_id',
    ];
}
