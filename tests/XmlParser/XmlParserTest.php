<?php

namespace Parser;

use phpDocumentor\Reflection\Types\This;
use PHPUnit\Framework\TestCase;

class XmlParserTest extends TestCase {
    private string $filename = '/var/www/html/training.xml';
    private string $expected = 'Lafferty';

    public function testDom() {
        $parser = new DomParser($this->filename);
        $this->assertSame($this->expected, $parser->findLastname());
    }

    public function testDomXpath() {
        $parser = new DomXpathParser($this->filename);
        $this->assertSame($this->expected, $parser->findLastname());
    }

    public function testSimpleXml() {
        $parser = new SimplexmlParser($this->filename);
        $this->assertSame($this->expected, $parser->findLastname());
    }

    public function testSimpleXpath() {
        $parser = new SimplexmlXpathParser($this->filename);
        $this->assertSame($this->expected, $parser->findLastname());
    }
}
