<?php

namespace Parser;

class SimplexmlXpathParser extends SimplexmlParser {
    use XpathTrait;
    public function findLastname() {
        $this->xml->registerXPathNamespace($this->prefix, $this->namespace);
        $result = $this->xml->xpath($this->query);
        return (string)$result[0];
    }
}