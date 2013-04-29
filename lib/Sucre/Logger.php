<?php
namespace Sucre;

class Logger {
    private static $initialized = false;
    private static $logger = null;

    const DEBUG = 0;
    const INFO = 1;
    const WARN = 2;
    const ERROR = 3;
    const FATAL = 4;

    private static function isInitialized()
    {
        return self::$initialized;
    }

    private static function init()
    {
        self::$logger = Logger\StandardOutLogger::factory();
        self::$initialized = true;
    }

    private static function beforeCall()
    {
        if (!self::isInitialized()) {
            self::init();
        }
    }

    public static function getLogger()
    {
        self::beforeCall();
        return self::$logger;
    }

    public static function setLogger(Logger\LoggerInterface $logger)
    {
        self::beforeCall();
        self::$logger = $logger;
    }

    public static function debug($msg)
    {
        self::beforeCall();
        self::$logger->debug($msg);
    }

    public static function info($msg)
    {
        self::beforeCall();
        self::$logger->info($msg);
    }

    public static function warn($msg)
    {
        self::beforeCall();
        self::$logger->warn($msg);
    }

    public static function error($msg)
    {
        self::beforeCall();
        self::$logger->error($msg);
    }

    public static function fatal($msg)
    {
        self::beforeCall();
        self::$logger->fatal($msg);
    }
}
