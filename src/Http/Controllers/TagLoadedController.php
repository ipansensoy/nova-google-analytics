<?php

namespace Tightenco\NovaGoogleAnalytics\Http\Controllers;

use Illuminate\Routing\Controller;
use Spatie\Analytics\Analytics;
use Spatie\Analytics\Period;

class TagLoadedController extends Controller
{
    public function __invoke()
    {
        return $this->tagLoaded();
    }

    private function tagLoaded()
    {
        $analyticsData = app(Analytics::class)->performQuery(
            Period::days(7),
            'ga:users',
            [
                'metrics' => 'ga:metric1',
                'dimensions' => 'ga:hostname',
                'sort' => '-ga:metric1',
                'max-results' => 10,
            ]
        );

        $headers = ['hostname', 'count'];

        return array_map(
            function ($row) {
                return $row;
            },
            $analyticsData->rows ?? []
        );

    }
}
