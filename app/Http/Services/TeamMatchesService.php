<?php

namespace App\Http\Services;

use App\Http\Repositories\MatchRepository;
use App\Http\Repositories\MatchTeamRepository;
use App\Http\Repositories\TeamRepository;

class TeamMatchesService
{
    private $teamRepository;
    private $matchRepository;
    private $matchTeamRepository;

    public function __construct(
        TeamRepository $teamRepository,
        MatchRepository $matchRepository,
        MatchTeamRepository $matchTeamRepository
    )
    {
        $this->teamRepository = $teamRepository;
        $this->matchRepository = $matchRepository;
        $this->matchTeamRepository = $matchTeamRepository;
    }

    public function sortByGame()
    {
        $teams = $this->teamRepository->all();

        $matches = $this->matchTeamRepository->aa();

        dd($matches);
    }
}
