<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class CropCategoryStage
 *
 * @property int $id
 * @property int|null $crop_id
 * @property int|null $category_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 *
 * @package App\Models
 */
class CropCategoryStage extends Model
{
	use SoftDeletes;
	protected $table = 'crop_category_stage';


	protected $casts = [
		'id' => 'int',
		'crop_id' => 'int',
		'category_id' => 'int'
	];

	protected $fillable = [
		'crop_id',
		'category_id'
	];
}
