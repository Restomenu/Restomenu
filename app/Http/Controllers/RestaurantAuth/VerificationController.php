<?php

namespace App\Http\Controllers\RestaurantAuth;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Http\Request;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\Events\Verified;

class VerificationController extends Controller
{
	/*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
    */

	use VerifiesEmails;

	/**
	 * Where to redirect users after verification.
	 *
	 * @var string
	 */
	// protected $redirectTo = '/home';
	public function redirectTo()
	{
		if (!auth()->guard('restaurant')->check()) {
			return route('restaurant.login');
		}
		return route('restaurant.home');
	}

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth:restaurant')->except('verify');
		$this->middleware('signed')->only('verify');
		$this->middleware('throttle:6,1')->only('verify', 'resend');
	}

	public function show(Request $request)
	{
		return $request->user()->hasVerifiedEmail()
			? redirect($this->redirectPath())
			: view('restaurant-new.auth.verify');
	}

	public function verify(Request $request)
	{
		$user = Restaurant::find($request->route('id'));

		if (!hash_equals((string) $request->route('id'), (string) $user->getKey())) {
			throw new AuthorizationException;
		}

		if (!hash_equals((string) $request->query('hash'), sha1($user->getEmailForVerification()))) {
			throw new AuthorizationException;
		}
		if ($user->hasVerifiedEmail()) {
			return redirect($this->redirectPath());
		}

		if ($user->markEmailAsVerified()) {
			event(new Verified($user));
		}

		return redirect($this->redirectPath())->with('verified', true)->with('success', 'Your email has been verified');
	}
}
