<?php

namespace App\Http\Resources;

/**
 * Class LeagueResourceCollection.
 *
 * @package App\Http\Resources
 * @author Etibar Rustamzada <etibar.rustem@gmail.com>
 */
class LeagueResourceCollection extends ApiResponseCollection
{
    /**
     * @var string
     */
    public $collects = LeagueResource::class;
}
