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
            Period::days(30),
            'ga:users',
            [
                'metrics' => 'ga:metric1,ga:metric2',
                'dimensions' => 'ga:hostname',
                'sort' => '-ga:metric1',
            ]
        );

        $headers = ['hostname', 'tcount', 'ecount'];

        return array_map(
            function ($row) use ($headers) {
                return array_combine($headers, $row);
            },
            $analyticsData->rows ?? []
        );

    }
}
