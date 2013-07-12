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
    abstract public function run();
}
