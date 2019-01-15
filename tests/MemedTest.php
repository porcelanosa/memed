<?php
/**
 * @var $mem \Memed\Memed
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

        $this->mem->set($key, $value);

        $this->assertTrue($this->mem->delete($key));
    }

    public function testFlushAllValue()
    {
        $key    = 'testForFlush';
        $value  = 'value';

        $this->mem->set($key, $value);

        $this->assertTrue($this->mem->flushAll(), 'Flushed all successfully');
    }
}