<?php
namespace Sucre;

class StandardOutLoggerTest extends \PHPUnit_Framework_TestCase {

    /**
     * @dataProvider dataProviderForPrint
     */
    public function testPrint($desc, $data)
    {
        self::expectOutputRegex(
            '/\\A\\[\\d{4}\\/\\d{2}\\/\\d{2} \\d{2}:\\d{2}:\\d{2}\\] '
            .'\\['.$data['type'].'\\] '
            .$data['msg'].'\\n\\Z/'
        );

        $logger = Logger\StandardOutLogger::factory();
        $logger->$data['method']($data['msg']);
    }

    public function dataProviderForPrint()
    {
        $dataset = array(
            array('desc' => 'Print DEBUG Log', array(
                'type' => 'DEBUG',
                'method' => 'debug',
                'msg'  => 'foo',
            )),
            array('desc' => 'Print INFO Log', array(
                'type' => 'INFO',
                'method' => 'info',
                'msg'  => 'foo',
            )),
            array('desc' => 'Print WARN Log', array(
                'type' => 'WARN',
                'method' => 'warn',
                'msg'  => 'foo',
            )),
            array('desc' => 'Print ERROR Log', array(
                'type' => 'ERROR',
                'method' => 'error',
                'msg'  => 'foo',
            )),
            array('desc' => 'Print FATAL Log', array(
                'type' => 'FATAL',
                'method' => 'fatal',
                'msg'  => 'foo',
            )),
        );
        return $dataset;
    }
}
