<?php
/**
 * Created by PhpStorm.
 * User: Администратор
 * Date: 15.01.2019
 * Time: 16:21
 */

namespace tests\Memed;

use Memed\Memed;
use PHPUnit\Framework\TestCase;

class MemedTest extends TestCase
{
    private $mem;

    protected function setUp()
    {
        $this->mem = new Memed();
    }
    protected function tearDown()
    {
        $this->mem = NULL;
    }
    public function testSetGetValue()
    {
        $key   = 'test';
        $value = 'value';

        $this->mem->set($key, $value);

        $this->assertEquals($value, $this->mem->get($key));
    }

    public function testDeleteValue()
    {
        $key    = 'testForDelete';
        $value  = 'value';
        $output = true;

        $this->mem->set($key, $value);

        $this->assertEquals($output, $this->mem->delete($key));
    }

    public function testFlushAllValue()
    {
        $key    = 'testForFlush';
        $value  = 'value';
        $output = true;

        $this->mem->set($key, $value);

        $this->assertEquals($output, $this->mem->flushAll());
    }
}