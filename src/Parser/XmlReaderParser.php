<?php

namespace Parser;

use XMLReader;

class XmlReaderParser extends Parser {
    protected bool $flag = false;

    public function findLastname() {
        while ($this->xml->read()) {
            if ($this->xml->name == 'Attribute'
                && $this->xml->getAttribute('Name') == 'Last name') {
                $this->flag = true;
            }
            if ($this->flag && $this->xml->nodeType == XMLReader::TEXT) {
                return $this->xml->value;
            }
        }
        return null;
    }

    protected function setXml() {
        $this->xml = new XMLReader;
        $this->xml->open($this->filename);
    }
}