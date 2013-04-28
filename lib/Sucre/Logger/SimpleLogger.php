<?php
namespace Sucre\Logger;

use Sucre\IO\Writer\WriterInterface;

class SimpleLogger extends AbstractLogger
{
    private $writer = null;

    protected function __construct(array $params = array())
    {
        $this->writer = $params[0];
    }

    protected function writeLog($levelString, $msg) {
        $time = date('Y/m/d H:i:s');
        $this->write("[{$time}] [{$levelString}] {$msg}".PHP_EOL);
    }

    protected function write($log)
    {
        $this->writer->write($log);
    }
}
