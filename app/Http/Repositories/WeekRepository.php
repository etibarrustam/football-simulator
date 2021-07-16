<?php

namespace App\Http\Repositories;

use App\Models\Week;

/**
 * Class WeekRepository.
 *
 * @package App\Http\Repositories
 */
class WeekRepository extends AbstractRepository
{
    /**
     * WeekRepository constructor.
     *
     * @param Week $model
     */
    public function __construct(Week $model)
    {
        parent::__construct($model);
    }

    /**
     * @inheritDoc
     */
    public function all(array $params = [], array $relations = [], array $selects = ['*'])
    {
        if (array_key_exists('position_to', $params)) {
            $this->model = $this->model::where('position', '>=', $params['position_to']);
        }
        if (array_key_exists('position_from', $params)) {
            $this->model = $this->model::where('position', '<=', $params['position_from']);
        }
        if (array_key_exists('position', $params)) {
            $this->model = $this->model::where('position', $params['position']);
        }

        return parent::all($params, $relations, $selects);
    }

    /**
     * Get last week.
     *
     * @return mixed
     */
    public function getMaxPosition()
    {
        return $this->model->max('position');
    }
}
