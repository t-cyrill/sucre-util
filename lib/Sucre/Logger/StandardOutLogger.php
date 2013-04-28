<?php
namespace Sucre\Logger;

use Sucre\IO\Writer\StandardOutWriter;

class StandardOutLogger extends SimpleLogger
{
    public static function factory()
    {
        return parent::factory(StandardOutWriter::factory());
    }
}
