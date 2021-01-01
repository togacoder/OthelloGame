<?php

Class Enemy
{
    public static function move($board, $playerColor) {
        $possiblePlaceArray = Piece::getPossiblePlaceArray($board, $playerColor);
        if (empty($possiblePlaceArray)) {
            echo "指せる手がありません。\n";
            return $board;
        }
        $position = self::chosePosition($possiblePlaceArray);
        $board = Piece::setPiece($board, $position, $playerColor);
        return $board;
    }

    private static function chosePosition($possiblePlaceArray) {
        $position = array();
        $getMaxPiece = 0;
        foreach ($possiblePlaceArray as $value) {
            if ($getMaxPiece <= $value[2]) {
                $position[0] = $value[0];
                $position[1] = $value[1];
            }
        }
        return $position;
    }
}