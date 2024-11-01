<?php
/**
 * @license MIT
 *
 * Modified by Atanas Angelov on 01-October-2024 using Strauss.
 * @see https://github.com/BrianHenryIE/strauss
 */

if (\PHP_VERSION_ID < 80000 && !interface_exists('CoffeeCode_Stringable')) {
    interface CoffeeCode_Stringable
    {
        /**
         * @return string
         */
        public function __toString();
    }
}
