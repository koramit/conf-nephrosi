<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class LandingController extends Controller
{
    public function __invoke()
    {
        session()->flash('page-title', 'Nephr@SI Conference');

        return Inertia::render('LandingPage', [
            'loginUrl' => route('login'),
        ]);
    }
}
