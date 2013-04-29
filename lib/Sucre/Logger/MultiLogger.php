<?php
namespace Sucre\Logger;

use Sucre\SucreObject;
use Sucre\Traits\MultipleProxy;

class MultiLogger extends SucreObject implements LoggerInterface
{
    use MultipleProxy;

    /**
     * ロガーを追加する
     *
     * @param Logger $logger ロガー
     */
    public function addLogger(LoggerInterface $logger)
    {
        $this->addObject($logger);
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
}
