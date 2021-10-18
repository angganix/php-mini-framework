<?php

namespace App\Core;

class Request {

	private function cleanInput($input)
	{
		return htmlspecialchars(urldecode(stripslashes($input)));
	}

	private $req = [];


    public function __construct()
    {
        $this->jsonRequest();
        $this->req = $this->all();
    }

    private function jsonRequest()
    {
        if ($_SERVER['REQUEST_METHOD'] === "POST" && empty($_REQUEST)) {
            $_REQUEST = json_decode(file_get_contents('php://input'), true);
        }

        if ($_SERVER['REQUEST_METHOD'] === "POST" && empty($_POST)) {
            $_POST = json_decode(file_get_contents('php://input'), true);
        }
    }

    public function __get($name)
    {
        return $this->req[$name] ?? null;
    }

    public function get($name)
    {
        if (isset($_GET[$name])) {
            return $this->cleanInput($_GET[$name]);
        }
        return null;
    }

    public function post($name)
    {
        if (isset($_POST[$name])) {
            return $this->cleanInput($_POST[$name]);
        }
        return null;
    }

    public function all()
    {
        $all_req = [];

        foreach ($_REQUEST as $key => $req) {
            $all_req[$key] = $this->cleanInput($req);
        }
        return $all_req;
    }

    public function except($except_list = [])
    {
        $filtered_request   = [];
        $fixed_request      = [];

        if (count($except_list)) {
            $filtered_request = array_filter($_REQUEST, function ($var) use ($except_list) {
                return !in_array($var, $except_list);
            }, ARRAY_FILTER_USE_KEY);
            return $filtered_request;
        }

        foreach ($filtered_request as $key => $val) {
            $fixed_request[$key] = $this->cleanInput($val);
        }

        return $fixed_request;
    }

}