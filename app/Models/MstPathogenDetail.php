<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class MstPathogenDetail
 * 
 * @property int $id
 * @property int|null $peat_id
 * @property string|null $alternative_treatment
 * @property string|null $bullet_points
 * @property string|null $chemical_treatment
 * @property string|null $default_image
 * @property string|null $eppo
 * @property string|null $pathogen_images
 * @property string|null $preventive_measures
 * @property string|null $spread_risk
 * @property string|null $stages
 * @property string|null $symptoms
 * @property string|null $trigger
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 *
 * @package App\Models
 */
class MstPathogenDetail extends Model
{
	use SoftDeletes;
	protected $table = 'mst_pathogen_detail';

	protected $casts = [
		'peat_id' => 'int'
	];

	protected $fillable = [
		'peat_id',
		'alternative_treatment',
		'bullet_points',
		'chemical_treatment',
		'default_image',
		'eppo',
		'pathogen_images',
		'preventive_measures',
		'spread_risk',
		'stages',
		'symptoms',
		'trigger'
	];
}
