<?php
namespace Sucre\CLI;

use Sucre\SucreObject;

/**
 * Sucre\CLI\Application
 *
 * Simple CLI Framework
 */
abstract class Application extends SucreObject
{
    private $args = array();

    abstract public function run();

    protected function __construct(array $params = array())
    {
        $this->args = $params[0];
    }

    protected function getArgs()
    {
        return $this->args;
    }
}
