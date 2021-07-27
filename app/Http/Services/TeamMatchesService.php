<?php

namespace App\Http\Services;

use App\Http\Repositories\MatchRepository;
use App\Http\Repositories\MatchTeamRepository;
use App\Http\Repositories\TeamRepository;
use App\Http\Services\MatchGenerators\MatchGenerator;

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
        $games = [];
//        $teams = $this->teamRepository->all([], ['matches']);
        $matches = $this->matchTeamRepository->all()->toArray();

        $games = new MatchGenerator($matches);
    }
}
