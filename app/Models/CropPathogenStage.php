<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class CropPathogenStage
 *
 * @property int $id
 * @property int|null $crop_pathogen_id
 * @property int|null $crop_category_stage_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 *
 * @package App\Models
 */
class CropPathogenStage extends Model
{
	use SoftDeletes;
	protected $table = 'crop_pathogen_stage';

	protected $casts = [
		'crop_pathogen_id' => 'int',
		'category_id' => 'int'
	];

	protected $fillable = [
		'crop_pathogen_id',
		'category_id'
	];
}
