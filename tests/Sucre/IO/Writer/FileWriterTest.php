<?php
namespace Sucre\IO\Writer;

use org\bovigo\vfs;

class FileWriterTest extends \PHPUnit_Framework_TestCase {
    private $root;

    public function setup()
    {
        vfs\vfsStream::setup();
        $this->root = vfs\vfsStreamWrapper::getRoot();
    }

    private function getVfsFullpath($file)
    {
        return vfs\vfsStream::url($this->root->getName().DIRECTORY_SEPARATOR).$file->getName();
    }

    public function testWrite()
    {
        $file = vfs\vfsStream::newFile('test_file');
        $file->setContent('foo');
        $this->root->addChild($file);

        $writer = FileWriter::factory($this->getVfsFullpath($file));
        $writer->write('bar');

        $file->seek(0, 0);
        $this->assertEquals('foobar', $file->readUntilEnd());
    }
}

