<?php

namespace App\Http\Services\MatchGenerators;

class GetTeamMatches
{
    public array $played;

    public function __construct(int $teamId, array $matches)
    {
        $matchIds = array_map(function ($match) use ($teamId) {
            if ($teamId == $match['team_id']) {
                return $match['match_id'];
            }
        }, $matches);

        $this->played = array_filter($matches, function ($match) use ($matchIds, $teamId) {
            if ($teamId == $match['team_id'] && in_array($match['match_id'], $matchIds)) {
                return true;
            }
        });
    }
}
