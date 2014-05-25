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
}