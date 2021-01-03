<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Modelo Eloquent para la gestión de la tabla EntityPart
 *
 * @package App\Entities
 * @author kevocde <kevocde@gmail.com>
 * @version 0.0.0
 *
 * @property int entity_part_id
 * @property int cloud_id
 * @property int entity_id
 * @property string name
 * @property string path
 * @property string created_at
 * @property string updated_at
 * @property string deleted_at
 * @property Entity entity
 * @property Cloud cloud
 */
class EntityPart extends BaseModel
{
    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'entity_part_id';

    /**
     * @var array
     */
    protected $fillable = ['cloud_id', 'entity_id', 'name', 'path'];

    /**
     * @return BelongsTo
     */
    public function entity(): BelongsTo
    {
        return $this->belongsTo('App\Entities\Entity', 'entity_id', 'entity_id');
    }

    /**
     * @return BelongsTo
     */
    public function cloud(): BelongsTo
    {
        return $this->belongsTo('App\Entities\Cloud', 'cloud_id', 'cloud_id');
    }
}
