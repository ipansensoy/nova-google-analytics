<?php

namespace Tightenco\NovaGoogleAnalytics\Http\Controllers;

use Illuminate\Routing\Controller;
use Spatie\Analytics\Analytics;
use Spatie\Analytics\Period;

class MediaTypeLoadedController extends Controller
{
    public function __invoke()
    {
        return $this->mediaTypeLoaded();
    }

    private function mediaTypeLoaded()
    {

        $analyticsData = app(Analytics::class)->performQuery(
            Period::days(30),
            'ga:users',
            [
                'metrics' => 'ga:metric9',
                'dimensions' => 'ga:hostname,ga:pagePath,ga:dimension1',
                'sort' => '-ga:metric9',
                'max-results' => 10,
            ]
        );

        $headers = ['hostname', 'path', 'bidWon', 'count'];

        return array_map(
            function ($row) use ($headers) {
                return array_combine($headers, $row);
            },
            $analyticsData->rows ?? []
        );

    }
}
