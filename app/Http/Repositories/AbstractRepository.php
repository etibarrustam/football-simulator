<?php

namespace App\Http\Repositories;

use Illuminate\Database\Eloquent\Model;

/**
 * Class AbstractRepository.
 *
 * @package  App\Http\Repositories
 * @author   Etibar Rustamzada <etibar.rustem@gmail.com>
 */
abstract class AbstractRepository implements RepositoryInterface
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * Should be overridden on child classes.
     *
     * AbstractRepository constructor.
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @inheritDoc
     */
    public function create(array $data)
    {
        return $this->model::create($data);
    }

    /**
     * @inheritDoc
     */
    public function insert(array $data)
    {
        return $this->model::insert($data);
    }

    /**
     * @inheritDoc
     */
    public function update(int $id, array $params = [])
    {
        $record = $this->model::findOrFail($id);

        $record->update($params);

        return $record;
    }

    /**
     * @inheritDoc
     */
    public function delete(array $ids)
    {
        return $this->model::whereIn('id', $ids)->delete();
    }

    /**
     * @inheritDoc
     */
    public function findById(int $id)
    {
        return $this->model::findOrFail($id);
    }

    /**
     * @inheritDoc
     */
    public function all(array $params = [], array $relations = [], array $selects = ['*'])
    {
        $limit = $params['limit'] ?? RepositoryInterface::MAX_LIMIT;
        $collection = $this->model->select($selects)->limit($limit)->orderBy('id', "DESC");

        if ($relations) {
            $collection = $collection->with($relations);
        }
        if (array_key_exists('offset', $params)) {
            $collection = $collection->offset($params['offset']);
        }

        $collection = $collection->get();

        if (!$collection) {
            return null;
        }

        return $collection;
    }

    /**
     * @inheritDoc
     */
    public function count(array $params = [])
    {
        return $this->model->where($params)->count();
    }
}
