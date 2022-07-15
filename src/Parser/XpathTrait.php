<?php

namespace Parser;

trait XpathTrait {
    private string $prefix = 'ns';
    private string $namespace = "urn:oasis:names:tc:SAML:2.0:assertion";
    private string $query = '//ns:Attribute[@Name="Last name"]/ns:AttributeValue';
}