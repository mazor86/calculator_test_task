<?php

namespace Calculator;

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
