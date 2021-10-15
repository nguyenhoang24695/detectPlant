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
 * @property int|null $priority_flag
 *
 * @package App\Models
 */
class CropPathogenBiochemicalDrug extends Model
{
	use SoftDeletes;
	protected $table = 'crop_pathogen_biochemical_drug';


	protected $casts = [
		'id' => 'int',
		'pathogen_id' => 'int',
		'crop_protection_product_id' => 'int',
		'type' => 'int',
		'priority_flag' => 'int'
	];

	protected $fillable = [
		'pathogen_id',
		'crop_protection_product_id',
		'type',
        'priority_flag'
	];
}
