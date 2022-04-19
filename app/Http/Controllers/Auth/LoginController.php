<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Redirect the user to the Google authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('google')
            ->scopes(['https://www.googleapis.com/auth/user.birthday.read'])
            ->redirect();
    }

    protected function getBirthDate($user){
        $token = $user->token;
        $api_key = env('GOOGLE_API_KEY');
        $url = "https://people.googleapis.com/v1/people/{$user['id']}?personFields=birthdays,genders&key={$api_key}&access_token={$token}";
        $data = file_get_contents($url);
        $array = json_decode($data);
        $year = $array->birthdays['0']->date->year ?? $array->birthdays['1']->date->year;
        $month = $array->birthdays['0']->date->month;
        $day = $array->birthdays['0']->date->day;
        return $year.'-'.$month.'-'.$day;
    }

    /**
     * Obtain the user information from Google.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
        } catch (\Exception $e) {
            return redirect('/login');
        }
        $existingUser = User::where('email', $user->email)->first();        if($existingUser){
        // log them in
        auth()->login($existingUser, true);
    } else {
        // create a new user
        $newUser                  = new User();
        $newUser->name            = $user->name;
        $newUser->email           = $user->email;
        $newUser->google_id       = $user->id;
        $newUser->birthday       = $this->getBirthDate($user);
        $newUser->save();            auth()->login($newUser, true);
    }
        return redirect()->to('/');
    }
}
