<?php
use App\Product;
use App\Order;

/**
 *
 */
class OrderTest extends PHPUnit_Framework_TestCase
{
  function test_an_consist_of_order()
  {
    $order = new Order;

    $product = new Product('apple',60);
    $product2 = new Product('banana',50);

    $order->add($product);
    $order->add($product2);

    $this->assertequals(2,count($order->products()));
  }

  function test_total_cost()
  {
    $order = new Order;

    $product = new Product('apple',60);
    $product2 = new Product('banana',50);

    $order->add($product);
    $order->add($product2);

    $this->assertequals(110,$order->total());

  }

}
