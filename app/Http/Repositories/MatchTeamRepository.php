<?php

namespace App\Http\Repositories;

use App\Models\MatchTeam;

/**
 * Class MatchTeamRepository.
 *
 * @package App\Http\Repositories
 * @author Etibar Rustamzada <etibar.rustem@gmail.com>
 */
class MatchTeamRepository extends AbstractRepository
{
    /**
     * MatchTeamRepository constructor.
     *
     * @param MatchTeam $model
     */
    public function __construct(MatchTeam $model)
    {
        parent::__construct($model);
    }
}
