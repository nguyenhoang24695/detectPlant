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
 * @property string|null $symptom
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
	public $incrementing = false;

	protected $casts = [
		'id' => 'int',
		'crop_pathogen_id' => 'int',
		'crop_category_stage_id' => 'int'
	];

	protected $fillable = [
		'crop_pathogen_id',
		'crop_category_stage_id',
		'symptom'
	];
}
