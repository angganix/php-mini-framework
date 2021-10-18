<?php

namespace App\Controllers;

class DefaultController {

   public function index($request)
   {
      return view("home");
   }

}