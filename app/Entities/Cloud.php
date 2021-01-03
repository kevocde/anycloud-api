<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Modelo Eloquent para la gestión de la tabla Cloud
 *
 * @package App\Entities
 * @author kevocde <kevocde@gmail.com>
 * @version 0.0.0
 *
 * @property int cloud_id
 * @property int cloud_type_id
 * @property string created_at
 * @property string updated_at
 * @property string deleted_at
 * @property CloudType cloudType
 * @property EntityPart[] entityParts
 */
class Cloud extends BaseModel
{
    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'cloud_id';

    /**
     * @var array
     */
    protected $fillable = ['cloud_type_id'];

    /**
     * @return BelongsTo
     */
    public function cloudType(): BelongsTo
    {
        return $this->belongsTo('App\Entities\CloudType', 'cloud_type_id', 'cloud_type_id');
    }

    /**
     * @return HasMany
     */
    public function entityParts(): HasMany
    {
        return $this->hasMany('App\Entities\EntityPart', 'cloud_id', 'cloud_id');
    }
}
