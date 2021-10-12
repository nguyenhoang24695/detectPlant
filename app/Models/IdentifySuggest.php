<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class IdentifySuggest
 *
 * @property int $id
 * @property int|null $identify_user_id
 * @property string|null $scientific_name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 *
 * @package App\Models
 */
class IdentifySuggest extends Model
{
	use SoftDeletes;
	protected $table = 'identify_suggest';

	protected $casts = [
		'id' => 'int',
		'identify_user_id' => 'int'
	];

	protected $fillable = [
		'identify_user_id',
		'scientific_name'
	];
}
