<?php

namespace PcbKernel\Tests;

use InvalidArgumentException;
use PcbKernel\Event\EventMessage;
use PcbKernel\Event\EventType;
use PcbKernel\Support\Str;
use PHPUnit\Framework\TestCase;

class EventMessageTest extends TestCase
{
    protected $eventData;

    protected function setUp(): void
    {
        $this->eventData = ['order_id' => 123, 'status' => 'approved'];
    }

    public function testValidEventCreation()
    {
        $eventMessage = new EventMessage(EventType::SALES_ORDER_APPROVED, $this->eventData);

        $this->assertEquals(EventType::SALES_ORDER_APPROVED, $eventMessage->getType());

        $this->assertEquals($this->eventData, $eventMessage->getData());

        $this->assertEquals([], $eventMessage->getMetadata());

        $this->assertLessThanOrEqual(time(), $eventMessage->getTimestamp());

        $this->assertNotEmpty($eventMessage->getUuid());
        $this->assertTrue(Str::isUuid($eventMessage->getUuid()));
    }

    public function testInvalidEventTypeThrowsException()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid event type');

        new EventMessage('invalid_event_type', $this->eventData);
    }

    public function testEventMessageWithMetadata()
    {
        $metadata = ['source' => 'api', 'user' => 'admin'];
        $eventMessage = new EventMessage(EventType::SALES_ORDER_CREATED, $this->eventData, $metadata);

        $this->assertEquals($metadata, $eventMessage->getMetadata());
    }

    public function testJsonSerialize()
    {
        $eventMessage = new EventMessage(EventType::USER_REGISTERED, $this->eventData);

        $jsonData = $eventMessage->jsonSerialize();

        $this->assertArrayHasKey('uuid', $jsonData);
        $this->assertArrayHasKey('type', $jsonData);
        $this->assertArrayHasKey('data', $jsonData);
        $this->assertArrayHasKey('timestamp', $jsonData);
        $this->assertArrayHasKey('metadata', $jsonData);

        $this->assertEquals(EventType::USER_REGISTERED, $jsonData['type']);
        $this->assertEquals($this->eventData, $jsonData['data']);
        $this->assertEquals([], $jsonData['metadata']);
    }
}
