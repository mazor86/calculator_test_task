<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tests</title>
</head>
<body>
<pre>
<code>
<?php

    require_once('vendor/autoload.php');
    use Calculator\Calculator;

    $test_cases = array(
        array('1', '2', '+', '3', '='),
        array('3', '0', '0', '/', '1', '5', '+', '5', '+', '1', '7', '='),
        array('5', '+-', '0', '-', '+', '2', '9', '='),
        array('-', '8', '='),
        array('.', '5', '5', '*', '1', '0', '='),
        array('5', '0', '.', '3', '6', '-', '1', '1', '.', '3', '3', '3', '3', '='),
        array('1', '/', '3', '=')
    );
    $expected = array('15', '42', '-21', '-8', '5.5', '39.0267', '0.3333333');
    for ($i = 0; $i < count($test_cases); $i++) {
        $calculator = new Calculator;
        foreach ($test_cases[$i] as $key) {
            printf("%-10s : %10s<br>", $key, $calculator->keystroke($key));
        }
        $result = $calculator->display() === $expected[$i]
            ? "Ok"
            : "Fail";
        echo "Test" . ($i + 1) . ": $result<br><br>";
    }

?>
</code>
    </pre>
</body>
</html>