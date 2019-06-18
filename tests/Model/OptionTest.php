<?php

namespace CloudPrinter\CloudApps\Tests\Model\CloudApps;

use CloudPrinter\CloudApps\Exception\ValidationException;
use CloudPrinter\CloudApps\Model\Option;
use PHPUnit\Framework\TestCase;

/**
 * Class OptionTest
 *
 * @copyright   2019 by CloudPrinter
 * @author      Vasyl Kushniruk <kushniruk92@gmail.com>
 */
class OptionTest extends TestCase
{
    /**
     * @var Option
     */
    private $option;

    public function setUp()
    {
        $this->option = new Option();
    }

    public function testOptionSuccessSetViaConstructor()
    {
        $option = new Option('reference', 1);

        $asArray = $option->toArray();
        $expected = [
            'option_reference' => 'reference',
            'count' => 1,
        ];
        $this->assertEquals($expected, $asArray);
    }

    public function testOptionSuccess()
    {
        $this->option->setOptionReference('reference')
            ->setCount(1);

        $asArray = $this->option->toArray();
        $expected = [
            'option_reference' => 'reference',
            'count' => 1,
        ];
        $this->assertEquals($expected, $asArray);
    }

    public function testOptionFail()
    {
        $this->option->setOptionReference('reference');

        $this->expectException(ValidationException::class);
        $this->option->toArray();
    }
}
