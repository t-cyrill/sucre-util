<?php
namespace Sucre\IO\Writer;

class NullWriterTest extends \PHPUnit_Framework_TestCase {

    public function testWrite()
    {
        self::expectOutputString('');

        $writer = NullWriter::factory();
        $writer->write('foo');
    }
}

