<?php

namespace App\Services\Encryption;

/**
 * Class RsaService
 *
 * @package App\Services
 * @author efriandika
 */
class RsaService
{
    protected $publicKeyPath;
    protected $privateKeyPath;
    protected $password;

    /**
     * RsaService constructor.
     */
    public function __construct()
    {
        $this->publicKeyPath = base_path('key/2048-public.pem');
        $this->privateKeyPath = base_path('key/2048-private.pem');
        $this->password = '';
    }

    /**
     * Get public key
     *
     * @return bool|string
     */
    public function getPublicKey() {
        return file_get_contents($this->publicKeyPath);
    }

    /**
     * get private key
     *
     * @return bool|string
     */
    public function getPrivateKey() {
        return file_get_contents($this->privateKeyPath);
    }

    /**
     * Encrypt data by using private key
     *
     * @param $data
     * @return string
     */
    public function encrypt($data)
    {
        $rsa = new RSA($this->getPublicKey(), $this->getPrivateKey(), $this->password);
        return $rsa->base64Encrypt($data);
    }

    /**
     * Decrypt data by using public key
     *
     * @param $data
     * @return string
     */
    public function decrypt($data)
    {
        $rsa = new RSA($this->getPublicKey(), $this->getPrivateKey(), $this->password);
        return $rsa->base64Decrypt($data);
    }
}