<?php

namespace App;


 class product
 {

   protected $name , $price;

   public function __construct ($name , $price)
   {
     $this->name = $name ;
     $this->price = $price ;
   }
   public function name()
   {
     return $this->name;
   }
   public function price()
   {
     return $this->price;
   }
 }
