<?php

namespace Parser;

use PHPUnit\Framework\TestCase;

class XmlParserTest extends TestCase {
    private string $filename = '/var/www/html/training.xml';
    private string $expected = 'Lafferty';

    /**
     * @dataProvider classProvider
     */
    public function testParser($className) {
        $fullClassName = __NAMESPACE__ . '\\' . $className;
        $parser = new $fullClassName($this->filename);
        $this->assertSame($this->expected, $parser->findLastname());
    }

    public function classProvider() {
        return [
            ['DomParser'],
            ['DomXpathParser'],
            ['SimplexmlParser'],
            ['SimplexmlXpathParser']
        ];
    }
}
