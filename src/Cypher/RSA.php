<?php

namespace Scaville\Chernobyl\Cypher;

use phpseclib\Crypt\RSA as ALGO;

class RSA {

    private $publicKey;
    private $privateKey;

    /**
     * Generate the key pair public/private RSA.
     * @return array
     */
    public function generateKeys() {
        $rsa = new ALGO();
        $rsa->setPublicKeyFormat(ALGO::PUBLIC_FORMAT_OPENSSH);
        extract($rsa->createKey(4096));
        return array(
            "publicKey" => base64_encode($publickey),
            "privateKey" => base64_encode($privatekey)
        );
    }
    
    /**
     * Load the public key.
     * @param base64 $key
     */
    public function loadPublicKey($key) {
        $this->publicKey = base64_decode($key);
    }

    /**
     * Load the private key.
     * @param base64 $key
     */
    public function loadPrivateKey($key) {
        $this->privateKey = base64_decode($key);
    }
    
    /**
     * Decrypt using the private key.
     * @param base64 $value
     * @param base64 $key
     * @return string
     * @throws \Exception
     */
    public function decrypt($value, $key = null) {
        $rsa = new ALGO();
        $rsa->setPublicKeyFormat(ALGO::PUBLIC_FORMAT_OPENSSH);
        $key = (null !== $this->privateKey) ? $this->privateKey : base64_decode($key);
        
        if(null === $key){
            throw new \Exception("Private key not defined!");
        }
        
        $rsa->loadKey($key);
        
        return $rsa->decrypt(base64_decode($value));
    }

    /**
     * Crypt using the private key.
     * @param string $value
     * @param base64 $key
     * @return base64
     * @throws \Exception
     */
    public function encrypt($value, $key = null) {
        $rsa = new ALGO();
        $rsa->setPublicKeyFormat(ALGO::PUBLIC_FORMAT_OPENSSH);
        
        $key = (null !== $this->publicKey) ? $this->publicKey : base64_decode($key);
        
        if(null === $key){
            throw new Exception("Private key or key not defined!");
        }
        
        $rsa->loadKey($key);
        
        return base64_encode($rsa->encrypt($value));
    }
}