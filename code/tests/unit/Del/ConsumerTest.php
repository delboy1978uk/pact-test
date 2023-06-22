<?php

namespace Del;

use Codeception\TestCase\Test;
use PhpPact\Consumer\InteractionBuilder;
use PhpPact\Consumer\Matcher\Matcher;
use PhpPact\Consumer\Model\ConsumerRequest;
use PhpPact\Consumer\Model\ProviderResponse;
use PhpPact\Standalone\MockService\MockServerEnvConfig;

class ConsumerTest extends Test
{
    public function testHelloApi()
    {
        $request = new ConsumerRequest();
        $request
            ->setMethod('GET')
            ->setPath('/hello/Bob');

        $matcher = new Matcher();
        $response = new ProviderResponse();
        $response
            ->setStatus(200)
            ->addHeader('Content-Type', 'application/json')
            ->setBody([
                'result' => 'success',
                'message' => $matcher->regex('Hello, Bob', '(Hello, )[A-Za-z]')
            ]);

        $config  = new MockServerEnvConfig();
        $builder = new InteractionBuilder($config);
        $builder
            ->given('a person exists')
            ->uponReceiving('a get request to /hello/{name}')
            ->with($request)
            ->willRespondWith($response);

        // We call the mock server and not the real API, with the real API class
        $api = new HelloApi($config->getBaseUri());
        $result  = $api->hello('Bob');
        $this->assertIsArray($result);
        $this->assertArrayHasKey('result', $result);
        $this->assertArrayHasKey('message', $result);
        $this->assertEquals('success', $result['result']);
        $this->assertEquals('Hello, Bob', $result['message']);
    }
}
