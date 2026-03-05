<?php

namespace App\Http\Controllers;

use App\Application\Dashboard\UseCase\ShowDashboardUseCase;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __construct(
        private ShowDashboardUseCase $showDashboardUseCase
    ) {}
    
    /**
     * show
     *
     * @return View
     */
    public function show(): View
    {
        $dashboard = $this->showDashboardUseCase->execute();

        return view('dashboard.dashboard', ['dashboard' => $dashboard]);
    }
}
