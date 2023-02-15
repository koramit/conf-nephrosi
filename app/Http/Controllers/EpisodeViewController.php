<?php

namespace App\Http\Controllers;

use App\Models\EpisodeView;
use Illuminate\Http\Request;

class EpisodeViewController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'episode_id' => ['required', 'integer', 'exists:episodes,id'],
        ]);

        $episodeView = EpisodeView::query()
            ->create([
            'user_id' => $request->user()->id,
            'episode_id' => $request->input('episode_id'),
            'viewed_at' => now(),
        ]);

        return response()->json(['ok' => true]);
    }
}
