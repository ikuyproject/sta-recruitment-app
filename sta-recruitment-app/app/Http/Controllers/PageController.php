<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class PageController extends Controller
{
    /**
     * แสดงหน้า "Our Team"
     */
    public function ourTeam(): View
    {
        return view('pages.our-team');
    }
}
