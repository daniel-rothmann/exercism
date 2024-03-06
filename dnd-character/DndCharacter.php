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

class DndCharacter
{
    public int $strength;
    public int $dexterity;
    public int $constitution;
    public int $intelligence;
    public int $wisdom;
    public int $charisma;
    public int $hitpoints = 10;

    /**
     * @param int $constitution
     * @return int
     */
    public static function modifier(int $constitution): int
    {
        return (int) floor(($constitution - 10) / 2);
    }
    
    /**
     * @return DnDCharacter
     */
    public static function generate(): DnDCharacter
    {
        $char = new self();
        $char->strength = $char::ability();
        $char->dexterity = $char::ability();
        $char->constitution = $char::ability();
        $char->intelligence = $char::ability();
        $char->wisdom = $char::ability();
        $char->charisma = $char::ability();
        $char->hitpoints += $char::modifier($char->constitution);
        return $char;
    }

    /**
     * rolle 4 dices and sum 3 highest of them
     * @return int
     */
    public static function ability(): int
    {
        $numbers = [
            rand(1, 6),
            rand(1, 6),
            rand(1, 6),
            rand(1, 6),
        ];

        asort($numbers);
        array_shift($numbers);
        return array_sum($numbers);
    }
}
