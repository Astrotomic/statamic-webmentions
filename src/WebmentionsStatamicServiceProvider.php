<?php

namespace Astrotomic\Webmentions\Statamic;

use Astrotomic\Webmentions\Statamic\Tags\Webmentions;
use Statamic\Providers\AddonServiceProvider;

class WebmentionsStatamicServiceProvider extends AddonServiceProvider
{
    protected $tags = [
        Webmentions::class,
    ];
}
