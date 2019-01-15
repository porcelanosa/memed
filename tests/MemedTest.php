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
	public function testFirst() {
		$this->assertEquals('Hello', 'Hell' . 'o');
	}
	public function testSetValue()
	{
		$input = 'value';
		$output = '';
		$memed = new Memed();
		$this->assertEquals($output, $memed->get($input));
	}
}