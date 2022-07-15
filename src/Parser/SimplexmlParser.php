<?php

namespace Parser;

class SimplexmlParser extends Parser {

    public function findLastname() {
        foreach($this->xml->Assertion->AttributeStatement->Attribute as $attr) {
            if ($attr['Name'] == "Last name") {
                return (string)$attr->AttributeValue;
            }
        }
        return null;
    }

    protected function setXml() {
        $this->xml = simplexml_load_file($this->filename);
    }
}