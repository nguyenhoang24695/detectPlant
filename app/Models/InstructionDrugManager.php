<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class InstructionDrugManager
 *
 * @property int $id
 * @property string|null $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 *
 * @package App\Models
 */
class InstructionDrugManager extends Model
{
	use SoftDeletes;
	protected $table = 'instruction_drug_manager';


	protected $casts = [
		'id' => 'int'
	];

	protected $fillable = [
		'name'
	];
}
