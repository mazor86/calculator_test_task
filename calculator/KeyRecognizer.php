<?php
include "KeyHandler.php";

class KeyRecognizer {

    public static function get_handler($key) {
        switch ($key) {
            case "+":
            case "-":
            case "/":
            case "*":
            case "=":
                return new OperatorHandler($key);
            case "0":
            case "1":
            case "2":
            case "3":
            case "4":
            case "5":
            case "6":
            case "7":
            case "8":
            case "9":
                return new DigitHandler($key);
            case ".":
                return new PointHandler($key);
            case "+-":
                return new SignHandler($key);
            default:
                throw new Exception("Error: invalid key!");
        }
    }
}