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


class Numbers extends RuleAbstract
{
    public function check($char, $item, $array)
    {
        if (preg_match('|[0-9]+|', $char)) {
            return true;
        }
        return false;
    }
}