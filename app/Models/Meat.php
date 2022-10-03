<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Meat extends Model
{
    use HasFactory;
    use SoftDeletes;

    CONST TYPE = ['Vacuno', 'Ave', 'Cerdo'];    
    
    protected $fillable = [
        'type',
        'conservation'
    ];

    public function type()
    {
        return $this->morphOne(AdmixtureType::class, 'typeable');
    }
}
