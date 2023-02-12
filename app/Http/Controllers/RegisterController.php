<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Inertia\Inertia;

class RegisterController extends Controller
{
    public function create()
    {
        if (! $lineUser = session('lineUser')) {
            return redirect()->route('landing');
        }

        session()->flash('page-title', 'ลงทะเบียน : Nephr@SI Conference');

        return Inertia::render('RegisterForm', [
            'lineUser' => $lineUser,
            'routeRegisterStore' => route('register.store'),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'employee' => ['required', 'boolean'],
            'sap_id' => ['nullable', 'required_if:employee,true', 'digits:8'],
            'tel_no' => ['nullable', 'required_if:employee,false', 'numeric'],
            'email' => ['nullable', 'required_if:employee,false', 'email'],
            'accepted_terms' => ['required', 'boolean', 'accepted'],
        ]);

        $userList = cache('user-list');
        if ($validated['employee']) {
            $verified = $userList->filter(fn ($u) => $u['sap_id'] == $validated['sap_id'])->count();
            $verifyCode = $validated['sap_id'];
        } else {
            $verified = $userList->filter(fn ($u) => $u['email'] == $validated['email'] && $u['tel'] == $validated['tel_no']
            )->count();
            $verifyCode = "{$validated['email']}|{$validated['tel_no']}";
        }

        if (! $verified) {
            return back()->withErrors(['status' => 'ข้อมูลไม่อยู่ในรายการ กรุณาติดต่อ 024198383']);
        }

        if ($user = User::query()->where('verify_code', $verifyCode)->first()) {
            return back()->withErrors(['status' => 'ไม่สามารถดำเนินการได้เนื่องจากสิทธิ์ถูกใช้แล้วโดย '.$user->name]);
        }

        $lineUser = session('lineUser');
        $user = new User();
        $user->line_user_id = $lineUser['id'];
        $user->name = $lineUser['name'];
        $user->verify_code = $verifyCode;
        $user->status = $lineUser['status'];
        $user->avatar_url = $lineUser['avatar'];
        $user->password = Hash::make(Str::random(16));
        $user->save();
        Auth::login($user);

        return redirect()->route('home');
    }
}
