<?php

namespace J3dyy\SmsOfficeApi\Tools;


class Validator
{

    /**
     * @param string $s
     * @param int $minDigits
     * @param int $maxDigits
     * @return bool
     */
    public static function isDigits(string $s, int $minDigits = 9, int $maxDigits = 14): bool {
        return preg_match('/^[0-9]{'.$minDigits.','.$maxDigits.'}\z/', $s);
    }

}