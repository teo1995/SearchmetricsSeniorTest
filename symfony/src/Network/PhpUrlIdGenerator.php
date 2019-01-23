<?php declare(strict_types = 1);

namespace App\Network;

use App\Connection\DBConnection;

final class PhpUrlIdGenerator extends AbstractUrlIdGenerator
{

    /**
     * @param string $url
     * @return string
     */
    protected function generateId(string $url) : string
    {
            $url = sha1($url);
            $query = "SELECT CAST(CONV(SUBSTRING('$url', 1, 16), 16, 10) AS UNSIGNED)";
            $result = DBConnection::getInstance()->selectDB($query)->fetch_row();
            $getIdValue = (string)array_values($result)[0];
            return $getIdValue;
    }


}
