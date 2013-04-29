<?php
namespace Sucre\Logger;

use Sucre\SucreObject;

class MultiLogger extends SucreObject implements LoggerInterface
{
    private $loggers = array();

    /**
     * ロガーを追加する
     *
     * @param Logger $logger ロガー
     */
    public function addLogger(LoggerInterface $logger)
    {
        $this->loggers[] = $logger;
    }

    public function info($msg)
    {
        $this->proxy(function ($logger) use ($msg) {
            $logger->info($msg);
        });
    }

    public function debug($msg)
    {
        $this->proxy(function ($logger) use ($msg) {
            $logger->debug($msg);
        });
    }

    public function warn($msg)
    {
        $this->proxy(function ($logger) use ($msg) {
            $logger->warn($msg);
        });
    }

    public function error($msg)
    {
        $this->proxy(function ($logger) use ($msg) {
            $logger->error($msg);
        });
    }

    public function fatal($msg)
    {
        $this->proxy(function ($logger) use ($msg) {
            $logger->fatal($msg);
        });
    }

    protected function proxy(\Closure $callable)
    {
        foreach ($this->loggers as $logger) {
            $callable($logger);
        }
    }
}
