<?php
  class ExpressionTest extends PHPUnit_Framework_TestCase
  {
      function testFindString()
      {
        $regex = Expression::make()->find('www');

        $this->assertRegExp((string)$regex , 'www') ;

        $regex = Expression::make()->then('www');

        $this->assertRegExp((string)$regex , 'www') ;


      }
      function testAnything()
      {
        $regex = Expression::make()->anything();

        $this->assertRegExp((string)$regex , 'foo') ;
      }
      function testHasValue()
      {
        $regex = Expression::make()->maybe('http');
        $this->assertRegExp((string)$regex , 'http') ;
        $this->assertRegExp((string)$regex , 'foo') ;

      }
      function testChainMethod()
      {
        $regex = Expression::make()->find('foo')->maybe('bar')->then('biz');
        $this->assertRegExp((string)$regex , 'foobarbiz') ;

        }
  }
