<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class MstHostImage
 * 
 * @property int $id
 * @property int|null $peat_id
 * @property string|null $name
 * @property string|null $image_names
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 *
 * @package App\Models
 */
class MstHostImage extends Model
{
	use SoftDeletes;
	protected $table = 'mst_host_image';

	protected $casts = [
		'peat_id' => 'int'
	];

	protected $fillable = [
		'peat_id',
		'name',
		'image_names'
	];
}
