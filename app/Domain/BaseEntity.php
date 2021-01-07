<?php

namespace App\Domain;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Throwable;
use Exception;

/**
 * Clase BaseEntity es la clase principal de las entidades del Dominio que necesiten integrarse con eloquent
 * @package App\Domain
 * @author kevocde <kevocde@gmail.com>
 * @version 0.0.0
 *
 * @property string createdAt Momento de creación
 * @property string updatedAt Momento de ùltima actualización
 * @property string deletedAt Momento de eliminado
 *
 * @method static string getEloquentClass Retorna la referencia completa de la clase Eloquent
 *
 * @see IEloquentService
 */
class BaseEntity
{
    const PER_PAGE = 20;

    public $createdAt;
    public $updatedAt;
    public $deletedAt;
    protected $model;

    /**
     * Retorna la instancia del modelo
     * @return Model
     */
    public function getModel(): Model
    {
        return $this->model;
    }

    /**
     * Crea una instancia de la entidad a partir de un modelo eloquent
     * @param Model $model
     * @return BaseEntity
     *
     * @throws Throwable
     */
    public static function createFrom(Model $model): BaseEntity
    {
        $instance = new static;
        $instance->loadDataFromModel($model);

        return $instance;
    }

    /**
     * Carga la información del modelo eloquent a la entidad
     * @param Model $model
     *
     * @throws Throwable
     */
    public function loadDataFromModel(Model $model)
    {
        throw_if(
            ! is_a($model, $this::getEloquentClass()),
            Exception::class,
            ['No es posible cargar los datos de un modelo eloquent diferente al definido para la clase.']
        );

        $this->model = $model;

        foreach ($model->getAttributes() as $key => $value) {
            $name = str_replace(' ', '', lcfirst(ucwords(mb_strtolower(str_replace('_', ' ', $key)))));
            if (property_exists($this, $name)) $this->{$name} = $value;
        }
    }

    /**
     * Retorna el listado de todos los recursos a partir del modelo relacionado
     * @param int|null $perPage
     * @return LengthAwarePaginator
     */
    public static function listAll(int $perPage = null): LengthAwarePaginator
    {
        $perPage = $perPage ?? self::PER_PAGE;
        return call_user_func_array([static::getEloquentClass(), 'paginate'], [$perPage]);
    }

    /**
     * Carga por el indentificador del modelo la instancia, adicional de retornar un error en caso de no encontrar el recurso
     * @param int $id Identificador del recurso
     * @return BaseEntity
     *
     * @throws Throwable
     */
    public static function findOrFail(int $id): BaseEntity
    {
        try {
            $instance = call_user_func_array([static::getEloquentClass(), 'findOrFail'], [$id]);
        } catch (Exception $ex) {
            throw new Exception('No se han encontrado el recurso solicitado.');
        }

        return static::createFrom($instance);
    }
}
