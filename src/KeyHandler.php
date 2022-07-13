<?php

namespace Calculator;

abstract class KeyHandler {
    public $key;

    public function __construct($key) {
        $this->key = $key;
    }

    abstract public function handle(&$calculator);
}
