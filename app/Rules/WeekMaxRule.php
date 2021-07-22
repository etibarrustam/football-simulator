<?php

namespace App\Rules;

use App\Http\Repositories\TeamRepository;
use Illuminate\Contracts\Validation\Rule;

class WeekMaxRule implements Rule
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
        $maxWeekCount = ($teamsCount - 1) * 2;

        return $maxWeekCount >= $value;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The game is reached max week.';
    }
}
