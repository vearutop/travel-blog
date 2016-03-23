<?php


use Yaoi\Test\PHPUnit\TestCase;

class TranslitTest extends TestCase
{
    public function testTranslit() {
        $url = 'это тестовый title с названием';

        $this->assertSame('eto-tiestovyi-title-s-nazvaniiem', \Behat\Transliterator\Transliterator::transliterate($url));
    }

}