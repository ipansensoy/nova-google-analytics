<?php

namespace Tightenco\NovaGoogleAnalytics;

use Laravel\Nova\Card;

class TagLoadedCard extends Card
{
    /**
     * The width of the card (1/3, 1/2, or full).
     *
     * @var string
     */
    public $width = '1/2';
    public $height = '400px';

    /**
     * Get the component name for the element.
     *
     * @return string
     */
    public function component()
    {
        return 'tag-loaded';
    }
}
