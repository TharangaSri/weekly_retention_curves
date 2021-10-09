<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WebController extends Controller
{
    /**
     * Web view of Weekly Retention Curve
     */
    public function chartIndexAction()
    {
        return view('UserWeeklyRetentionChart');
    }
}
