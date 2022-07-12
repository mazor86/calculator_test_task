<?php

abstract class KeyHandler {
    public $key;

    public function __construct($key) {
        $this->key = $key;
    }

    abstract public function handle(&$calculator);
}

class DigitHandler extends KeyHandler {
    public function handle(&$calculator) {
        if ($calculator->was_operator) {
            $calculator->move_to_memory();
        }
        $calculator->cur_state->add_digit((int)$this->key);
    }
}

class SignHandler extends KeyHandler {
    public function handle(&$calculator) {
        $calculator->cur_state->change_sign();
    }
}

class PointHandler extends KeyHandler {
    public function handle(&$calculator) {
        if ($calculator->was_operator) {
            $calculator->move_to_memory();
            $calculator->cur_state->add_digit(0);
        }
        $calculator->cur_state->add_point();
    }
}

class OperatorHandler extends KeyHandler {
    public function handle(&$calculator) {
        if (!$calculator->was_operator) {
            $prev_operator = $calculator->prev_operator;
            $cur_number = $calculator->cur_state->to_number();
            switch ($prev_operator) {
                case "+":
                    $result = $calculator->memory + $cur_number;
                    break;
                case "-":
                    $result = $calculator->memory - $cur_number;
                    break;
                case "*":
                    $result = $calculator->memory * $cur_number;
                    break;
                case "/":
                    $result = $calculator->memory / $cur_number;
                    break;
                default:
                    $result = $cur_number;
            }
            $calculator->memory = $result;
            $calculator->result_to_digits($calculator->memory, $calculator->digit_limit);
            $calculator->was_operator = true;
        }
        $calculator->prev_operator = $this->key;
    }
}