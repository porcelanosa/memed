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
    public function testSetGetValue()
    {
        $key  = 'test';
        $value = 'value';

        $memed = new Memed();
        $memed->set($key, $value);

        $this->assertEquals($value, $memed->get($key));
    }

    public function testDeleteValue()
    {
        $key  = 'testForDelete';
        $value = 'value';
        $output = true;

        $memed = new Memed();
        $memed->set($key, $value);

        $this->assertEquals($output, $memed->delete($key));
    }
}