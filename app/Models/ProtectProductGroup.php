<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ProtectProductGroup
 *
 * @property int|null $id
 * @property string|null $group_name
 * @property int|null $parent_id
 *
 * @package App\Models
 */
class ProtectProductGroup extends Model
{
	protected $table = 'protect_product_group';



	protected $casts = [
		'id' => 'int',
		'parent_id' => 'int'
	];

	protected $fillable = [
		'id',
		'group_name',
		'parent_id'
	];
}
