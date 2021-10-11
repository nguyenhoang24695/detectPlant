<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Category
 * 
 * @property int $id
 * @property string $category_name
 * @property int $category_type
 * @property int $is_grow
 * @property string|null $image
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 *
 * @package App\Models
 */
class Category extends Model
{
	use SoftDeletes;
	protected $table = 'category';

	protected $casts = [
		'category_type' => 'int',
		'is_grow' => 'int'
	];

	protected $fillable = [
		'category_name',
		'category_type',
		'is_grow',
		'image'
	];
}
