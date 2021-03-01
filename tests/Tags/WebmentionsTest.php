<?php

namespace Astrotomic\Webmentions\Statamic\Tests\Tags;

use Astrotomic\Webmentions\Statamic\Tests\TestCase;
use Illuminate\Http\Request;

class WebmentionsTest extends TestCase
{
    /** @test */
    public function it_gets_webmentions_by_current_request(): void
    {
        $request = Request::create('https://gummibeer.dev/blog/2020/human-readable-intervals/', 'GET');
        $this->app->instance('request', $request);

        $this->assertParseEquals('First', '{{ webmentions }}{{ dump }}{{ /webmentions }}');
    }
}
