<?php

namespace App\Controllers;

use App\Classes\User;
use App\Core\Controller;

class UserController extends Controller {

   public function __construct()
   {
      parent::__construct();
      $this->user = new User();
   }

   public function index()
   {
      return view("user");
   }

   public function getList()
   {
      $data = $this->user->find();
      return $this->response->json($data);
   }

   public function getRow($request)
   {
      $data = $this->user->findOne($request->id);
      return $this->response->json($data);
   }

   public function create($request)
   {
      $result = $this->user->insert([
         $request->username,
         $request->password,
         $request->fullname,
         $request->email
      ]);
      return $this->response->json($result);
   }

   public function update($request)
   {
      $result = $this->user->update([
         $request->fullname,
         $request->email,
         $request->is_del,
         $request->id
      ]);
      return $this->response->json($result);
   }

   public function destroy($request)
   {
      $result = $this->user->delete($request->id);
      return $this->response->json($result);
   }

}