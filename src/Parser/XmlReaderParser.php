<?php

namespace Parser;

use XMLReader;

class XmlReaderParser extends Parser {

    public function findLastname() {
        while ($this->xml->name != 'Attribute'
            or $this->xml->getAttribute('Name') !== 'Last name'
        ) {
            $this->xml->read();
        }
        while ($this->xml->nodeType != XMLReader::TEXT) {
            $this->xml->read();
        }
        return $this->xml->value;
    }

    protected function setXml() {
        $this->xml = new XMLReader;
        $this->xml->open($this->filename);
    }
}