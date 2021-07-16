<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Week.
 *
 * @package App\Models
 */
class Week extends Model
{
    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var string[]
     */
    protected $fillable = ['position'];

    /**
     * @return HasMany
     */
    public function matches()
    {
        return $this->hasMany(Match::class);
    }
}
