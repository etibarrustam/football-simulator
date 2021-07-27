<?php

namespace App\Http\Services\MatchGenerators;

class OpposingPLayer
{
    public $opposed;

    public function __construct(array $team, array $plays, array $matches)
    {
        $this->checkPLay();
    }

    private function finished($played, $opposite)
    {
        foreach ($played as $play) {
            if ($opposite['match_id'] == $play['id']) {

            }
        }
    }
}
