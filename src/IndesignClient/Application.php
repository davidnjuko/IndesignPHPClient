<?php

namespace IndesignClient;

class Application {

    /** @var  Client $client */
    private $client;

    function __construct($client)
    {
        $this->client = $client;
    }

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

}