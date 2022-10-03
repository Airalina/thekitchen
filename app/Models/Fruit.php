<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fruit extends Model
{
    use HasFactory;
    use SoftDeletes;

    CONST CLASSIFICATIONS = ['citrica', 'tropical', 'del bosque', 'seco'];    
    CONST PREPARATIONS = ['Conservas', 'Mermeladas', 'Enlatados'];

    protected $fillable = [
        'classification',
        'preparation'
    ];

    public function type()
    {
        return $this->morphOne(AdmixtureType::class, 'typeable');
    }
}
