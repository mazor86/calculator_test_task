<?php

class DisplayState {
    public $digits;
    public $length;
    public $minus;
    public $point_position;
    public $digit_limit;

    public function __construct($digit_limit) {
        $this->digit_limit = $digit_limit;
        $this->digits = array();
        $this->minus = false;
        $this->point_position = null;
        $this->length = 0;
    }

    public function add_digit($digit) {
        if ($this->length < $this->digit_limit){
            $this->digits[$this->length] = $digit;
            $this->length++;
        }
    }

    public function add_point() {
        if ($this->point_position === null) {
            $this->point_position = $this->length - 1;
        }
    }

    public function change_sign() {
        if ($this->length != 1 || $this->digits[0] != 0) {
            $this->minus = !$this->minus;
        }
    }
    public function display(): string {
        $result = "";
        if ($this->minus) {
            $result .= "-";
        }
        for ($i = 0; $i < $this->length; $i++) {
            $result .= $this->digits[$i];
            if ($this->point_position !== null && $this->point_position == $i) {
                $result .= '.';
            }
        }
        return $result;
    }

    public function to_number() {
        $result = $this->display();
        return ($this->point_position === null) ? (int) $result : (float) $result;
    }
}