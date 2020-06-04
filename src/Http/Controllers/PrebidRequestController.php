<?php

namespace Tightenco\NovaGoogleAnalytics\Http\Controllers;

use Illuminate\Routing\Controller;
use Spatie\Analytics\Analytics;
use Spatie\Analytics\Period;

class PrebidRequest extends Controller
{
    public function __invoke()
    {
        return $this->prebidRequest();
    }

    private function prebidRequest()
    {

        $analyticsData = app(Analytics::class)->performQuery(
            Period::days(7),
            'ga:users',
            [
                'metrics' => 'ga:metric10,ga:metric11',
                'dimensions' => 'ga:hostname',
                'sort' => '-ga:metric10',
                'max-results' => 10,
            ]
        );

        $headers = ['hostname', 'video_count', 'banner_count'];

        return array_map(
            function ($row) use ($headers) {
                return array_combine($headers, $row);
            },
            $analyticsData->rows ?? []
        );

    }
}
