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


class Email extends RuleAbstract
{
    public function format($email)
    {
        $email = trim($email);

        if (!$email) {
            return null;
        }
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }


    public function check($char, $item, $array)
    {
        if (preg_match('|[-_a-z0-9.!#$%&\'"*+-/=?^_`{\|}~@]+|ui', $char)) {
            return true;
        }
        return false;
    }
}