<?php

function createElement(DOMDocument &$dom, string $name, &$elemProps) {
    if (gettype($elemProps) == 'string') {
        $value = $elemProps;
        $namespace = null;
    } else {
        $value = $elemProps['@value'];
        $children = array_keys($elemProps);
        $namespace = $elemProps['namespace'];
    }
    if ($namespace) {
        $element = $dom->createElementNS($namespace, $name, htmlspecialchars($value));
    } else {
        $element = $dom->createElement($name, htmlspecialchars($value));
    }
    if (gettype($elemProps) == 'array') {
        if (array_key_exists('@attributes', $elemProps)) {
            foreach ($elemProps['@attributes'] as $key => $value) {
                $element->setAttribute($key, $value);
            }
        }
        foreach (array('@attributes', '@value', 'namespace') as $key) {
            $index = array_search($key, $children);
            if ($index !== false) {
                unset($children[$index]);
            }
        }
        foreach ($children as $child) {
            if (gettype($child) == 'string') {
                $element->appendChild(createElement($dom, $child, $elemProps[$child]));
            } else {
                $element->appendChild(createElement($dom, $name, $elemProps[$child]));
            }
        }
    }
    return $element;
}

$dom = new DOMDocument('1.0', 'utf-8');
$dom->formatOutput = true;
$filename = "created.xml";
$XML_ARRAY = array (
    'samlp:Response' =>
        array (
            'Issuer' => array(
                '@value' => 'https://sts.windows.net/46c98d88-e344-4ed4-8496-4ed7712e255d/',
                'namespace' => 'urn:oasis:names:tc:SAML:2.0:assertion'
                ),
            'samlp:Status' =>
                array (
                    'samlp:StatusCode' =>
                        array (
                            '@value' => '',
                            '@attributes' =>
                                array (
                                    'Value' => 'urn:oasis:names:tc:SAML:2.0:status:Success',
                                ),
                        ),
                ),
            'Assertion' =>
                array (
                    'Issuer' => 'https://sts.windows.net/46c98d88-e344-4ed4-8496-4ed7712e255d/',
                    'Signature' =>
                        array (
                            'SignedInfo' =>
                                array (
                                    'CanonicalizationMethod' =>
                                        array (
                                            '@value' => '',
                                            '@attributes' =>
                                                array (
                                                    'Algorithm' => 'http://www.w3.org/2001/10/xml-exc-c14n#',
                                                ),
                                        ),
                                    'SignatureMethod' =>
                                        array (
                                            '@value' => '',
                                            '@attributes' =>
                                                array (
                                                    'Algorithm' => 'http://www.w3.org/2001/04/xmldsig-more#rsa-sha256',
                                                ),
                                        ),
                                    'Reference' =>
                                        array (
                                            'Transforms' =>
                                                array (
                                                    'Transform' =>
                                                        array (
                                                            0 =>
                                                                array (
                                                                    '@value' => '',
                                                                    '@attributes' =>
                                                                        array (
                                                                            'Algorithm' => 'http://www.w3.org/2000/09/xmldsig#enveloped-signature',
                                                                        ),
                                                                ),
                                                            1 =>
                                                                array (
                                                                    '@value' => '',
                                                                    '@attributes' =>
                                                                        array (
                                                                            'Algorithm' => 'http://www.w3.org/2001/10/xml-exc-c14n#',
                                                                        ),
                                                                ),
                                                        ),
                                                ),
                                            'DigestMethod' =>
                                                array (
                                                    '@value' => '',
                                                    '@attributes' =>
                                                        array (
                                                            'Algorithm' => 'http://www.w3.org/2001/04/xmlenc#sha256',
                                                        ),
                                                ),
                                            'DigestValue' => 'e4WdsXI/Sq09SmUUD5JlLrYbIOwTY337+AwZNcFtIkA=',
                                            '@attributes' =>
                                                array (
                                                    'URI' => '#_180363af-293d-457d-a110-e235258a0000',
                                                ),
                                        ),
                                ),
                            'SignatureValue' => 'cPnz/9144QUFX9BdxShhIYcyaNNdR8RJliVll4ahMpnBa3iUztAGzThOPK1AnW6pNXZ+Rh1zi4Ha3LgxwQOfIjf6nb06ShTB1mfIbpnfYs43BcRLFyccT+8BWq+p0bDIGyPQ/1SFMzKN5wJafyiqmsyHBHO9fF/q3+G6Ya2R/GWh5jaXKMeCyb5/bNJuNHYDy1XqZ3cTJRGkuJwHOocsqqid8xajZGTDXqjqQk3nEyvkfNfEaF26vTH//Ckj3OKSJKrHfQbyEbamBWKgQthVV6mqSVq4De77f6P2GsXSyY+qBzWszVR0Mg0Bcy7atpJ+RT7AOcvhpVX5oMayrF8PBQ==',
                            'KeyInfo' =>
                                array (
                                    'X509Data' =>
                                        array (
                                            'X509Certificate' => 'MIIC8DCCAdigAwIBAgIQI/hAh8QEkLVFUdT+tZf7TDANBgkqhkiG9w0BAQsFADA0MTIwMAYDVQQDEylNaWNyb3NvZnQgQXp1cmUgRmVkZXJhdGVkIFNTTyBDZXJ0aWZpY2F0ZTAeFw0yMTA3MDcxODA4NDRaFw0yNDA3MDcxODA4NDRaMDQxMjAwBgNVBAMTKU1pY3Jvc29mdCBBenVyZSBGZWRlcmF0ZWQgU1NPIENlcnRpZmljYXRlMIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEA5asN5fmCvErcmAuDGTQZ6AhCT2oDPl/B7412hCLITzFJYSH6nr+937/8Ekx50Msom+X/o5nruw5KpxAKR7NPD1I5dfKcSSbJq+9/ghO+xySg9iKIIVkCi4+dPRHxHNTrbGZry5Cs7DibVbhz9ChhyoVbQXrZnjScGDzHNdruPo8U5BoQmvSOJEtoM3YO4b80JkrBWyzxS/luO3CqK1w0GHaKANpik8T1l2WSSKcL91S2e5Re+H2PMo8y22LlUVQhNe4xkTlbWbyWmvuG3po0dySXrxBip+3P+345tsNZEwnq1W5nHQE+6ordY6ZO2FnPzcYXDuThQZTcgzh/3c9tsQIDAQABMA0GCSqGSIb3DQEBCwUAA4IBAQBjfraPnFyo6ktOM6SVftKqPSa65difWqIzMSmDMZsMvBkNBSgJ97Tdc7kRDtiThjj2UBcU3fucVogQ+lFFvNByfgCErrQ98Kzu6JPbsdDo6S3UGuLd5lnh7AtvD4WBjXEMcdL9cDfbTsKzec61VBd1edP4PKPL3bV067oaAR5zNkwO6jmZOcrh8CcabQGFWNu7aLImRrjgGmV42Wgf/3TvJ9vqiUQf/yxqgJkHZg4r9lmEWE/RVlehEJQpFUPtuYvGx2VA1uoeRkUNTZkzy592ChZlJTHnF4sHcdDDaidiVi5VznO74GmUuQfdgwuB+5ciz2PNVud11G9kIrVHYtnf',
                                        ),
                                ),
                            'namespace' => "http://www.w3.org/2000/09/xmldsig#"
                        ),
                    'Subject' =>
                        array (
                            'NameID' =>
                                array (
                                    '@value' => '10065136',
                                    '@attributes' =>
                                        array (
                                            'Format' => 'urn:oasis:names:tc:SAML:1.1:nameid-format:unspecified',
                                        ),
                                ),
                            'SubjectConfirmation' =>
                                array (
                                    'SubjectConfirmationData' =>
                                        array (
                                            '@value' => '',
                                            '@attributes' =>
                                                array (
                                                    'InResponseTo' => 'pfx551e5951-0f72-eee9-8061-168874437e49',
                                                    'NotOnOrAfter' => '2021-08-31T20:28:52.226Z',
                                                    'Recipient' => 'https://intel.northernlight.com/sso/',
                                                ),
                                        ),
                                    '@attributes' =>
                                        array (
                                            'Method' => 'urn:oasis:names:tc:SAML:2.0:cm:bearer',
                                        ),
                                ),
                        ),
                    'Conditions' =>
                        array (
                            'AudienceRestriction' =>
                                array (
                                    'Audience' => 'https://intel.northernlight.com/',
                                ),
                            '@attributes' =>
                                array (
                                    'NotBefore' => '2021-08-31T19:23:52.226Z',
                                    'NotOnOrAfter' => '2021-08-31T20:28:52.226Z',
                                ),
                        ),
                    'AttributeStatement' =>
                        array (
                            'Attribute' =>
                                array (
                                    0 =>
                                        array (
                                            'AttributeValue' => '46c98d88-e344-4ed4-8496-4ed7712e255d',
                                            '@attributes' =>
                                                array (
                                                    'Name' => 'http://schemas.microsoft.com/identity/claims/tenantid',
                                                ),
                                        ),
                                    1 =>
                                        array (
                                            'AttributeValue' => '5947ccaf-fb5d-4038-ad9f-e71c2d30a076',
                                            '@attributes' =>
                                                array (
                                                    'Name' => 'http://schemas.microsoft.com/identity/claims/objectidentifier',
                                                ),
                                        ),
                                    2 =>
                                        array (
                                            'AttributeValue' => 'https://sts.windows.net/46c98d88-e344-4ed4-8496-4ed7712e255d/',
                                            '@attributes' =>
                                                array (
                                                    'Name' => 'http://schemas.microsoft.com/identity/claims/identityprovider',
                                                ),
                                        ),
                                    3 =>
                                        array (
                                            'AttributeValue' =>
                                                array (
                                                    0 => 'http://schemas.microsoft.com/ws/2008/06/identity/authenticationmethod/password',
                                                    1 => 'http://schemas.microsoft.com/ws/2008/06/identity/authenticationmethod/x509',
                                                    2 => 'http://schemas.microsoft.com/ws/2008/06/identity/authenticationmethod/windows',
                                                ),
                                            '@attributes' =>
                                                array (
                                                    'Name' => 'http://schemas.microsoft.com/claims/authnmethodsreferences',
                                                ),
                                        ),
                                    4 =>
                                        array (
                                            'AttributeValue' => 'mike.lafferty@intel.com',
                                            '@attributes' =>
                                                array (
                                                    'Name' => 'Email address',
                                                ),
                                        ),
                                    5 =>
                                        array (
                                            'AttributeValue' => 'Mike',
                                            '@attributes' =>
                                                array (
                                                    'Name' => 'First name',
                                                ),
                                        ),
                                    6 =>
                                        array (
                                            'AttributeValue' => '10065136',
                                            '@attributes' =>
                                                array (
                                                    'Name' => 'Enterprise ID',
                                                ),
                                        ),
                                    7 =>
                                        array (
                                            'AttributeValue' => '&Lafferty',
                                            '@attributes' =>
                                                array (
                                                    'Name' => 'Last name',
                                                ),
                                        ),
                                ),
                        ),
                    'AuthnStatement' =>
                        array (
                            'AuthnContext' =>
                                array (
                                    'AuthnContextClassRef' => 'urn:oasis:names:tc:SAML:2.0:ac:classes:Password',
                                ),
                            '@attributes' =>
                                array (
                                    'AuthnInstant' => '2021-08-31T19:26:58.674Z',
                                    'SessionIndex' => '_180363af-293d-457d-a110-e235258a0000',
                                ),
                        ),
                    '@attributes' =>
                        array (
                            'ID' => '_180363af-293d-457d-a110-e235258a0000',
                            'IssueInstant' => '2021-08-31T19:28:52.476Z',
                            'Version' => '2.0',
                        ),
                    'namespace' => "urn:oasis:names:tc:SAML:2.0:assertion",
                ),
            '@attributes' =>
                array (
                    'ID' => '_31f6f0f6-bd99-44a5-84ed-aa299833d9d5',
                    'Version' => '2.0',
                    'IssueInstant' => '2021-08-31T19:28:52.492Z',
                    'Destination' => 'https://intel.northernlight.com/sso/',
                    'InResponseTo' => 'pfx551e5951-0f72-eee9-8061-168874437e49',
                ),
            'namespace' => 'urn:oasis:names:tc:SAML:2.0:protocol'
        ),
);

foreach ($XML_ARRAY as $key => $value) {
    $root = createElement($dom, $key, $value);
}
$dom->appendChild($root);

$dom->save("../" . $filename);
echo "<a href=\"../" . $filename . "\">$filename</a> has been successfully created";