<?php

namespace App\Http\Controllers;

use App\Events\UserRegisteredEvent;
use App\Http\Requests\LogInUser;
use App\Http\Requests\UserLogInRequest;
use App\Http\Requests\UserSignUpRequest;
use Illuminate\Support\Str;
use App\Notifications\SignupActivate;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function signup(UserSignUpRequest $request)
    {
        if(is_numeric($request->name)){
            return response()->json(['message' => __('Field Name must be an String')], 422);
        }

        $user = new User([
                             'name'             => $request->name,
                             'email'            => $request->email,
                             'password'         => bcrypt($request->password),
                             'partner_email'    => $request->partner_email,
                             'activation_token' => Str::random(60),
                         ]);

        $user->save();

        $user->notify(new SignupActivate($user));
        //event(new UserRegisteredEvent($user, $request->family_id));
        return response()->json(['message' => __('User created')], 201);
    }

    public function login(UserLogInRequest $request)
    {
        $credentials = request(['email', 'password']);
        $credentials['active'] = 1;
        $credentials['deleted_at'] = null;

        if (!Auth::attempt($credentials)) {
            return response()->json(['message' => __('Unauthorized')], 401);
        }

        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;

        if (boolval($request->remember_me)) {
            $token->expires_at = Carbon::now()->addWeeks(30);
        }

        $token->save();
        return response()->json([
                                    'access_token' => $tokenResult->accessToken,
                                    'token_type'   => 'Bearer',
                                    'expires_at'   => Carbon::parse($tokenResult->token->expires_at)->toDateTimeString(),
                                ]);
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json(['message' => __('Successfully logged out')]);
    }

    public function user(Request $request)
    {
        return response()->json($request->user());
    }

    public function signupActivate($token)
    {
        $user = User::where('activation_token', $token)->first();
        if (!$user) {
            return view('sign-up-activate-error');
        }
        $user->active = true;
        $user->activation_token = '';
        $user->save();
        return view('sign-up-activate-success');
    }
}
