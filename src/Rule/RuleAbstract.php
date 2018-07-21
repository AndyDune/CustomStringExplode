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


use AndyDune\CustomStringExplode\StringContainer;

abstract class RuleAbstract
{
    /**
     * @var StringContainer
     */
    protected $container;

    /**
     * @return StringContainer
     */
    public function getContainer()
    {
        return $this->container;
    }

    /**
     * @param StringContainer $container
     */
    public function setContainer($container)
    {
        $this->container = $container;
    }


    abstract public function check($char, $item, $array);
}