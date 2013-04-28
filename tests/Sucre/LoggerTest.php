<?php
namespace Sucre;

class LoggerTest extends \PHPUnit_Framework_TestCase
{
    public function testGetLogger()
    {
        $actual = Logger::getLogger();
        self::assertInstanceOf('Sucre\\Logger\\StandardOutLogger', $actual);
    }

    public function testSetLogger()
    {
        $logger = Logger\ColorizeStandardOutLogger::factory();
        Logger::setLogger($logger);
        $actual = Logger::getLogger();

        self::assertSame($logger, $actual);
    }
}
