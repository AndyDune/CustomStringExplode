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

use AndyDune\CustomStringExplode\Rule\CustomDelimiter;
use AndyDune\CustomStringExplode\Rule\DelimiterWhitespaceCharacter;
use AndyDune\CustomStringExplode\Rule\Email;
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
        $this->assertCount(4, $results);
        $this->assertTrue(in_array('123', $results));
        $this->assertTrue(in_array('13', $results));
        $this->assertTrue(in_array('4', $results));

        $explode->setAllowEmpty(false);
        $results = $explode->explode('adsad asdasd  = =sad-iasknd ');
        $this->assertCount(0, $results);

        $results = $explode->explode('123');
        $this->assertCount(1, $results);
        $this->assertTrue(in_array('123', $results));
    }

    public function testDelimiterWhitespaceCharacter()
    {
        $rule = new DelimiterWhitespaceCharacter();

        $explode = new StringContainer($rule);

        $results = $explode->explode('123 13-4 00');
        $this->assertCount(3, $results);
        $this->assertTrue(in_array('123', $results));
        $this->assertTrue(in_array('13-4', $results));
        $this->assertTrue(in_array('00', $results));

        $results = $explode->explode('123 13-4    
                00');
        $this->assertCount(3, $results);
        $this->assertTrue(in_array('123', $results));
        $this->assertTrue(in_array('13-4', $results));
        $this->assertTrue(in_array('00', $results));


        $results = $explode->explode('123 ');
        $this->assertCount(1, $results);

        $results = $explode->explode('  
         
         ');
        $this->assertCount(0, $results);


        $rule = new DelimiterWhitespaceCharacter(',;');

        $explode = new StringContainer($rule);

        $results = $explode->explode('123; 13-4 , 00    ,');
        $this->assertCount(3, $results);
        $this->assertTrue(in_array('123', $results));
        $this->assertTrue(in_array('13-4', $results));
        $this->assertTrue(in_array('00', $results));


        $rule = new DelimiterWhitespaceCharacter(',;');

        $explode = new StringContainer($rule);

        $results = $explode->explode('
         rzn@rznw.ru,
         mail.as@mail.ru
         ');
        $this->assertCount(2, $results);
        $this->assertTrue(in_array('rzn@rznw.ru', $results));
        $this->assertTrue(in_array('mail.as@mail.ru', $results));
    }

    public function testCustomDelimiter()
    {
        $rule = new CustomDelimiter(',;');
        $explode = new StringContainer($rule);

        $results = $explode->explode('Андрей Рыжов,  ;
        Andrey Ryzhov
        ');
        $this->assertCount(2, $results);
        $this->assertTrue(in_array('Андрей Рыжов', $results));
        $this->assertTrue(in_array('Andrey Ryzhov', $results));
    }


    public function testEmail()
    {
        $rule = new Email();
        $explode = new StringContainer($rule);

        $results = $explode->explode('Андрей Рыжов,  ;
        Andrey Ryzhov
        simple@example.com
        disposable.style.email.with+symbol@example.com
        x@example.com
        #!$%&\'*+-/=?^_`{}|~@example.org
        "()<>[]:,;@\\\"!#$%&\'-/=?^_`{}| ~.a"@example.org
        " "@example.org
        ');
        $this->assertCount(4, $results);
        $this->assertTrue(in_array('simple@example.com', $results));
        $this->assertTrue(in_array('#!$%&\'*+-/=?^_`{}|~@example.org', $results));

    }
}