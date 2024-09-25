<?php

namespace PcbKernel\Event;

use InvalidArgumentException;
use JsonSerializable;
use PcbKernel\Support\Str;
use ReflectionClass;

class EventMessage implements JsonSerializable
{
    /**
     * @var string
     */
    protected $uuid;

    /**
     * @var string
     */
    protected $type;

    /**
     * @var mixed
     */
    protected $data;

    /**
     * @var array
     */
    protected $metadata = [];

    /**
     * @var int
     */
    protected $timestamp;

    /**
     * @param string $type
     * @param mixed $data
     * @param array $metadata
     */
    public function __construct($type, $data, array $metadata = [])
    {
        $this->validateEventType($type);

        $this->type = $type;
        $this->data = $data;
        $this->metadata = $metadata;

        $this->timestamp = $this->generateTimestamp();
        $this->uuid = $this->generateUuid();
    }

    /**
     * @param string $type
     * @return void
     * @throws \InvalidArgumentException
     */
    protected function validateEventType($type)
    {
        $eventTypes = (new ReflectionClass(EventType::class))->getConstants();

        if (!in_array($type, $eventTypes)) {
            throw new InvalidArgumentException("Invalid event type: $type");
        }
    }

    /**
     * @return int
     */
    private function generateTimestamp()
    {
        return time();
    }

    /**
     * @return string
     */
    private function generateUuid()
    {
        return (string) Str::uuid();
    }

    /**
     * @return string
     */
    public function getUuid()
    {
        return $this->uuid;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @return array
     */
    public function getMetadata()
    {
        return $this->metadata;
    }

    /**
     * @return int
     */
    public function getTimestamp()
    {
        return $this->timestamp;
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return [
            'uuid' => $this->uuid,
            'type' => $this->type,
            'data' => $this->data,
            'timestamp' => $this->timestamp,
            'metadata' => $this->metadata,
        ];
    }
}
