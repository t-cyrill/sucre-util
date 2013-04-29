<?php
namespace Sucre;

use \Mockery as m;

class MultiWriterTest extends \PHPUnit_Framework_TestCase
{
    public function tearDown()
    {
        m::close();
    }

    /**
     * @dataProvider dataProviderForPrint
     */
    public function testWrite($desc, $data)
    {
        $mock_1 = m::mock('Sucre\\IO\\Writer\\Writer');
        $mock_1->shouldReceive($data['method'])
            ->with($data['msg'])
            ->once();

        $mock_2 = m::mock('Sucre\\IO\\Writer\\Writer');
        $mock_2->shouldReceive($data['method'])
            ->with($data['msg'])
            ->once();

        $writer = IO\Writer\MultiWriter::factory();
        $writer->addWriter($mock_1);
        $writer->addWriter($mock_2);
        $writer->$data['method']($data['msg']);
    }

    public function dataProviderForPrint()
    {
        $dataset = array(
            array('desc' => 'Print DEBUG Log', array(
                'method' => 'write',
                'msg'  => 'foo',
            )),
            array('desc' => 'Print INFO Log', array(
                'method' => 'puts',
                'msg'  => 'foo',
            )),
        );

        return $dataset;
    }
}
