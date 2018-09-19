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

namespace AndyDune\CustomStringExplode\Rule;


class NumbersAndLatinLetters extends RuleAbstract
{
    public function check($char, $item, $array)
    {
        if (preg_match('|[a-z0-9]+|ui', $char)) {
            return true;
        }
        return false;
    }

    /**
     * Format each result by default.
     * You may overload this method.
     *
     * @param $string
     * @return string
     */
    public function format($string)
    {
        $string = trim($string);
        if (strlen($string) < 1) {
            return null;
        }
        return $string;
    }

}