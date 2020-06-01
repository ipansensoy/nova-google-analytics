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
                'dimensions' => 'ga:pageTitle,ga:hostname,ga:pagePath,ga:date',
                'sort' => '-ga:metric1',
                'max-results' => 10,
            ]
        );

        $headers = ['name', 'hostname', 'path', 'count'];

        return array_map(
            function ($row) use ($headers) {
                return array_combine($headers, $row);
            },
            $analyticsData->rows ?? []
        );
    }
}
