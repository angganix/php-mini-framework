<?php

namespace App\Core;

use App\Core\Response;

class Controller {

	protected $response;

	public function __construct()
	{
		$this->response = new Response();
	}

}