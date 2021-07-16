<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LeagueRequest;
use App\Http\Resources\LeagueResource;
use App\Http\Services\LeagueService;

/**
 * Class LeagueController.
 *
 * @package App\Http\Controllers
 * @author Etibar Rustamzada <etibar.rustem@gmail.com>
 */
class LeagueController extends Controller
{

    /**
     * @var LeagueService
     */
    protected $leagueService;

    /**
     * LeagueController constructor.
     *
     * @param LeagueService $leagueService
     */
    public function __construct(LeagueService $leagueService)
    {
        $this->leagueService = $leagueService;
    }

    /**
     * Play game.
     *
     * @return LeagueResource
     */
    public function all(LeagueRequest $request)
    {
        $week = $request->get('week') ?? 1;

        $teamData = $this->leagueService->weekResult($week);

        $percentage = $this->leagueService->predictions($teamData);
        $matches = $this->leagueService->weekMatches($week);

        return new LeagueResource([
            'teamData' => $teamData,
            'percentage' => $percentage,
            'matches' => $matches,
            'week' => $week
        ], __('_.success'));
    }

    /**
     * Play all game by week.
     *
     * @return LeagueResource
     */
    public function play(LeagueRequest $request)
    {
        $this->leagueService->play($request->get('week'));

        return new LeagueResource([], __('_.success'));
    }
}
