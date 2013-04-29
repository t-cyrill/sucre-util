<?php
namespace Sucre\Logger;

use Sucre\SucreObject;
use Sucre\Logger;

abstract class AbstractLogger extends SucreObject implements LoggerInterface {
    protected static $levelString = array(
        Logger::DEBUG => 'DEBUG',
        Logger::INFO => 'INFO',
        Logger::WARN => 'WARN',
        Logger::ERROR => 'ERROR',
        Logger::FATAL => 'FATAL',
    );

    private $level = 0;

    public function setLevel($level)
    {
        $this->level = $level;
    }

    abstract protected function writeLog($level, $msg);

    protected function isLogging($level)
    {
        return $level >= $this->level;
    }

    public function info($msg)
    {
        $this->log(Logger::INFO, $msg);
    }

    public function debug($msg)
    {
        $this->log(Logger::DEBUG, $msg);
    }

    public function warn($msg)
    {
        $this->log(Logger::WARN, $msg);
    }

    public function error($msg)
    {
        $this->log(Logger::ERROR, $msg);
    }

    public function fatal($msg)
    {
        $this->log(Logger::FATAL, $msg);
    }

    protected function log($level, $msg)
    {
        if ($this->isLogging($level)) {
            if (!isset(self::$levelString[$level])) {
                throw new \InvalidArgumentException('Unknown Error Level');
            }
            $levelString = self::$levelString[$level];
            $this->writeLog($levelString, $msg);
        }
    }
}

