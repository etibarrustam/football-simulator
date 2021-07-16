<?php

namespace App\Http\Repositories;

use App\Models\Team;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class TeamRepository.
 *
 * @package App\Http\Repositories
 * @author Etibar Rustamzada <etibar.rustem@gmail.com>
 */
class TeamRepository extends AbstractRepository
{
    /**
     * TeamRepository constructor.
     *
     * @param Team $model
     */
    public function __construct(Team $model)
    {
        parent::__construct($model);
    }

    /**
     * @param array $weekIds
     * @return Builder[]|Collection
     */
    public function getByWeek(array $weekIds)
    {
        return $this->model->with([
            'matches' => function ($match) use ($weekIds) {
                return $match->whereIn('week_id', $weekIds);
            }
        ])->get();
    }
}
