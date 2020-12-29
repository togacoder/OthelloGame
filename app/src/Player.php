<?php
require "board.php";

Class Player
{
    public static function getPlayerPosition() {
        echo "駒を打つ場所を入力して下さい。\n";
        while(true) {
            $position = explode(' ', trim(fgets(STDIN)));
            if (0 < $position[0] && $position[0] <= Board::HORIZONTAL && 0 < $position[1] && $position[1] <= Board::VERTICAL) {
                return $position;
            }
            echo "不正な入力です。\n";
        }
    }

    public static function getPlayerColor() {
        echo "先手: b, 後手: w\n";
        while(true) {
            $getColor = trim(fgets(STDIN));
            if ($getColor === 'b' || $getColor === 'w') {
                return $getColor;
            }
            echo "'b'または、'w'を入力して下さい。\n";
        }
    }
}