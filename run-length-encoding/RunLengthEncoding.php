<?php

/*
 * By adding type hints and enabling strict type checking, code can become
 * easier to read, self-documenting and reduce the number of potential bugs.
 * By default, type declarations are non-strict, which means they will attempt
 * to change the original type to match the type specified by the
 * type-declaration.
 *
 * In other words, if you pass a string to a function requiring a float,
 * it will attempt to convert the string value to a float.
 *
 * To enable strict mode, a single declare directive must be placed at the top
 * of the file.
 * This means that the strictness of typing is configured on a per-file basis.
 * This directive not only affects the type declarations of parameters, but also
 * a function's return type.
 *
 * For more info review the Concept on strict type checking in the PHP track
 * <link>.
 *
 * To disable strict typing, comment out the directive below.
 */

declare(strict_types=1);

/**
 * encode a string
 * @param string $input
 * @return string
 */
function encode(string $input): string
{
    $encoded = '';
    $lastChar = '';
    $count = 1;

    for ($i = 0; $i <= strlen($input); $i++) {
        $char = $input[$i] ?? false;

        if ($char === $lastChar) {
            $count++;
            continue;
        }
        
        if ($count > 1) {
            $encoded .= $count;
        }
        $encoded .= $lastChar;

        $lastChar = $char;
        $count = 1;
    }
    
    return $encoded;
}

/**
 * decode a string
 * @param string $input
 * @return string
 */
function decode(string $input): string
{
   $decoded = '';
    $number = '';

    for ($i = 0; $i < strlen($input); $i++) {
        $char = $input[$i];
        if (is_numeric($char)) {
            $number .= $char;
            continue;
        }

        if ($number === '') {
            $number = 1;
        }

        
        $decoded .= str_repeat($char, (int)$number);
        
        $number = '';
    }
    
    return $decoded;
}
