<?php

namespace App\Http\Controllers;

use App\Models\Episode;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class HomeController extends Controller
{

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

        $images = [
            [
                'season' => '2022',
                'sets' => [
                    [
                        'label' => 'Conference',
                        'images' => $this->getImages('image_set_conference-nsc/2022/i/c'),
                        'show' => true,
                    ],
                    [
                        'label' => 'Party',
                        'images' => $this->getImages('image_set_party-nsc/2022/i/pa'),
                        'show' => false,
                    ],
                    [
                        'label' => 'Activity',
                        'images' => $this->getImages('image_set_activity-nsc/2022/i/a'),
                        'show' => false,
                    ],
                    [
                        'label' => 'Group',
                        'images' => $this->getImages('image_set_group-nsc/2022/i/g'),
                        'show' => false,
                    ],
                    [
                        'label' => 'Portrait',
                        'images' => $this->getImages('image_set_portrait-nsc/2022/i/p'),
                        'show' => false,
                    ],
                ]
            ],
        ];

        return Inertia::render('HomePage', [
            'seasonsData' => [['season' => 2022, 'days' => $days]],
            'imagesData' => $images,
            'routes' => [
                'logout' => route('logout'),
                'episodeViewStore' => route('episode-views.store'),
            ],
        ]);
    }

    protected function getImages(string $key)
    {
        $key = explode('-', $key)[1];
        $images = cache()->rememberForever($key, fn () => collect(Storage::disk('s3')->files($key))->map(fn($f) => Storage::disk('s3')->url($f)));

        return $images->shuffle()->values();
    }
}
