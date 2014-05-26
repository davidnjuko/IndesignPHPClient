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

        return $return->data;
    }


}