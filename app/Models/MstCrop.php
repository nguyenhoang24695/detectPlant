<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class MstCrop
 *
 * @property int $id
 * @property string|null $common_name
 * @property string|null $scientific_name
 * @property string|null $family
 * @property string|null $symbol
 * @property string|null $synonym_symbol
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 *
 * @package App\Models
 */
class MstCrop extends Model
{
	use SoftDeletes;
	protected $table = 'mst_crop';


	protected $casts = [
		'id' => 'int'
	];

	protected $fillable = [
		'common_name',
		'scientific_name',
		'family',
		'symbol',
		'synonym_symbol'
	];
}
