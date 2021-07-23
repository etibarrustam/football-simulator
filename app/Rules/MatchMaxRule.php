<?php

namespace App\Rules;

use App\Http\Repositories\TeamRepository;
use Illuminate\Contracts\Validation\Rule;

class MatchMaxRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $teamsCount = app(TeamRepository::class)->count();
        $maxGameCount = $teamsCount * ($teamsCount - 1);

        return $maxGameCount >= $value;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'You have played all games.';
    }
}
