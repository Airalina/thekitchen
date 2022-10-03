<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vegetable extends Model
{
    use HasFactory;
    use SoftDeletes;

    CONST TYPES = ['Raíces', 'Bulbos', 'Hojas', 'Tallos'];

    protected $fillable = [
        'type',
        'derivation'
    ];

    public function type()
    {
        return $this->morphOne(AdmixtureType::class, 'typeable');
    }
}
