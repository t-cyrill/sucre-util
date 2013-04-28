<?php
namespace Sucre\IO\Writer;

/**
 * 何も書き込まないWriterの実装
 * @author cyrill<siril.taka@gmail.com>
 */
class NullWriter extends BaseWriter {
    public function write($string) {}
}

