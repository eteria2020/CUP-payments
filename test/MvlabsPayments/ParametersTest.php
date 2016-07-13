<?php

namespace MvlabsPayments;

class ParametersTest extends \PHPUnit_Framework_TestCase
{
    public function getDataProvider()
    {
        return [
            [['key' => 'value'], 'key', 'value'],
            [['key' => 12], 'key', 12],
        ];
    }

    /**
     * @dataProvider getDataProvider
     */
    public function testGet($parametersArray, $check, $result)
    {
        $parameters = new Parameters($parametersArray);

        $this->assertSame($result, $parameters->$check);
    }

    /**
     * @expectedException \MvlabsPayments\Exception\UnsetParameterException
     */
    public function testAbsentGet()
    {
        $parameters = new Parameters([]);

        $parameters->something;
    }
}
