<?php

namespace Parser;

use phpDocumentor\Reflection\Types\Mixed_;

abstract class Parser {
    protected string $filename;
    protected $xml;

    /**
     * @param string $filename
     */
    public function __construct(string $filename) {
        $this->filename = $filename;
        $this->setXml();
    }

    abstract public function findLastname();
    abstract protected function setXml();
}