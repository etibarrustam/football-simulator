<?php

namespace App\Http\Services;

use App\Http\Repositories\MatchRepository;
use App\Http\Repositories\MatchTeamRepository;
use App\Http\Repositories\TeamRepository;
use App\Http\Repositories\WeekRepository;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class LeagueService.
 *
 * @package App\Http\Services
 * @author Etibar Rustamzada <etibar.rustem@gmail.com>
 */
class LeagueService
{
    /**
     * @var TeamRepository
     */
    private TeamRepository $teamRepository;

    /**
     * @var MatchRepository
     */
    private MatchRepository $matchRepository;

    /**
     * @var MatchTeamRepository
     */
    private MatchTeamRepository $matchTeamRepository;

    /**
     * @var TeamArchive
     */
    private TeamArchive $teamArchive;

    /**
     * @var WeekRepository
     */
    private WeekRepository $weekRepository;

    private $teamMatchesService;

    /**
     * LeagueService constructor.
     *
     * @param TeamRepository $teamRepository
     * @param TeamArchive $teamArchive
     * @param MatchRepository $matchRepository
     * @param MatchTeamRepository $matchTeamRepository
     * @param WeekRepository $weekRepository
     * @param TeamMatchesService $teamMatchesService
     */
    public function __construct(
        TeamRepository $teamRepository,
        TeamArchive $teamArchive,
        MatchRepository $matchRepository,
        MatchTeamRepository $matchTeamRepository,
        WeekRepository $weekRepository,
        TeamMatchesService $teamMatchesService
    ) {
        $this->teamRepository = $teamRepository;
        $this->matchRepository = $matchRepository;
        $this->matchTeamRepository = $matchTeamRepository;
        $this->teamArchive = $teamArchive;
        $this->weekRepository = $weekRepository;
        $this->teamMatchesService = $teamMatchesService;
    }

    /**
     * Get match result by week.
     *
     * @param int $week
     * @return array
     */
    public function weekResult(int $week)
    {
        $data = collect([]);
        $weeks = $this->weekRepository->all(['position_to' => $week]);
        $teams = $this->teamRepository->getByWeek($weeks->pluck('id')->toArray());

        foreach ($teams as $team) {
            $teamData = $this->teamArchive->data($team);
            $teamData['name'] = $team->name;
            $teamData['played'] = count($team->matches);

            $data->push($teamData);
        }

        $data = $data->sortBy(['points' => 'asc'])->values()->all();

        usort($data, function ($a, $b) {
            return $b['points'] - $a['points'];
        });

        return $data;
    }

    /**
     * Get match by week.
     *
     * @param int $week
     * @return Builder[]
     */
    public function weekMatches(int $week)
    {
        $weekMatches = [];
        $matches = $this->matchRepository->getByWeekPosition($week);

        foreach ($matches as $match) {
            $data['home_team'] = $match->teams->filter(function ($team) {
                return $team->pivot->home;
            })->first();
            $data['away_team'] = $match->teams->filter(function ($team) {
                return !$team->pivot->home;
            })->first();

            $weekMatches[] = $data;
        }

        return $weekMatches;
    }

    /**
     * Get percentage of team results.
     *
     * @param array $data
     * @return array
     */
    public function predictions(array $data)
    {
        $sum = array_sum(array_map(function ($value) {
            return $value['points'];
        }, $data));

        $prediction = array_map(
            function ($val) use ($sum) {
                if (!$sum) {
                    return ['name' => $val['name'], 'percentage' => 0];
                }

                return [
                    'name' => $val['name'],
                    'percentage' => round($val['points'] / $sum * 100, 1)
                ];
            },
            $data
        );

        usort($prediction, function ($a, $b) {
            return $b['percentage'] - $a['percentage'];
        });

        return $prediction;
    }

    /**
     * Play game randomly.
     *
     * @return void|null
     */
    public function play($week)
    {
        $lastWeek = 1;
        $atHome = 1;
        $matches = $this->matchRepository->all();

        if ($matches) {
            $lastWeek = $this->weekRepository->getMaxPosition();
        }
        if (($week <= $lastWeek) || (($week - $lastWeek) > 1)) {
            return null;
        }

        $newWeek = $this->weekRepository->create(['position' => $week]);
        $teams = $this->teamRepository->all()->shuffle();

        foreach ($teams->chunk(2) as $team) {
            $team = $team->values();
            $match = $this->matchRepository->create(['week_id' => $newWeek->id]);

            if (count($team) == 2) {
                foreach ($team as $value) {
                    $this->matchTeamRepository->create([
                        'team_id' => $value->id,
                        'match_id' => $match->id,
                        'home' => $atHome,
                        'goals' => rand(1, 6),
                    ]);
                    $atHome = !$atHome;
                }
            }
        }
    }
}
