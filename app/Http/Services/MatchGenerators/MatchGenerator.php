<?php

namespace App\Http\Services\MatchGenerators;

class MatchGenerator
{
    public $players;

    public function __construct(array $matches)
    {
        $this->generate($matches);
    }

    private function generate($matches)
    {
        for ($i = 0; $i <= count($matches); $i++) {
            $teamMatches = new GetTeamMatches($matches[$i]['team_id'], $matches);

            if ($teamMatches->played) {

            }
        }
    }
}
