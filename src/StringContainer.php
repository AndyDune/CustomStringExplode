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


namespace AndyDune\CustomStringExplode;
use AndyDune\CustomStringExplode\Rule\RuleAbstract;

class StringContainer
{
    protected $string;

    /**
     * @var RuleAbstract
     */
    protected $rule;

    protected $allowEmpty = false;

    public function __construct(RuleAbstract $rule = null)
    {
        if ($rule) {
            $this->setRule($rule);
        }
    }

    public function explode($string)
    {
        $result = [];

        $length = mb_strlen($string, 'utf-8');
        $item = '';
        for ($i = 0; $i < $length; $i++) {
            $char = mb_substr($string, $i, 1);
            if ($this->rule->check($char, $item, $result)) {
                $item .= $char;
                continue;
            }

            if ($item) {
                $result[] = $item;
            }
            $item = '';
        }

        // A last element
        if ($item) {
            $result[] = $item;
        }

        return $result;
    }

    public function setRule(RuleAbstract $rule)
    {
        $this->rule = $rule;
        $this->rule->setContainer($this);
        return $this;
    }

    /**
     * @param bool $allowEmpty
     * @return $this
     */
    public function setAllowEmpty($allowEmpty)
    {
        $this->allowEmpty = $allowEmpty;
        return $this;
    }

}