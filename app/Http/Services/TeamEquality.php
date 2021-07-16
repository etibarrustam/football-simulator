<?php

namespace App\Http\Services;

use App\Models\Team;

/**
 * Class TeamEquality.
 *
 * @package App\Http\Services
 * @author Etibar Rustamzada <etibar.rustem@gmail.com>
 */
class TeamEquality
{
    /**
     * @var Team
     */
    public $team;

    /**
     * @var bool
     */
    public $winner = false;

    /**
     * TeamEquality constructor.
     *
     * @param Team $team
     */
    public function __construct(Team $team)
    {
        $this->team = $team;
    }

    /**
     * @return bool
     */
    public function win()
    {
        return $this->team->matches->filter(function ($item) {
            return $item->winner_id == $this->team->id && !is_null($item->winner_id);
        })->count();
    }

    /**
     * @return bool
     */
    public function drawn()
    {
        return $this->team->matches->whereNull('winner_id')->count();
    }

    /**
     * @return bool
     */
    public function lost()
    {
        return $this->team->matches->filter(function ($item) {
            return $item->winner_id != $this->team->id && !is_null($item->winner_id);
        })->count();
    }

    /**
     * @return int|mixed
     */
    public function goalDiff()
    {
        $goals = $this->team->matches->sum(function ($item) {
            return $item->teams->where('id', $this->team->id)->sum('pivot.goals');
        });
        $losts = $this->team->matches->sum(function ($item) {
            return $item->teams->where('id', '!=', $this->team->id)->sum('pivot.goals');
        });

        return $goals - $losts;
    }

    /**
     * @return int
     */
    public function points()
    {
        $points = 0;

        if ($this->win()) {
            $points = $this->win() * 3;
        }
        if ($this->drawn()) {
            $points += $this->drawn();
        }

        return $points;
    }
}
