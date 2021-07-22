<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Class Match.
 *
 * @package App\Models
 * @author Etibar Rustamzada <etibar.rustem@gmail.com>
 */
class Match extends Model
{
    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = ['week_id'];

    /**
     * @var string[]
     */
    protected $appends = ['winner_id'];

    /**
     * Get home team.
     *
     * @return BelongsToMany
     */
    public function homeTeam()
    {
        return $this->belongsToMany(Team::class)->withPivot('home', 'goals')->wherePivot('home', 1);
    }

    /**
     * Get away team.
     *
     * @return BelongsToMany
     */
    public function awayTeam()
    {
        return $this->belongsToMany(Team::class)->withPivot('home', 'goals')->wherePivot('home', 0);
    }

    /**
     * @return BelongsToMany
     */
    public function teams()
    {
        return $this->belongsToMany(Team::class)->withPivot('home', 'goals');
    }

    /**
     * @return BelongsTo
     */
    public function week()
    {
        return $this->belongsTo(Week::class);
    }

    /**
     * @return null
     */
    public function getWinnerIdAttribute()
    {
        list($team1, $team2) = $this->teams;

        if ($team1->pivot->goals != $team2->pivot->goals) {
            if ($team1->pivot->goals > $team2->pivot->goals) {
                return $team1->id;
            }

            return $team2->id;
        }

        return null;
    }
}
