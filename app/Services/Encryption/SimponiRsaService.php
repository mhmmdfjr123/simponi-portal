<?php

namespace App\Services\Encryption;

/**
 * Wrapper class for RsaService,
 * NOTE: This class is just for portal and branch service only.
 * For another, please use RsaService instead.
 *
 * @package App\Services
 * @author efriandika
 */
class SimponiRsaService
{
    protected $rsaService;

    /**
     * SimponiRsaService constructor.
     * @param RsaService $rsaService
     */
    public function __construct(RsaService $rsaService)
    {
        $this->rsaService = $rsaService;
    }

    /**
     * RSA Service
     * @return RsaService
     */
    public function rsa() {
        return $this->rsaService;
    }

    /**
     * Get public key
     *
     * @return bool|string
     */
    public function getPublicKey() {
        return $this->rsaService->getPublicKey();
    }

    /**
     * get private key
     *
     * @return bool|string
     */
    public function getPrivateKey() {
        return $this->rsaService->getPrivateKey();
    }

    /**
     * Encrypt data by using private key
     *
     * @param $data
     * @return string
     */
    public function encrypt($data)
    {
        return $this->rsaService->encrypt($data);
    }

    /**
     * Decrypt data by using public key
     *
     * @param $data
     * @return string
     */
    public function decrypt($data)
    {
        if (config('app.portal.api.encryption')) {
            // By pass RSA Service decryption.
            // RSA Decryption from BACKEND API will be used instead
            return $data;
        } else {
            // Decrypt data by using RSA Service
            return $this->rsaService->decrypt($data);
        }
    }
}