<?php

declare(strict_types=1);

namespace App\Helpers;

use InvalidArgumentException;

/**
 * Class OrderByHelper
 * @package App\Helpers
 */
class OrderByHelper
{
    public static function treatOrderBy(string $orderBy): array
    {
        $orderByArray = [];

        foreach (explode(',', $orderBy) as $value) {
            $value = trim($value);

            if (!preg_match("/^(-)?[A-Za-z0-9_]+$/", $value)) {
                throw new InvalidArgumentException('O parâmetro "order_by" não está em um formato válido.');
            }

            $orderByArray[$value] = 'ASC';

            if (strstr($value, '-')) {
                $orderByArray[$value] = 'DESC';
            }
        }

        return $orderByArray;
    }
}
