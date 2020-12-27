<?php

$board = new Board();
$board->display($board->boardInit());

class Board
{
    const VERTICAL = 8;
    const HORIZONTAL = 8;

    public function boardInit() {
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

    public function display($board) {
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
}