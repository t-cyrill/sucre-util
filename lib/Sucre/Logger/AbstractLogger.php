<?php
namespace Sucre\Logger;

use Sucre\SucreObject;

abstract class AbstractLogger extends SucreObject implements LoggerInterface {
    const DEBUG = 0;
    const INFO = 1;
    const WARN = 2;
    const ERROR = 3;
    const FATAL = 4;

    protected static $levelString = array(
        self::DEBUG => 'DEBUG',
        self::INFO => 'INFO',
        self::WARN => 'WARN',
        self::ERROR => 'ERROR',
        self::FATAL => 'FATAL',
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
        $this->log(self::INFO, $msg);
    }

    public function debug($msg)
    {
        $this->log(self::DEBUG, $msg);
    }

    public function warn($msg)
    {
        $this->log(self::WARN, $msg);
    }

    public function error($msg)
    {
        $this->log(self::ERROR, $msg);
    }

    public function fatal($msg)
    {
        $this->log(self::FATAL, $msg);
    }

    protected function log($level, $msg)
    {
        if ($this->isLogging(self::INFO)) {
            if (!isset(self::$levelString[$level])) {
                throw new \InvalidArgumentException('Unknown Error Level');
            }
            $levelString = self::$levelString[$level];
            $this->writeLog($levelString, $msg);
        }
    }
}

