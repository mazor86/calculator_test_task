<?php

namespace Calculator;

class PointHandler extends KeyHandler {
    public function handle(&$calculator) {
        if ($calculator->was_operator) {
            $calculator->move_to_memory();
            $calculator->cur_state->add_digit(0);
        }
        $calculator->cur_state->add_point();
    }
}

