<?php

declare(strict_types=1);
require_once 'vendor/autoload.php';

use PragmaGoTech\Interview\Core\Application\CommandBus;
use PragmaGoTech\Interview\Core\Application\Container;
use PragmaGoTech\Interview\Loan\Application\Command\CalculateFee\CalculateFeeCommand;
use PragmaGoTech\Interview\Loan\Application\Command\CalculateFee\CalculateFeeHandler;
use PragmaGoTech\Interview\Loan\Application\Service\FeeCalculator\FeeCalculator;
use PragmaGoTech\Interview\Loan\Application\Service\FeeCalculator\IFeeCalculator;
use PragmaGoTech\Interview\Loan\Application\Service\FeeCalculator\Strategy\FeeInterpolationStrategy;
use PragmaGoTech\Interview\Loan\Application\Service\FeeCalculator\Strategy\IFeeCalculatorStrategy;
use PragmaGoTech\Interview\Loan\Infrastructure\Console\CalculateFeeController;
use PragmaGoTech\Interview\Loan\Infrastructure\Repository\FeeDummyRepository;
use PragmaGoTech\Interview\Loan\Infrastructure\Repository\IFeeRepository;

$container = new Container();

// Repositories and Strategies
$container->bind(IFeeRepository::class, fn () => new FeeDummyRepository());
$container->bind(IFeeCalculatorStrategy::class, fn () => new FeeInterpolationStrategy());

// Calculator
$container->bind(IFeeCalculator::class, fn ($c) => new FeeCalculator(
    $c->resolve(IFeeRepository::class),
    $c->resolve(IFeeCalculatorStrategy::class)
));

// Command Handler
$container->bind(CalculateFeeHandler::class, fn ($c) => new CalculateFeeHandler(
    $c->resolve(IFeeCalculator::class)
));

$container->bind(CommandBus::class, fn () => new CommandBus());

$commandBus = $container->resolve(CommandBus::class);
$commandBus->register(
    CalculateFeeCommand::class,
    fn ($command) => $container->resolve(CalculateFeeHandler::class)->__invoke($command)
);

$container->bind(CalculateFeeController::class, fn ($c) => new CalculateFeeController($commandBus));
$controller = $container->resolve(CalculateFeeController::class);
$controller->run();
