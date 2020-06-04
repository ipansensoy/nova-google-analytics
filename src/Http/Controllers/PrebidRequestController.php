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
                'metrics' => 'ga:totalEvents,ga:eventValue,ga:avgEventValue',
                'dimensions' => 'ga:hostname,ga:eventCategory,ga:eventAction,ga:eventLabel',
                'sort' => '-ga:hostname,-ga:eventCategory,-ga:eventAction,-ga:eventLabel',
                'filter' => 'ga:eventCategory=~^Prebid.js;ga:eventAction=~Request',
                'max-results' => 10,
            ]
        );

        $headers = ['hostname', 'category', 'action', 'label', 'total', 'value', 'avg'];

        return array_map(
            function ($row) use ($headers) {
                return array_combine($headers, $row);
            },
            $analyticsData->rows ?? []
        );

    }
}
