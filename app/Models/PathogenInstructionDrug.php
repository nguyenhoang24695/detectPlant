<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class PathogenInstructionDrug
 * 
 * @property int $id
 * @property int|null $pathogen_id
 * @property int|null $instruction_drug_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 *
 * @package App\Models
 */
class PathogenInstructionDrug extends Model
{
	use SoftDeletes;
	protected $table = 'pathogen_instruction_drug';
	public $incrementing = false;

	protected $casts = [
		'id' => 'int',
		'pathogen_id' => 'int',
		'instruction_drug_id' => 'int'
	];

	protected $fillable = [
		'pathogen_id',
		'instruction_drug_id'
	];
}
