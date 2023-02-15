<?php

namespace App\Http\Controllers;

use App\Models\Episode;
use Inertia\Inertia;

class HomeController extends Controller
{
    protected array $images = [
        [
            'season' => '2022',
            'prefix' => 'https://demo-nephlix.s3.ap-southeast-1.amazonaws.com/nsc/2022/i/',
            'extension' => '.jpeg',
            'files' => ['26112022-EMD-RK-124', '25112022-EMD-RK-002', '25112022-EMD-RK-026', '25112022-EMD-RK-030', '25112022-EMD-RK-034', '25112022-EMD-RK-041', '25112022-EMD-RK-047', '25112022-EMD-RK-053', '25112022-EMD-RK-060', '25112022-EMD-RK-069', '25112022-EMD-RK-085', '26112022-EMD-RK-091', '26112022-EMD-RK-093', '26112022-EMD-RK-114', '26112022-EMD-RK-127', '26112022-EMD-RK-133', '26112022-EMD-RK-137', '26112022-EMD-RK-169', '26112022-EMD-RK-177', '26112022-EMD-RK-182', '26112022-EMD-RK-223', '26112022-EMD-RK-242', '26112022-EMD-RK-247', '26112022-EMD-RK-275', '26112022-EMD-RK-290', '26112022-EMD-RK-292', '26112022-EMD-RK-293', '26112022-EMD-RK-329', '26112022-EMD-RK-332', '26112022-EMD-RK-340', '26112022-EMD-RK-349', '26112022-EMD-RK-356', '26112022-EMD-RK-369', '26112022-EMD-RK-380', '26112022-EMD-RK-496', '26112022-EMD-RK-498', '26112022-EMD-RK-582', '26112022-EMD-RK-602', '26112022-EMD-RK-612', '26112022-EMD-RK-629', '26112022-EMD-RK-637', '26112022-EMD-RK-652', '26112022-EMD-RK-657', '26112022-EMD-RK-661', '26112022-EMD-RK-667', '26112022-EMD-RK-670', '26112022-EMD-RK-671', '26112022-EMD-RK-677', '26112022-EMD-RK-686', '26112022-EMD-RK-735', '26112022-EMD-RK-775', '26112022-EMD-RK-791'],
        ],
    ];

    public function __invoke()
    {
        $ep = Episode::query()
            ->where('season', 2022)
            ->get();

        $days = $ep->pluck('day')
            ->unique()
            ->values()
            ->map(function ($d) use ($ep) {
                $day['day'] = $d;
                $day['show'] = false;
                $sections = $ep->where('day', $d)
                    ->pluck('section')
                    ->unique()
                    ->values();
                $day['sections'] = $sections->map(function ($section) use ($ep) {
                    return [
                        'title' => $section,
                        'episodes' => $ep->where('section', $section)
                            ->values()
                            ->transform(fn ($e) => [
                                'title' => $e->title,
                                'speakers' => $e->speakers,
                                'source' => $e->source,
                                'slide' => $e->slide,
                                'id' => $e->id,
                            ]),

                    ];
                });

                return $day;
            });

        session()->flash('page-title', 'Nephr@SI Conference');

        return Inertia::render('HomePage', [
            'seasonsData' => [['season' => 2022, 'days' => $days]],
            'images' => collect($this->images)->map(function ($set) {
                return [
                    'season' => $set['season'],
                    'prefix' => $set['prefix'],
                    'extension' => $set['extension'],
                    'files' => collect($set['files'])->shuffle()->values(),
                ];
            }),
            'routes' => [
                'logout' => route('logout'),
                'episodeViewStore' => route('episode-views.store'),
            ],
        ]);
    }
}
