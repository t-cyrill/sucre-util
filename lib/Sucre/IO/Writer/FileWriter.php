<?php
namespace Sucre\IO\Writer;

/**
 * ファイルに書き込むWriterの実装
 *
 * @author cyrill<siril.taka@gmail.com>
 */
class FileWriter extends BaseWriter {
    /**
     * @var filename
     */
    private $filename;

    /**
     * @param array $params array(
     *      0 => 'filename.txt', // filename
     *  );
     */
    protected function __construct(array $params = array())
    {
        $this->filename = $params[0];
    }

    /**
     * Append $string to $filename
     *
     * @param string $string output string
     */
    public function write($string) {
        file_put_contents($this->filename, $string, FILE_APPEND | LOCK_EX);
    }
}

