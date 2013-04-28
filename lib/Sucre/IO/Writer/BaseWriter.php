<?php
namespace Sucre\IO\Writer;

use Sucre\SucreObject;

/**
 * 基本となるWriterの実装
 * @author cyrill<siril.taka@gmail.com>
 */
abstract class BaseWriter extends SucreObject implements WriterInterface {
    /**
     * 末尾に改行をつけてwriteする
     * @param string $string 書き込む文字列
     */
    public function puts($string) {
        $this->write($string.PHP_EOL);
    }
}


