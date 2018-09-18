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


class CustomDelimiter extends RuleAbstract
{
    protected $delimiterSymbols = '';
    protected $leaveEmpty = false;


    public function __construct($delimiterSymbols = '', $leaveEmpty = false)
    {
        $this->delimiterSymbols = $delimiterSymbols;
        $this->leaveEmpty = $leaveEmpty;
    }

    public function format($string)
    {
        $result = trim($string);

        if ($this->leaveEmpty) {
            return $result;
        }

        if ($result === '') {
            return null;
        }
        return $result;
    }


    public function check($char, $item, $array)
    {
        if (preg_match('|[' . $this->delimiterSymbols . ']+|', $char)) {
            return false;
        }
        return true;
    }

}