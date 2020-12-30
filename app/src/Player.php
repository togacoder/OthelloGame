<?php

Class Player
{
    public static function getPlayerPosition($possiblePlaceArray) {
        echo "駒を打つ場所を入力して下さい。\n";
        while(true) {
            $position = explode(' ', trim(fgets(STDIN)));
            if (self::isCheckPosition($position, $possiblePlaceArray)) {
                return $position;
            }
            echo "不正な入力です。\n";
        }
    }

    private function isCheckPosition($position, $possiblePlaceArray) {
        foreach ($possiblePlaceArray as $value) {
            if (($value[0] == $position[0]) && ($value[1] == $position[1])) {
                return true;
            }
        }
        return false;
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

    public static function getEnemyColor($playerColor) {
        return $playerColor === 'b' ? 'w' : 'b';
    }
}