<?php

namespace PragmaGoTech\Interview\Core\Application;

class Container
{
    private array $bindings = [];

    public function bind(string $interface, callable $resolver): void
    {
        $this->bindings[$interface] = $resolver;
    }

    public function resolve(string $interface): mixed
    {
        if (!isset($this->bindings[$interface])) {
            throw new \RuntimeException("No binding registered for {$interface}");
        }

        return ($this->bindings[$interface])($this);
    }
}
