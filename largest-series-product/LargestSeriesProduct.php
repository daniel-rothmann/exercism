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

class Series
{
    private string $series;
    
    /**
     * @param string $input
     */
    public function __construct(string $input)
    {
        if (!is_numeric($this->series)) {
            throw new InvalidArgumentException('Series contains characters');
        }

        $this->series = $input;
    }

    /**
     * get largest product for series
     * @param int $span
     * @return int
     */
    public function largestProduct(int $span): int
    {
        if ($span < 1) {
            throw new InvalidArgumentException('Span must be greater than 0');
        }
        $max = strlen($this->series);
        if ($max < $span) {
            throw new InvalidArgumentException('Span longer than String');
        }

        $highestProduct = 0;
        $start = 0;
        do {
            $value = $this->calculateSpan(substr($this->series, $start, $span), $span);
            if ($value > $highestProduct) {
                $highestProduct = $value;
            }
            $start++;
        } while ($max >= $span + $start);
        
        return $highestProduct;
    }

    /**
     * calculates for a given span
     * @param string $input
     * @param int $span
     * @return int
     */
    private function calculateSpan(string $input, int $span): int
    {
        $result = $input[0];

        for ($i = 1; $i < $span; $i++) {
            $result *= $input[$i];
        }
        
        return $result;
    }
}
