<?php

$file = $argv[1];
$dest = rtrim($argv[2], '/');
$tokens = token_get_all(file_get_contents($file));
$buffer = false;

while ($token = next($tokens)) {
    if ($token[0] == T_CLASS) {
        $buffer = true;
        $name = null;
        $code = '';
        $braces = 1;
        do {
            $code .= is_string($token) ? $token : $token[1];
            if (is_array($token) 
                && $token[0] == T_STRING 
                && empty($name)) {
                $name = $token[1];
            }
        } while (!(is_string($token) && $token == '{') && $token = next($tokens));
    } elseif ($buffer) {
        if (is_string($token)) {
            $code .= $token;
            if ($token == '{') {
                $braces++;
            } elseif ($token == '}') {
                $braces--;
                if ($braces == 0) {
                    $buffer = false;
                    $file = $dest . '/' . $name . '.php';
                    $code = '<?php' . PHP_EOL . $code;
                    file_put_contents($file, $code); 
                }
            }
        } else {
            $code .= $token[1];
        }
    }
}
