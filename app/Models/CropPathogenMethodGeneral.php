<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class CropPathogenMethodGeneral
 * 
 * @property int $id
 * @property int|null $crop_category_stage_id
 * @property int|null $mst_method_general_id
 * @property string|null $content
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 *
 * @package App\Models
 */
class CropPathogenMethodGeneral extends Model
{
	use SoftDeletes;
	protected $table = 'crop_pathogen_method_general';

	protected $casts = [
		'crop_category_stage_id' => 'int',
		'mst_method_general_id' => 'int'
	];

	protected $fillable = [
		'crop_category_stage_id',
		'mst_method_general_id',
		'content'
	];
}
