<?php
/**
 * User: delboy1978uk
 * Date: 14/08/15
 * Time: 15:56
 */

namespace Del;

class HelloApi
{
    private string $baseUri;

    public function __construct(string $baseUri)
    {
        $this->baseUri = $baseUri;
    }

    public function hello(string $name): array
    {
        $uri = $this->baseUri . '/hello/' . $name;

        return \json_decode(\file_get_contents($uri), true);
    }
}
