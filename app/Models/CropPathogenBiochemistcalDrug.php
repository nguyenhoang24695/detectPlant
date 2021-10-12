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
 * @property int|null $crop_pathogen_id
 * @property int|null $crop_protection_product
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
	protected $table = 'crop_pathogen_biochemical_drug';


	protected $casts = [
		'id' => 'int',
		'crop_pathogen_id' => 'int',
		'crop_protection_product_id' => 'int',
		'type' => 'int'
	];

	protected $fillable = [
		'crop_pathogen_id',
		'crop_protection_product_id',
		'type'
	];
}
