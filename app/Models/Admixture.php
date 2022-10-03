<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Admixture extends Model
{
    use HasFactory;
    use SoftDeletes;

    CONST TYPES = [
        1 => [
            'name' => 'Frutas',
            'model' => 'fruit'
        ], 
        2 => [
            'name' => 'Hortalizas',
            'model' => 'vegetable'
        ],
        3 => [
            'name' => 'Carnes',
            'model' => 'meat'
        ]
    ];

    protected $fillable = [
        'code',
        'description',
        'name',
        'replace_id',
        'stock',
        'type_id',
    ];

    public static function search($search = '', $orderBy = 'id')
    {
        return self::where('code', 'LIKE', '%' . $search . '%')
            ->orWhere('description', 'LIKE', '%' . $search . '%')
            ->orWhere('name', 'LIKE', '%' . $search . '%')
            ->orderBy($orderBy);
    }

    public static function scopeSearchReplaces($query, $key)
    {  
        $type = self::TYPES[$key];
        dd($key);
        return $query->where('family', $key)->has(self::TYPES[$key]);
    }

    public function admixtureType()
    {
        return $this->belongsTo(AdmixtureType::class, 'type_id');
    }
}
