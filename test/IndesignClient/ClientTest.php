<?php

namespace IndesignClient;

class ClientTest extends \PHPUnit_Framework_TestCase {

    /** @var  \IndesignClient\Client $instance */
    private $instance;

    protected function setUp()
    {
        parent::setUp();
        $this->instance = new Client("http://192.168.9.129:12345/service?wsdl");
    }


    public function testExtends() {
        $this->assertInstanceOf('SoapClient', $this->instance);
    }

    public function testDefaultMethodeCall() {
        $this->instance->doRunScript(array(
            "scriptText" => '',
        ));
    }

    public function testMalformedExeptionIsThrown() {
        $this->setExpectedException('IndesignClient\Exception\MalformedParametersException');
        $this->instance->doRunScript(array());
    }
}