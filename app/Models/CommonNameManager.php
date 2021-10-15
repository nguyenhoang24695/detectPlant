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



	protected $casts = [
		'id' => 'int',
		'protect_product_group_id' => 'int',
	];

	protected $fillable = [
		'protect_product_group_id',
		'common_name'
	];
}
