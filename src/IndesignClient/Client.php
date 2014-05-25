<?php

namespace IndesignClient;

/**
 * Client
 *
 * @category   IndesignPHPClient
 * @package    IndesignClien
 * @author     david ribes <ribes.david@gmail.com>
 */

class Client extends \SoapClient {

    private $scriptLanguage = 'javascript';

    function __construct($wsdl = 'http://127.0.0.1:12345/service?wsdl')
    {
        $this->SoapClient($wsdl, array(
            'compression' => SOAP_COMPRESSION_ACCEPT | SOAP_COMPRESSION_GZIP,
            'proxy_port'  =>  12345,
            'proxy_host'  =>  '192.168.9.129',
        ));
    }

    /**
     * Call main function of Indesign Server API
     * @param array $scriptParameters
     */
    function doRunScript(array $scriptParameters)
    {
        if (!array_key_exists('scriptLanguage',$scriptParameters)) {
            $scriptParameters['scriptLanguage'] = $this->scriptLanguage;
        }

        if ($this->validScriptParameters($scriptParameters)) {
            $this->RunScript(array("runScriptParameters" => $scriptParameters));
        }
    }

    /**
     * @param $script
     * @param array $parameters
     */
    function simpleRunScript($script, $parameters = array())
    {
        $this->doRunScript(array(
            'scriptText'    =>  $script,
            'script_parameters' =>  $parameters
        ));
    }

    /**
     * @param $scriptParameters
     * @return bool
     * @throws Exception\MalformedParametersException
     */
    private function validScriptParameters($scriptParameters)
    {
        if (!array_key_exists('scriptLanguage',$scriptParameters)) {
            throw new Exception\MalformedParametersException('scriptLanguage');
        }

        if (!array_key_exists('scriptText',$scriptParameters) and !array_key_exists('scriptFile',$scriptParameters)) {
            throw new Exception\MalformedParametersException(array('scriptText', 'scriptFile'));
        }

        return true;
    }
}