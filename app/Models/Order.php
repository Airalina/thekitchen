<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory;   
    use SoftDeletes;

    protected $fillable = [
        'customer_id',
        'deliverydomicile_id',
        'end_date',
        'start_date',
        'date',
        'status',
        'total_usd_price',
    ];
}
