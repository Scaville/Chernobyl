<?php

namespace Scaville\Chernobyl\Cypher;

class HASH{

    /**
     * Crypt a string on MD5 with HMAC
     * @param string $value
     * @param string $key
     * @return string
     * @throws \Exception
     */
    public static function MD5_HMAC($value, $key) {
        return hash_hmac('md5', $value, $key);
    }

    /**
     * Crypt a string on SHA-256 with HMAC
     * @param string $value
     * @param string $key
     * @return string
     * @throws \Exception
     */
    public static function SHA_256_HMAC($value, $key) {
        return hash_hmac('sha256', $value, $key);
    }
}