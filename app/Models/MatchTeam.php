<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class MatchTeam.
 *
 * @package App\Models
 */
class MatchTeam extends Model
{
    protected $table = 'match_team';
    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var string[]
     */
    protected $fillable = ['team_id', 'match_id', 'goals', 'home'];
}
