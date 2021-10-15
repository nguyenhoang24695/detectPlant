<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class CropManager
 *
 * @property int $id
 * @property string $crop_name
 * @property string|null $science_name
 * @property int $field_group
 * @property int status
 * @property string|null $introduce
 * @property string|null $icon
 * @property string|null $image
 * @property string|null $host
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 *
 * @package App\Models
 */
class CropManager extends Model
{
	use SoftDeletes;
	protected $table = 'crop_manager';

	protected $casts = [
		'field_group' => 'int',
		'status' => 'int'
	];

	protected $fillable = [
		'crop_name',
		'science_name',
		'field_group',
		'introduce',
		'icon',
		'image',
		'host',
		'status'
	];
}
