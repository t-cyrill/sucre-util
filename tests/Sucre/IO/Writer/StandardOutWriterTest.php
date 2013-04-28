<?php
namespace Sucre\IO\Writer;

class StandardOutWriterTest extends \PHPUnit_Framework_TestCase {

    public function testWrite()
    {
        self::expectOutputString('foo');

        $writer = StandardOutWriter::factory();
        $writer->write('foo');
    }
}

