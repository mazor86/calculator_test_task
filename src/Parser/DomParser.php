<?php

namespace Parser;

use DOMDocument;

class DomParser extends Parser {
    public function findLastname() {
        $attributes = $this->xml->getElementsByTagName('Attribute');
        foreach ($attributes as $attr) {
            if ($attr->getAttribute("Name") == "Last name") {
                return $attr->childNodes[1]->nodeValue;
            }
        }
        return null;
    }

    protected function setXml() {
        $this->xml = new DOMDocument();
        $this->xml->load($this->filename);
    }
}