<?php

namespace Astrotomic\Webmentions\Statamic\Tests\Tags;

use Astrotomic\Webmentions\Statamic\Tags\Webmentions;
use Astrotomic\Webmentions\Statamic\Tests\TestCase;
use Illuminate\Http\Request;

class WebmentionsTest extends TestCase
{
    protected Webmentions $tag;

    public function setUp(): void
    {
        parent::setUp();
        $this->tag = new Webmentions();
        $this->tag->setContext(['webmentions']);
    }

    /** @test */
    public function it_is_registered(): void
    {
        $this->assertTrue(isset(app()['statamic.tags']['webmentions']));
    }

    /** @test */
    public function it_gets_webmentions_for_url(): void
    {
        $url = 'https://gummibeer.dev/blog/2020/human-readable-intervals/';

        // Passing the url for the {{ webmentions url="" }} tag
        $this->tag->setParameters(['url' => $url]);

        $this->assertEquals($url, $this->tag->index()->first()->target);
    }

    public function it_gets_webmentions_by_current_request(): void
    {
        $request = Request::create('https://gummibeer.dev/blog/2020/human-readable-intervals/', 'GET');
        $this->app->instance('request', $request);

        $this->assertParseEquals('First', '{{ webmentions }}{{ dump }}{{ /webmentions }}');
    }
}
