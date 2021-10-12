<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class ChecksumImage
 * 
 * @property int $id
 * @property int|null $identify_user_id
 * @property string|null $sha
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 *
 * @package App\Models
 */
class ChecksumImage extends Model
{
	use SoftDeletes;
	protected $table = 'checksum_image';

	protected $casts = [
		'identify_user_id' => 'int'
	];

	protected $fillable = [
		'identify_user_id',
		'sha'
	];
}
