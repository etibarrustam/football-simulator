<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class LeagueRequest.
 *
 * @package App\Http\Requests
 * @author Etibar Rustamzada <etibar.rustem@gmail.com>
 */
class LeagueRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'week' => 'required|numeric|min:1'
        ];
    }
}
