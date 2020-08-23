<?php

namespace App\Http\Controllers\Cron;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Visitor;

class VisitorDeleteController extends Controller
{
    public function index()
    {
        Visitor::where('checkout_at', '<', Carbon::now()->subDays(14))->where('is_agreed', '0')->delete();
    }
}
