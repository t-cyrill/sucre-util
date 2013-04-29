<?php
namespace Sucre;

use \Mockery as m;

class MultiLoggerTest extends \PHPUnit_Framework_TestCase
{
    public function tearDown()
    {
        m::close();
    }

    /**
     * @dataProvider dataProviderForPrint
     */
    public function testPrint($desc, $data)
    {
        $mock_1 = m::mock('Sucre\\Logger\\LoggerInterface');
        $mock_1->shouldReceive($data['method'])
            ->with($data['msg'])
            ->once();

        $mock_2 = m::mock('Sucre\\Logger\\LoggerInterface');
        $mock_2->shouldReceive($data['method'])
            ->with($data['msg'])
            ->once();

        $logger = Logger\MultiLogger::factory();
        $logger->addLogger($mock_1);
        $logger->addLogger($mock_2);
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
