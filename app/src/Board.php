<?php

class Board
{
    const VERTICAL = 8;
    const HORIZONTAL = 8;

    public static function boardInit() {
        $baord = array();
        for ($y = 1; $y <= self::VERTICAL; $y++) {
            for ($x = 1; $x <= self::HORIZONTAL; $x++) {
                $board[$y][$x] = '*';
            }
        }

        $board[self::VERTICAL / 2][self::HORIZONTAL / 2] = 'w';
        $board[self::VERTICAL / 2][self::HORIZONTAL / 2 + 1] = 'b';
        $board[self::VERTICAL / 2 + 1][self::HORIZONTAL / 2] = 'b';
        $board[self::VERTICAL / 2 + 1][self::HORIZONTAL / 2 + 1] = 'w';

        return $board;
    }

    public static function display($board) {
        for ($y = 0; $y <= self::VERTICAL; $y++) {
            for ($x = 0; $x <= self::HORIZONTAL; $x++) {
                if ($x === 0 && $y === 0) {
                    echo "  ";
                } elseif ($y === 0) {
                    echo " $x";
                } elseif($x === 0) {
                    echo " $y";
                } else {
                    echo ' ' . $board[$y][$x];
                }
            }
            echo "\n";
        }
    }

    public static function isCheckInBoard($x, $y) {
        return ((0 < $x && $x <= self::HORIZONTAL) && (0 < $y && $y <= self::VERTICAL)) ? true : false;
    }

    public static function isChechBoardEdge($x, $y) {
        return ($x === 1 || $x === self::HORIZONTAL || $y === 1 || $y === self::VERTICAL) ? true : false;
    }
}