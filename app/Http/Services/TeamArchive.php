<?php

namespace App\Http\Services;

/**
 * Class TeamArchive.
 *
 * @package App\Http\Services
 * @author Etibar Riustamzada <etibar.rustem@gmail.com>
 */
class TeamArchive
{
    /**
     * Get team collected data.
     *
     * @param $team
     * @return array
     */
    public function data($team)
    {
       $equality = new TeamEquality($team);

       return [
           'won' => $equality->win(),
           'drawn' => $equality->drawn(),
           'lost' => $equality->lost(),
           'points' => $equality->points(),
           'goal_diff' => $equality->goalDiff()
       ];
    }
}
