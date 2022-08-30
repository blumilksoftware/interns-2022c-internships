<?php

declare(strict_types=1);

namespace Internships\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Response;

class AdminPanelController extends Controller
{
    public function index(Request $request): Response
    {
        return inertia(
            "AdminPanel/Index",
        );
    }
}
