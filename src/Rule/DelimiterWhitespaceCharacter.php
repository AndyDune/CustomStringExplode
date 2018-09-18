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


class DelimiterWhitespaceCharacter extends RuleAbstract
{

    protected $delimiterSymbols = '';

    public function __construct($delimiterSymbols = '')
    {
        $this->delimiterSymbols = $delimiterSymbols;
    }

    public function check($char, $item, $array)
    {
        if (preg_match('|[\s' . $this->delimiterSymbols . ']+|', $char)) {
            return false;
        }
        return true;
    }
}