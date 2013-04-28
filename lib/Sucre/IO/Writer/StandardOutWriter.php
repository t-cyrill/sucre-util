<?php
namespace Sucre\IO\Writer;

/**
 * 標準出力に書き出すWriter
 * @author cyrill<siril.taka@gmail.com>
 */
class StandardOutWriter extends BaseWriter {
    public function write($string) {
        echo $string;
    }
}


