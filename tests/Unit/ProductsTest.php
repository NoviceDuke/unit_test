<?php
use App\Product;

/**
 *
 */
class ProductTest extends PHPUnit_Framework_TestCase
{
    function setup()
    {
      $this->product = new Product ('Fallout 4' , 60);
    }

    function testAProductHasName()
    {
      $this->assertequals('Fallout 4' , $this->product->name());
    }

    function testAProductHasPrice()
    {
      $this->assertequals(60, $this->product->price());
    }

}
