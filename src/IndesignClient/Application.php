<?php

namespace IndesignClient;

class Application {

    /** @var  Client $client */
    private $client;

    function __construct($client)
    {
        $this->client = $client;
    }

    /**
     * Get fonts installed on the server
     * @return array
     */
    public function getAllFonts()
    {
        $script = 'app.fonts';
        $return = $this->client->simpleRunScript($script);

        $fonts = array();

        foreach ($return->data->item as $id=>$item) {
            $fonts[$id] = $item->specifierData;
        }

        return $fonts;
    }

    /**
     * Get server version
     * @return string
     */
    public function getVersion()
    {
        $script = 'app.version';
        $return = $this->client->simpleRunScript($script);

        return (string)$return->data;
    }

    /**
     * Get the name of the application
     * @return string
     */
    public function  getName()
    {
        $script = 'app.name';
        $return = $this->client->simpleRunScript($script);

        return (string)$return->data;
    }

    /**
     * Get user serial number
     * @return string
     */
    public function getSerialNumber()
    {
        $script = 'app.serialNumber';
        $return = $this->client->simpleRunScript($script);

        return (string)$return->data;
    }

    /**
     * Get the user associated with the tracked changes and notes.
     * @return string
     */
    public function getUserName()
    {
        $script = 'app.userName';
        $return = $this->client->simpleRunScript($script);

        return (string)$return->data;
    }

    public function setUserName($userName)
    {
        $script = 'app.userName = "'.$userName.'"';
        $return = $this->client->simpleRunScript($script);

        return ($userName===$return->data);
    }

}