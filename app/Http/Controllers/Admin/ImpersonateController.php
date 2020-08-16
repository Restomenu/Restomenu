<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ImpersonateController extends Controller
{
    public function index($id)
    {
        $restaurant = Restaurant::find($id);
        if ($restaurant) {
            session()->put('impersonate', $restaurant->id);
        }
        return redirect(route('restaurant.home'));
    }

    public function destroy()
    {
        session()->forget('impersonate');
        Auth::guard('restaurant')->logout();
        return redirect(route('restaurant.home'));
    }
}
