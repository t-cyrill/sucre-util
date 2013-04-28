<?php
namespace Sucre\IO\Writer;

/**
 * 書き込み対象
 * @author cyrill<siril.taka@gmail.com>
 */
interface WriterInterface {
    public function puts($string);
    public function write($string);
}


