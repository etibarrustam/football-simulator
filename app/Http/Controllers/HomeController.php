<?php

namespace App\Http\Controllers;

use App\Http\Services\LeagueService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Class HomeController.
 *
 * @package App\Http\Controllers
 * @author Etibar Rustemzada <etibar.rustem@gmail.com>
 */
class HomeController extends Controller
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
     * Home page
     *
     * @return Factory|View
     */
    public function index()
    {
        return view('league');
    }
}
