<?php

namespace PcbKernel\Signers;

use Exception;
use InvalidArgumentException;
use RuntimeException;

class Hmac
{
    /**
     * @param string $secret
     * @param string $algo
     * @return array
     * @throws \InvalidArgumentException
     * @throws \RuntimeException
     */
    public static function sign($secret, $algo = 'sha1')
    {
        if (!in_array($algo, hash_hmac_algos())) {
            throw new InvalidArgumentException("Invalid hash algorithm: $algo");
        }

        try {
            $nonce = bin2hex(random_bytes(6));
        } catch (Exception $e) {
            throw new RuntimeException($e->getMessage());
        }

        $timestamp = time();

        $tmparr = [$secret, $timestamp, $nonce];

        sort($tmparr, SORT_STRING);

        $signature = hash_hmac($algo, implode($tmparr), $secret);

        return compact('timestamp', 'nonce', 'signature');
    }

    /**
     * @param string $secret
     * @param int $timestamp
     * @param string $nonce
     * @param string $signature
     * @param string $algo
     * @return bool
     * @throws \InvalidArgumentException
     */
    public static function verify($secret, $timestamp, $nonce, $signature, $algo = 'sha1')
    {
        if (!in_array($algo, hash_hmac_algos())) {
            throw new InvalidArgumentException("Invalid hash algorithm: $algo");
        }

        $tmparr = [$secret, $timestamp, $nonce];

        sort($tmparr, SORT_STRING);

        $expected = hash_hmac($algo, implode($tmparr), $secret);

        return hash_equals($expected, $signature);
    }
}
