<?php declare(strict_types = 1);

namespace App\Network;

final class PhpUrlIdGeneratorMK extends AbstractUrlIdGeneratorMK
{
    /**
     * Reference https://www.sitepoint.com/create-unique-64bit-integer-string/
     * @param string $url
     * @return string
     */
    protected function generateId(string $url) : string
    {
        $getIdValue = gmp_strval(gmp_init(substr(sha1($url), 0, 16), 16));
        return $getIdValue;


    }


}
