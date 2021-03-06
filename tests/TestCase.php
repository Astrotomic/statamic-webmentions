<?php

namespace Astrotomic\Webmentions\Statamic\Tests;

use Astrotomic\Webmentions\Statamic\WebmentionsStatamicServiceProvider;
use Astrotomic\Webmentions\WebmentionsServiceProvider;
use Illuminate\Support\Facades\Http;
use Orchestra\Testbench\TestCase as OrchestraTestCase;
use Statamic\Extend\Manifest;
use Statamic\Facades\Antlers;
use Statamic\Providers\StatamicServiceProvider;

abstract class TestCase extends OrchestraTestCase
{
    protected function getPackageProviders($app): array
    {
        return [
            StatamicServiceProvider::class,
            WebmentionsServiceProvider::class,
            WebmentionsStatamicServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        parent::getEnvironmentSetUp($app);

        $app->make(Manifest::class)->manifest = [
            'astrotomic/statamic-webmentions' => [
                'id'        => 'astrotomic/statamic-webmentions',
                'namespace' => 'Astrotomic\\Webmentions\\Statamic\\',
            ],
        ];
    }

    protected function setUp(): void
    {
        parent::setUp();

        Http::fake([
            'webmention.io/api/mentions.jf2*' => Http::response(json_decode(file_get_contents(__DIR__.'/fixtures/gummibeer.dev.json'), true), 200),
        ]);
    }

    protected function assertParseEquals(string $expected, string $template, array $context = [])
    {
        $this->assertEquals($expected, (string) Antlers::parse($template, $context));
    }
}
