<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class CropPathogen
 * 
 * @property string $id
 * @property int|null $crop_id
 * @property int|null $pathoden_id
 * @property string|null $symptom
 * @property string|null $method_manual
 * @property string|null $method_mechanical
 * @property string|null $method_biological
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 *
 * @package App\Models
 */
class CropPathogen extends Model
{
	use SoftDeletes;
	protected $table = 'crop_pathogen';
	public $incrementing = false;

	protected $casts = [
		'crop_id' => 'int',
		'pathoden_id' => 'int'
	];

	protected $fillable = [
		'crop_id',
		'pathoden_id',
		'symptom',
		'method_manual',
		'method_mechanical',
		'method_biological'
	];
}
