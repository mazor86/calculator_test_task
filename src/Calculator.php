<?php
namespace Calculator;
use Exception;

class Calculator {
    public $cur_state;
    public $memory;
    public $was_operator;
    public $digit_limit;
    public $prev_operator;

    public function __construct($digit_limit = 8) {
        $this->cur_state = new DisplayState($digit_limit);
        $this->memory = 0;
        $this->digit_limit = $digit_limit;
        $this->cur_state->add_digit(0);
        $this->was_operator = true;
        $this->prev_operator = "=";
    }

    public function keystroke($key): string {
        $handler = KeyRecognizer::get_handler($key);
        if ($handler) {
            $handler->handle($this);
        }
        return $this->display();
    }

    public function display(): string {
        return $this->cur_state->display();
    }

    public function move_to_memory() {
        $this->memory = $this->cur_state->to_number();
        $this->cur_state = new DisplayState($this->digit_limit);
        $this->was_operator = false;
    }

    public function result_to_digits($number) {
        $this->cur_state = new DisplayState($this->digit_limit);
        if ($number < 0) {
            $this->cur_state->minus = true;
            $number = abs($number);
        }
        $result = filter_var($number, FILTER_VALIDATE_INT);
        if ($result !== false) {
            $this->cur_state->digits = str_split((string)$result);
        } else {
            $whole = (int)$number;
            $digits = str_split($whole);
            $decimal = $number - $whole;
            $precision = min(
                $this->digit_limit - count($digits),
                strlen((string)$number) - (count($digits) + 1)
            );
            if ($precision < 0) {
                throw new Exception("Error: display overflow!");
            }
            $this->cur_state->point_position = count($digits) - 1;
            $decimal = round($number - $whole, $precision) * pow(10, $precision);
            $decimal_format = sprintf("%0{$precision}s", (string)$decimal);
            $decimal = str_split($decimal_format);
            $this->cur_state->digits = array_merge($digits, $decimal);
        }
        $this->cur_state->digits = array_map(
            fn($item) => (int) $item, $this->cur_state->digits);
        $this->cur_state->length = count($this->cur_state->digits);
        if ($this->cur_state->length > $this->digit_limit) {
            throw new Exception("Error: display overflow!");
        }
    }
}