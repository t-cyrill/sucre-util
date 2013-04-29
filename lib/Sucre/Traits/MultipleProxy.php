<?php
namespace Sucre\Traits;

trait MultipleProxy {
    private $objects = array();

    protected function addObject($object)
    {
        $this->objects[] = $object;
    }

    protected function proxy(\Closure $callable)
    {
        foreach ($this->objects as $object) {
            $callable($object);
        }
    }
}
