<?php

namespace IndesignClient;

class ApplicatiojTest extends \PHPUnit_Framework_TestCase {

    /** @var  \IndesignClient\Application $instance */
    private $instance;

    protected function setUp()
    {
        parent::setUp();
        $client = new Client("http://192.168.9.129:12345/service?wsdl");
        $this->instance = $client->getApplication();
    }

    public function testGetAllFonts()
    {
        $fonts = $this->instance->getAllFonts();
        $this->assertInternalType('array', $fonts);
        $this->assertGreaterThan(0, count($fonts));
    }

    public function testGetVersion()
    {
        $version = $this->instance->getVersion();
        $this->assertInternalType('string', $version);
        $this->assertGreaterThan(0, strlen($version));
    }

    public function testGetName()
    {
        $name = $this->instance->getName();
        $this->assertInternalType('string', $name);
        $this->assertGreaterThan(0, strlen($name));
    }

    public function testGetSerialNumber()
    {
        $serial = $this->instance->getSerialNumber();
        $this->assertInternalType('string', $serial);
        $this->assertGreaterThan(0, strlen($serial));
    }

    public function testSetUserName()
    {
        $name = "foo".time();
        $return  = $this->instance->setUserName($name);
        $this->assertEquals(true, $return);
        $this->assertEquals($name, $this->instance->getUserName());
    }
}