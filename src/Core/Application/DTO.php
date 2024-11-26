<?php

namespace PragmaGoTech\Interview\Core\Application;

abstract class DTO
{
    public function __construct(array $data = [])
    {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $this->castProperty($key, $value);
            }
        }
    }
    protected function castProperty(string $property, mixed $value): mixed
    {
        $reflection = new \ReflectionProperty($this, $property);
        $type = $reflection->getType();

        if ($type && !$type->isBuiltin()) {
            throw new \InvalidArgumentException("Property $property must be of type {$type->getName()}.");
        }

        return $value;
    }
}
