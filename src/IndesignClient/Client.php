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

    private $port = '12345';
    private $ip = '127.0.0.1';

    function __construct($wsdl = 'http://127.0.0.1:12345/service?wsdl')
    {
        preg_match('/[0-9.]+/', $wsdl, $ipMatches);
        preg_match('/:[0-9]+/', $wsdl, $portMatches);

        $this->setIp($ipMatches[0]);
        $this->setPort(str_replace(":","",$portMatches[0]));

        $this->SoapClient($wsdl, array(
            'compression' => SOAP_COMPRESSION_ACCEPT | SOAP_COMPRESSION_GZIP,
            'proxy_port'  =>  $this->port,
            'proxy_host'  =>  $ipMatches[0],
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

    /**
     * @param string $ip
     * @return $this
     */
    public function setIp($ip)
    {
        $this->ip = $ip;
        return $this;
    }

    /**
     * @return string
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * @param string $port
     * @return $this
     */
    public function setPort($port)
    {
        $this->port = $port;
        return $this;
    }

    /**
     * @return string
     */
    public function getPort()
    {
        return $this->port;
    }

    /**
     * @param string $scriptLanguage
     * @return $this
     */
    public function setScriptLanguage($scriptLanguage)
    {
        $this->scriptLanguage = $scriptLanguage;
        return $this;
    }

    /**
     * @return string
     */
    public function getScriptLanguage()
    {
        return $this->scriptLanguage;
    }


}