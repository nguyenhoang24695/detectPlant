<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlantData extends Model
{
    protected $table = 'plant_data';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'symbol',
        'synonym_symbol',
        'scientific_name_with_author',
        'common_name',
        'family',
    ];
}
