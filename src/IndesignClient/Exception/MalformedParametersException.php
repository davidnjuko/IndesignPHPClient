<?php

namespace IndesignClient\Exception;

use Exception;

class MalformedParametersException extends \Exception
{
    public function __construct($fields)
    {
        if (is_array($fields)) {
            $field = implode(" or ", $fields);
        } else {
            $field = $fields;
        }

        $message = "Missing parameter: ".$field;
        parent::__construct($message, 1);
    }

}