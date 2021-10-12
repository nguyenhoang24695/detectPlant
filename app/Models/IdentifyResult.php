<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class IdentifyResult
 *
 * @property int $id
 * @property int|null $identify_user_id
 * @property string|null $scientific_name
 * @property float|null $probability
 * @property int|null $type
 * @property int|null $source
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 *
 * @package App\Models
 */
class IdentifyResult extends Model
{
	use SoftDeletes;
	protected $table = 'identify_result';


	protected $casts = [
		'id' => 'int',
		'identify_user_id' => 'int',
		'probability' => 'float',
		'type' => 'int',
		'source' => 'string'
	];

	protected $fillable = [
		'identify_user_id',
		'scientific_name',
		'probability',
		'type',
		'source'
	];
}
