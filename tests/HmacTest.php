<?php

namespace PcbKernel\Tests;

use InvalidArgumentException;
use PcbKernel\Signers\Hmac;
use PHPUnit\Framework\TestCase;

class HmacTest extends TestCase
{
    protected $secret = 'supersecret';

    public function testSignGeneratesValidSignature()
    {
        $result = Hmac::sign($this->secret);

        $this->assertArrayHasKey('timestamp', $result);
        $this->assertArrayHasKey('nonce', $result);
        $this->assertArrayHasKey('signature', $result);

        $this->assertIsInt($result['timestamp']);

        $this->assertMatchesRegularExpression('/^[a-f0-9]{12}$/', $result['nonce']);

        $this->assertNotEmpty($result['signature']);
    }

    public function testVerifyValidSignature()
    {
        $result = Hmac::sign($this->secret);

        $isValid = Hmac::verify(
            $this->secret,
            $result['timestamp'],
            $result['nonce'],
            $result['signature']
        );

        $this->assertTrue($isValid);
    }

    public function testVerifyInvalidSignature()
    {
        $result = Hmac::sign($this->secret);

        $isValid = Hmac::verify(
            $this->secret,
            $result['timestamp'],
            $result['nonce'],
            $result['signature'] . 'invalid'
        );

        $this->assertFalse($isValid);
    }

    public function testInvalidHashAlgorithmInSign()
    {
        $this->expectException(InvalidArgumentException::class);

        Hmac::sign($this->secret, 'invalid_algo');
    }

    public function testInvalidHashAlgorithmInVerify()
    {
        $this->expectException(InvalidArgumentException::class);

        Hmac::verify($this->secret, time(), 'nonce', 'signature', 'invalid_algo');
    }
}
