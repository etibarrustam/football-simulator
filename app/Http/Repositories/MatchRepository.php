<?php

namespace App\Http\Repositories;

use App\Models\Match;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class MatchRepository.
 *
 * @package App\Http\Repositories
 * @author Etibar Rustamzada <etibar.rustem@gmail.com>
 */
class MatchRepository extends AbstractRepository
{
    /**
     * MatchRepository constructor.
     *
     * @param Match $model
     */
    public function __construct(Match $model)
    {
        parent::__construct($model);
    }

    /**
     * Get data per week.
     *
     * @param array $weekIds
     * @return Builder[]|Collection
     */
    public function getByWeek(array $weekIds)
    {
        return $this->model
            ->has('teams')
            ->whereIn('week_id', $weekIds)
            ->get();
    }

    /**
     * @param int $week
     * @return mixed
     */
    public function getByWeekPosition(int $week)
    {
        return $this->model
            ->has('teams')
            ->whereHas('week', function($w) use ($week) {
                $w->where('position', $week);
            })
            ->with(['teams', 'week'])
            ->get();
    }
}
