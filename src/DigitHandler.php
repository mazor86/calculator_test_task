<?php

namespace Calculator;

class DigitHandler extends KeyHandler {
    public function handle(&$calculator) {
        if ($calculator->was_operator) {
            $calculator->move_to_memory();
        }
        $calculator->cur_state->add_digit((int)$this->key);
    }
}
