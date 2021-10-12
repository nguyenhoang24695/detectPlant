<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PlantProtectionProduct
 *
 * @property int $id
 * @property int|null $common_name_manager_id
 * @property string|null $common_name
 * @property string|null $trade_name
 * @property string|null $pest_crop
 * @property string|null $applicant
 * @property int|null $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $delated_at
 *
 * @package App\Models
 */
class CropProtectionProduct extends Model
{
    protected $table = 'crop_protection_product';

    protected $casts = [
        'common_name_manager_id' => 'int',
        'status' => 'int'
    ];


    protected $fillable = [
        'common_name_manager_id',
        'common_name',
        'trade_name',
        'pest_crop',
        'applicant',
        'status'
    ];
}
