<?php

namespace Calculator;

class SignHandler extends KeyHandler {
    public function handle(&$calculator) {
        $calculator->cur_state->change_sign();
    }
}

