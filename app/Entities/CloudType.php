<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Modelo Eloquent para la gestión de la tabla CloudType
 *
 * @package App\Entities
 * @author kevocde <kevocde@gmail.com>
 * @version 0.0.0
 *
 * @property int cloud_type_id
 * @property string name
 * @property string created_at
 * @property string updated_at
 * @property string deleted_at
 * @property Cloud[] clouds
 */
class CloudType extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'cloud-types';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'cloud_type_id';

    /**
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * @return HasMany
     */
    public function clouds(): HasMany
    {
        return $this->hasMany('App\Entities\Cloud', 'cloud_type_id', 'cloud_type_id');
    }
}
