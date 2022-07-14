<?php

namespace Parser;

use phpDocumentor\Reflection\Types\This;
use PHPUnit\Framework\TestCase;

class XmlParserTest extends TestCase {
    private string $filename = '/var/www/html/training.xml';
    private string $expected = 'Lafferty';

    public function testDom() {
        $parser = new DomParser($this->filename);
        $this->assertEquals($this->expected, $parser->findLastname());
    }
}
