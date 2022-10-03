<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdmixtureType extends Model
{
    use HasFactory;

    public function typeable()
    {
        return $this->morphTo();
    }

    public function admixture()
    {
        return $this->hasOne(Admixture::class, 'type_id');
    }
}
