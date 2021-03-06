<?php

/*
 * Created by Roman Senchuk.
 * at 22.12.17 14:10
 */

require __DIR__.'/vendor/autoload.php';
require 'Asserter.php';

/**
 * Class AsserterTest
 * @author Roman Senchuk frspm.roman@gmail.com
 */
class AsserterTest extends \PHPUnit\Framework\TestCase
{

    public $expression1 = '200+12*((1/8)+1)-19';

    /**
     * @var Asserter
     */
    protected $assert;

    protected function setUp()
    {
        $this->assert = new Asserter();
    }


    public function testPrsNumber()
    {
        $number = '235Єва';
        $result = $this->assert->prsNumber($number);
        self::assertEquals(235, $result);
    }

    public function testPrsTerm()
    {
        $term = '(7)';
        $result = $this->assert->prsTerm($term);
        self::assertEquals(7, $result);
    }

    public function testPrsFactor()
    {
        $factor = '12 *5*2';
        $result = $this->assert->prsFactor($factor);

        self::assertEquals(120, $result);
    }

    public function testPrsExpression()
    {
        /* test Negative sign numbers */
        $negativeExpression = '(-7)+(-13-5)';
        $result = $this->assert->prsExpression($negativeExpression);
        self::assertEquals(-15, $result);

        /*
         *
         * Main Test
         */
        $result = $this->assert->prsExpression($this->expression1);
        self::assertEquals(194.5, $result);
    }
}
