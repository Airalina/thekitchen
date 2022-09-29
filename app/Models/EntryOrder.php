<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EntryOrder extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'buy_order_id',
        'follow_number',
        'origin',
        'reason',
        'date',
        'hour'
    ];
}
