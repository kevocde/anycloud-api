<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Clase BaseModel modelo base de todos los modelos eloquent de la aplicación
 * @package App\Entities
 * @author kevocde <kevocde@gmail.com>
 * @version 0.0.0
 *
 * @method static LengthAwarePaginator paginate(int $perPage)
 * @method static Model find(int $id)
 * @method static Model findOrFail(int $id)
 */
class BaseModel extends Model
{
}
