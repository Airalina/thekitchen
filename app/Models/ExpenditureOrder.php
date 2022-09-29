<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExpenditureOrder extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'responsible',
        'follow_number',
        'origin',
        'reason',
        'status',
        'date',
        'hour',
        'client_id'
    ];
    
}
