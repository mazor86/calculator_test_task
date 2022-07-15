<?php

namespace Parser;

use DOMXPath;

class DomXpathParser extends DomParser {

    public function findLastname() {
        $xpath = new DOMXPath($this->xml);
        $xpath->registerNamespace('ns', "urn:oasis:names:tc:SAML:2.0:assertion");
        $query = '//ns:Attribute[@Name="Last name"]/ns:AttributeValue';
        $elements = $xpath->query($query);
        return $elements[0]->nodeValue;
    }
}