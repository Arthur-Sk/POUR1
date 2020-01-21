<?php


namespace Helper;


class MathHelper
{
    public static function gcd(int $a, int $b): ?int
    {
        $gcdResource = gmp_gcd($a, $b);

        return (int)gmp_strval($gcdResource);
    }
}