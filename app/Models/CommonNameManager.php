<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CommonNameManager
 * 
 * @property int $id
 * @property int|null $group_id
 * @property int|null $common_name_id
 * @property string|null $common_name
 *
 * @package App\Models
 */
class CommonNameManager extends Model
{
	protected $table = 'common_name_manager';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'group_id' => 'int',
		'common_name_id' => 'int'
	];

	protected $fillable = [
		'group_id',
		'common_name_id',
		'common_name'
	];
}
