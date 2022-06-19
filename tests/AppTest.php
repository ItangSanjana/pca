<?php

namespace Is\Pca;

use PHPUnit\Framework\TestCase;

final class AppTest extends TestCase
{
  public function testClassConstructor()
  {
    $app = new App([null, 'foo bar', 'baz', 'qux']);

    $this->assertIsString($app->input);
  }

  public function testGetUpperCase()
  {
    $app = new App([null, 'foo bar', 'baz', 'qux']);
    $arg = explode(' ', $app->input);

    $this->assertSame('QUX', $app->getUpperCase($arg[count($arg) - 1]));
  }

  public function testGetFancyLetter()
  {
    $app = new App([null, 'foo bar', 'baz', 'qux']);

    $this->assertEquals('fOo bAr bAz qUx', $app->getFancyLetter());
    $this->assertStringContainsString('bAr bAz', $app->fancy_letter);
  }

  public function testGetCSVFile()
  {
    $app = new App([null, 'foo bar', 'baz', 'qux']);

    $this->assertStringStartsWith('CSV', $app->getCSVFile());
    $this->assertStringEndsWith('created!', $app->output);
    $this->assertFalse(!$app->output);
  }
}
