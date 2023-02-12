<?php

namespace App\Http\Controllers;

use App\APIs\LINELoginAPI;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LINELoginController extends Controller
{
    /**
     * @throws Exception
     */
    public function create()
    {
        return (new LINELoginAPI())->redirect();
    }

    public function store(Request $request)
    {
        try {
            $lineUser = new LINELoginAPI();
            $lineUser($request->all());
        } catch (Exception $e) {
            Log::error($e->getMessage());

            return redirect()->route('landing')->withErrors(['status' => $e->getMessage()]);
        }

        /**
         * @var User $user
         */
        if (! $user = User::query()->where('line_id', $lineUser->getId())->first()) {
            $request->session()->put('lineUser', [
                'id' => $lineUser->getId(),
                'name' => $lineUser->getName(),
                'nickname' => $lineUser->getNickname(),
                'email' => $lineUser->getEmail(),
                'avatar' => $lineUser->getAvatar(),
                'status' => $lineUser->getStatus(),
            ]);

            return redirect()->route('register');
        }

        Auth::login($user);

        return redirect()->intended(route('home'));
    }

    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('landing');
    }
}
