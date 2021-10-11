<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class CropPathogenBiochemistcalDrug
 * 
 * @property int $id
 * @property int|null $crop_pathoden_id
 * @property int|null $plant_protection_product
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property int|null $type
 *
 * @package App\Models
 */
class CropPathogenBiochemistcalDrug extends Model
{
	use SoftDeletes;
	protected $table = 'crop_pathogen_biochemistcal_drug';
	public $incrementing = false;

	protected $casts = [
		'id' => 'int',
		'crop_pathoden_id' => 'int',
		'plant_protection_product' => 'int',
		'type' => 'int'
	];

	protected $fillable = [
		'crop_pathoden_id',
		'plant_protection_product',
		'type'
	];
}
