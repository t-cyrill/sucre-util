<?php
namespace Sucre\IO\Writer;

use Sucre\SucreObject;
use Sucre\Traits\MultipleProxy;

/**
 * 複数のWriterにまとめて書き出すWriter
 *
 * addWriterで登録したすべてのWriterの
 * メソッドの呼び出しを行うWriterです。
 * 例えば、FileWriterとStandardOutWriterを登録すると、
 * ファイルと標準出力に書き出すことができます。
 * 複数の出力先に同じ内容を書き出す際に有用です。
 *
 * @author cyrill<siril.taka@gmail.com>
 */
class MultiWriter extends SucreObject implements WriterInterface {
    use MultipleProxy;

    public function addWriter(Writer $writer)
    {
        $this->addObject($writer);
    }

    public function puts($string)
    {
        $this->proxy(function ($writer) use ($string) {
            $writer->puts($string);
        });
    }

    public function write($string)
    {
        $this->proxy(function ($writer) use ($string) {
            $writer->write($string);
        });
    }
}


