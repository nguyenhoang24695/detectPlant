<?php
/**
 * Created by WeatherPlus.
 * User: hoangnv
 * Date: 9/23/2021
 * Time: 2:36 PM
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class PlantPathogen extends Model
{
    protected $table = 'plant_pathogen';
    protected $primaryKey = 'id';
    protected $fillable = [
        'plant_id',
        'name',
        'name_en',
        'pathogen_class',
        'scientific_name',
    ];

}
