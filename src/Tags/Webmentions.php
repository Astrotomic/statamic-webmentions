<?php

namespace Astrotomic\Webmentions\Statamic\Tags;

use Astrotomic\Webmentions\Collections\WebmentionsCollection;
use Astrotomic\Webmentions\Facades\Webmentions as Client;
use Illuminate\Support\Collection;
use Statamic\Tags\Concerns\OutputsItems;
use Statamic\Tags\Tags;

class Webmentions extends Tags
{
    use OutputsItems;

    /**
     * {{ webmentions url="" }} ... {{ /webmentions }}
     */
    public function index(): WebmentionsCollection
    {
        return $this->output($this->get());
    }

    /**
     * {{ webmentions:likes url="" }} ... {{ /webmentions:likes }}
     */
    public function likes(): Collection
    {
        return $this->output($this->get()->likes());
    }

    /**
     * {{ webmentions:mentions url="" }} ... {{ /webmentions:mentions }}
     */
    public function mentions(): Collection
    {
        return $this->output($this->get()->mentions());
    }

    /**
     * {{ webmentions:replies url="" }} ... {{ /webmentions:replies }}
     */
    public function replies(): Collection
    {
        return $this->output($this->get()->replies());
    }

    /**
     * {{ webmentions:reposts url="" }} ... {{ /webmentions:reposts }}
     */
    public function reposts(): Collection
    {
        return $this->output($this->get()->reposts());
    }

    protected function get(): WebmentionsCollection
    {
        return Client::get($this->params['url']);
    }
}
