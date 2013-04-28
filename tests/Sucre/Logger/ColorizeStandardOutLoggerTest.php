<?php
namespace Sucre;

class ColorizeStandardOutLoggerTest extends \PHPUnit_Framework_TestCase {
    const RED    = "\e\\[0;31m";
    const GREEN  = "\e\\[0;32m";
    const YELLOW = "\e\\[0;33m";
    const NORMAL = "\e\\[0;39m";

    /**
     * @dataProvider dataProviderForPrint
     */
    public function testPrint($desc, $data)
    {
        self::expectOutputRegex(
            '/\\A'
            .$data['pre']
            .'\\[\\d{4}\\/\\d{2}\\/\\d{2} \\d{2}:\\d{2}:\\d{2}\\] '
            .'\\['.$data['type'].'\\] '
            .$data['msg'].'\\n'
            .$data['post']
            .'\\Z/'
        );

        $logger = Logger\ColorizeStandardOutLogger::factory();
        $logger->$data['method']($data['msg']);
    }

    public function dataProviderForPrint()
    {
        $dataset = array(
            array('desc' => 'Print DEBUG Log', array(
                'type' => 'DEBUG',
                'method' => 'debug',
                'msg'  => 'foo',
                'pre'  => '',
                'post' => '',
            )),
            array('desc' => 'Print INFO Log', array(
                'type' => 'INFO',
                'method' => 'info',
                'msg'  => 'foo',
                'pre'  => '',
                'post' => '',
            )),
            array('desc' => 'Print WARN Log', array(
                'type' => 'WARN',
                'method' => 'warn',
                'msg'  => 'foo',
                'pre'  => self::YELLOW,
                'post' => self::NORMAL,
            )),
            array('desc' => 'Print ERROR Log', array(
                'type' => 'ERROR',
                'method' => 'error',
                'msg'  => 'foo',
                'pre'  => self::RED,
                'post' => self::NORMAL,
            )),
            array('desc' => 'Print FATAL Log', array(
                'type' => 'FATAL',
                'method' => 'fatal',
                'msg'  => 'foo',
                'pre'  => self::RED,
                'post' => self::NORMAL,
            )),
        );
        return $dataset;
    }
}
