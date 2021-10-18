<?php

namespace App\Core;

class Response
{

    public function json($res)
    {
        echo json_encode($res);
    }

    public function text($res)
    {
        echo $res;
    }
}