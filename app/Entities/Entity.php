<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Modelo Eloquent para la gestión de la tabla Entity
 *
 * @package App\Entities
 * @author kevocde <kevocde@gmail.com>
 * @version 0.0.0
 *
 * @property int entity_id
 * @property int driver_id
 * @property int parent_entity_id
 * @property string type
 * @property string original_name
 * @property string alias
 * @property string created_at
 * @property string updated_at
 * @property string deleted_at
 * @property Driver driver
 * @property Entity parentEntity
 * @property Entity[] childEntities
 * @property EntityPart[] entityParts
 */
class Entity extends BaseModel
{
    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'entity_id';

    /**
     * @var array
     */
    protected $fillable = ['driver_id', 'parent_entity_id', 'type', 'original_name', 'alias'];

    /**
     * @return BelongsTo
     */
    public function driver(): BelongsTo
    {
        return $this->belongsTo('App\Entities\Driver', 'driver_id', 'driver_id');
    }

    /**
     * @return BelongsTo
     */
    public function parentEntity(): BelongsTo
    {
        return $this->belongsTo('App\Entities\Entity', 'parent_entity_id', 'entity_id');
    }

    /**
     * @return HasMany
     */
    public function childEntities(): HasMany
    {
        return $this->HasMany('App\Entities\Entity', 'entity_id', 'parent_entity_id');
    }

    /**
     * @return HasMany
     */
    public function entityParts(): HasMany
    {
        return $this->hasMany('App\Entities\EntityPart', 'entity_id', 'entity_id');
    }
}
