<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Modelo Eloquent para la gestión de la tabla Driver
 *
 * @package App\Entities
 * @author kevocde <kevocde@gmail.com>
 * @version 0.0.0
 *
 * @property int driver_id
 * @property string name
 * @property string created_at
 * @property string updated_at
 * @property string deleted_at
 * @property Entity[] entities
 */
class Driver extends BaseModel
{
    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'driver_id';

    /**
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * @return HasMany
     */
    public function entities(): HasMany
    {
        return $this->hasMany('App\Entities\Entity', 'driver_id', 'driver_id');
    }
}
