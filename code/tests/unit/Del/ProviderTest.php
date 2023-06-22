<?php

namespace unit\Del;

use Codeception\TestCase\Test;
use GuzzleHttp\Psr7\Uri;
use PhpPact\Standalone\ProviderVerifier\Model\VerifierConfig;
use PhpPact\Standalone\ProviderVerifier\Verifier;

class ProviderTest extends Test
{
    public function testHelloApi()
    {
        $config = new VerifierConfig();
        $config
            ->setProviderName('HelloApi') // Providers name to fetch.
            ->setProviderVersion('1.0.0') // Providers version.
            ->setProviderBranch('develop') // Providers git branch name.
            ->setProviderBaseUrl(new Uri('http://awesome.scot')) // URL of the Provider.
            ->setProviderStatesSetupUrl('http://awesome.scot/tests/pact-state-setup')
            ->setBrokerUri(new Uri('http://pact-broker:9292')) // URL of the Pact Broker to publish results.
            ->setPublishResults(true) // Flag the verifier service to publish the results to the Pact Broker.
            ->setEnablePending(true) // Flag to enable pending pacts feature (check pact docs for further info)
            ->setIncludeWipPactSince('2020-01-30'); //Start date of WIP Pacts (check pact docs for further info)

        // Verify that all consumers of 'someProvider' are valid.
        $verifier = new Verifier($config);
        $verifier->verifyAll();
        $this->assertTrue(true, 'This will not be reached if the PACT verifier throws an error, otherwise it was successful');
    }
}
