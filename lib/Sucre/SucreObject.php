<?php
namespace Sucre;

class SucreObject
{
    private static $apply_object = null;

    protected function __construct(array $params = array())
    {

    }

    public static function factory()
    {
        $params = func_get_args();

        if (self::$apply_object === null) {
            return new static($params);
        }

        return self::$apply_object;
    }

    public static function attach($object)
    {
        self::$apply_object = $object;
    }

    public static function detach()
    {
        self::$apply_object = null;
    }
}
