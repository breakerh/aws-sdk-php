<?php

namespace Aws\Test\ClientSideMonitoring;

use Aws\ClientSideMonitoring\Configuration;
use PHPUnit\Framework\TestCase;
use Psr\Log\InvalidArgumentException;


/**
 * @covers \Aws\ClientSideMonitoring\Configuration
 */
class ConfigurationTest extends TestCase
{

    public function testGetsCorrectValues()
    {
        $config = new Configuration(true, 888, 'FooApp');
        $this->assertTrue($config->isEnabled());
        $this->assertSame(888, $config->getPort());
        $this->assertSame('FooApp', $config->getClientId());
    }

    public function testToArray()
    {
        $config = new Configuration(true, 888, 'FooApp');
        $expected = [
            'enabled' => true,
            'port' => 888,
            'client_id' => 'FooApp'
        ];
        $this->assertEquals($expected, $config->toArray());
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testHandlesInvalidPort()
    {
        new Configuration(true, 'invalidport', 'FooApp');
    }

    public function testHandlesInvalidEnabled()
    {
        $config = new Configuration('invalidvalue', 123, 'FooApp');
        $this->assertFalse($config->isEnabled());
    }
}
