<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Team.
 *
 * @package App\Models
 * @author Etibar Rustamzada <etibar.rustem@gmail.com>
 */
class Team extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * @return BelongsToMany
     */
    public function matches()
    {
        return $this->belongsToMany(Match::class);
    }

    /**
     * Get home team matches.
     *
     * @return BelongsToMany
     */
    public function homeMatches(): BelongsToMany
    {
        return $this->belongsToMany(Match::class)->withPivot('home', 'goals')->wherePivot('home', 1);
    }

    /**
     * Get away team matches.
     *
     * @return BelongsToMany
     */
    public function awayMatches(): BelongsToMany
    {
        return $this->belongsToMany(Match::class)->withPivot('home', 'goals')->wherePivot('home', 0);
    }

}
