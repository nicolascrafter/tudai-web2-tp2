<?php

class ApiController {

    public function getData() 
    {
        return json_decode(file_get_contents('php://input'));
    }

}