<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class MstPathogen
 * 
 * @property int $id
 * @property string|null $name
 * @property string|null $name_en
 * @property string|null $pathogen_class
 * @property string|null $scientific_name
 * @property string|null $cause
 * @property string|null $method_manual
 * @property string|null $method_mechanical
 * @property string|null $method_biological
 * @property string|null $method_general
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 *
 * @package App\Models
 */
class MstPathogen extends Model
{
	use SoftDeletes;
	protected $table = 'mst_pathogen';
	public $incrementing = false;

	protected $casts = [
		'id' => 'int'
	];

	protected $fillable = [
		'name',
		'name_en',
		'pathogen_class',
		'scientific_name',
		'cause',
		'method_manual',
		'method_mechanical',
		'method_biological',
		'method_general'
	];
}
