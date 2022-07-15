<?php

namespace Parser;

use DOMXPath;

class DomXpathParser extends DomParser {
    use XpathTrait;

    public function findLastname() {
        $xpath = new DOMXPath($this->xml);
        $xpath->registerNamespace($this->prefix, $this->namespace);
        $elements = $xpath->query($this->query);
        return $elements[0]->nodeValue;
    }
}