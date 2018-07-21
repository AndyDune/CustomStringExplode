<?php
/**
 *
 * PHP version >= 5.6
 *
 * @package andydune/custom-string-explode
 * @link  https://github.com/AndyDune/CustomStringExplode for the canonical source repository
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 * @author Andrey Ryzhov  <info@rznw.ru>
 * @copyright 2018 Andrey Ryzhov
 */


namespace AndyDuneTest\CustomStringExplode;
use AndyDune\CustomStringExplode\Rule\Numbers;
use AndyDune\CustomStringExplode\StringContainer;
use PHPUnit\Framework\TestCase;

class StringContainerTest extends TestCase
{
    public function testNumbers()
    {
        $numbers = new Numbers();

        $explode = new StringContainer($numbers);

        $results = $explode->explode('123 13-4 00');
        $this->assertCount(3, $results);
        $this->assertTrue(in_array('123', $results));
        $this->assertTrue(in_array('13', $results));
        $this->assertTrue(in_array('4', $results));

        $explode->setAllowEmpty(false);
        $results = $explode->explode('adsad asdasd  = =sad-iasknd ');
        $this->assertCount(0, $results);

    }
}