<?php

namespace PragmaGoTech\Interview\Core\Application;

class CommandBus
{
    private array $handlers = [];

    public function register(string $commandClass, callable $handler): void
    {
        $this->handlers[$commandClass] = $handler;
    }

    public function handle(object $command): mixed
    {
        $commandClass = get_class($command);

        if (!isset($this->handlers[$commandClass])) {
            throw new \RuntimeException("No handler registered for command: {$commandClass}");
        }

        return ($this->handlers[$commandClass])($command);
    }
}
