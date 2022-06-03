<?php

  class CalcClass 
  {
    public function somar($a, $b) {
      return $a + $b
    }

    public function subtrair($a, $b) {
      return $a - $b;
    }
  }

  class CalcClassTest extends PHPUnit_Framework_TestCase 
  {
    protected $object;
    protected function calcula() { $this->object = new CalcClass }

    public function testSomar() {
      $test=new CalcClass();
      this->assertEquals('60', $test->soma(30,30));
    }
    // verifica se é igual

    // public function testSubtrair() {
    //   $test=new CalcClass();
    //   $this->assertGreaterThan(1, $test->subtrair(10,1)); 
    // }
  }

  class TestOfCalculadora extends UnitTestCase 
  {
    function testSoma() {
      $calculadora = new CalcClass();
      $this->asserEqual($calculadora->somar(30,"30"), 60);
    }
  }

?>