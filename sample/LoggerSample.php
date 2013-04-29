<?php
namespace Sucre;

require dirname(__DIR__).'/vendor/autoload.php';

Logger::debug('test');
Logger::info('test');
Logger::warn('test');
Logger::error('test');
Logger::fatal('test');

sleep(1);

$colorize = Logger\ColorizeStandardOutLogger::factory();
Logger::setLogger($colorize);
Logger::debug('test');
Logger::info('test');
Logger::warn('test');
Logger::error('test');
Logger::fatal('test');

sleep(1);

$std_logger = Logger\StandardOutLogger::factory();
$std_logger->setLevel(Logger::INFO);
$multi_logger = Logger\MultiLogger::factory();
$multi_logger->addLogger($std_logger);
$multi_logger->addLogger($colorize);

Logger::setLogger($multi_logger);
Logger::debug('test');
Logger::info('test');
Logger::warn('test');
Logger::error('test');
Logger::fatal('test');


