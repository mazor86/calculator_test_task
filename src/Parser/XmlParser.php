<?php

namespace Parser;

class XmlParser extends Parser {
    protected array $searched = [false, false];
    protected string $value = "";

    public function findLastname() {
        if (!($fp = fopen($this->filename, "r"))) {
            die("Cannott open XML data file: $this->filename");
        }
        while ($data = fread($fp, 4096)) {
            if (!xml_parse($this->xml, $data, feof($fp))) {
                die(sprintf("XML error: %s at line %d",
                    xml_error_string(xml_get_error_code($this->xml)),
                    xml_get_current_line_number($this->xml)));
            }
        }
        xml_parser_free($this->xml);
        return $this->value;
    }

    protected function setXml() {
        $this->xml = xml_parser_create();
        xml_set_element_handler($this->xml, array($this, 'startElement'), array($this, 'endElement'));
        xml_set_character_data_handler($this->xml, array($this, "characterData"));
        xml_parser_set_option($this->xml, XML_OPTION_CASE_FOLDING, false);
    }

    protected function startElement($parser, $name, $attribs) {
        if ($name == "Attribute" && $attribs['Name'] == 'Last name') {
            $this->searched[0] = true;
        }
        if ($name == "AttributeValue" && $this->searched[0]) {
            $this->searched[1] = true;
        }
    }

    protected function endElement($parser, $name) {

    }

    protected function characterData($parser, $data) {
        if ($this->searched[1]) {
            $this->value = $data;
            $this->searched[0] = false;
            $this->searched[1] = false;
        }
    }
}