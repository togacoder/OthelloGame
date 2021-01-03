<?php
class View
{
    public static function displayBoard($board) {
        for ($y = 0; $y <= Board::VERTICAL; $y++) {
            for ($x = 0; $x <= Board::HORIZONTAL; $x++) {
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

    public static function showPossibleArray($possiblePlaceArray) {
        if (empty($possiblePlaceArray)) {
            echo "showPlaceArraey 指せる手がありません。\n";
        }
        echo "(x, y) : point\n";
        foreach ($possiblePlaceArray as $value) {
            echo "([$value[0], $value[1]]) : $value[2], ";
        }
        echo "\n";
    }
}