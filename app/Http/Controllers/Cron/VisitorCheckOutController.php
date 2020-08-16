<?php

namespace App\Http\Controllers\Cron;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Visitor;

class VisitorCheckOutController extends Controller
{
    public function index()
    {
        Visitor::whereNull('checkout_at')->where('checkin_at', '>', Carbon::now()->subdays(2))->update(['checkout_at' => Carbon::now()]);
    }
}
