<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class IdentifyUser
 * 
 * @property int $id
 * @property int|null $user_id
 * @property int|null $image
 * @property int|null $latitude
 * @property int|null $longitude
 * @property float|null $air_temperature
 * @property int|null $crop_indentify_status
 * @property int|null $pathogen_indentify_status
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 *
 * @package App\Models
 */
class IdentifyUser extends Model
{
	use SoftDeletes;
	protected $table = 'identify_user';
	public $timestamps = false;

	protected $casts = [
		'user_id' => 'int',
		'image' => 'int',
		'latitude' => 'int',
		'longitude' => 'int',
		'air_temperature' => 'float',
		'crop_indentify_status' => 'int',
		'pathogen_indentify_status' => 'int'
	];

	protected $fillable = [
		'user_id',
		'image',
		'latitude',
		'longitude',
		'air_temperature',
		'crop_indentify_status',
		'pathogen_indentify_status'
	];
}
