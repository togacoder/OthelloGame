<?php

Class Enemy
{
    public static function move($board, $playerColor) {
        $possiblePlaceArray = Piece::getPossiblePlaceArray($board, $playerColor);
        if (empty($possiblePlaceArray)) {
            echo "指せる手がありません。\n";
            return $board;
        }
        $position = self::AI($board, $possiblePlaceArray, $playerColor);
        $board = Piece::setPiece($board, $position, $playerColor);
        echo "相手の手 : ([$position[0], $position[1]])\n";
        return $board;
    }

    private static function AI($board, $possiblePlaceArray, $playerColor) {
        $maxPointPlaceArray = self::getMaxPointPlaceArray($board, $possiblePlaceArray, $playerColor);
        return self::getBestPosition($maxPointPlaceArray);
    }

    private function getBestPosition($maxPointPlaceArray) {
        $position = array();
        $point = PHP_INT_MIN;
        foreach ($maxPointPlaceArray as $maxPointPlace) {
            if ($point <= $maxPointPlace[2]) {
                $point = $maxPointPlace[2];
                $position = array($maxPointPlace[0], $maxPointPlace[1]);
            }
        }
        return $position;
    }

    private function getMaxPointPlaceArray($board, $possiblePlaceArray, $color) {
        $maxPointPlaceArray = array();
        $position = array();
        foreach ($possiblePlaceArray as $possiblePlace) {
            $position = array($possiblePlace[0], $possiblePlace[1]);
            $maxPointPlaceArray[] = array($position[0], $position[1], self::getMaxDiffPoint($board, $possiblePlace, $color));
        }

        return $maxPointPlaceArray;
    }

    private function getMaxDiffPoint($board, $possiblePlace, $playerColor) {
        $position = array($possiblePlace[0], $possiblePlace[1]);
        $point = $possiblePlace[2];
        $board = Piece::setPiece($board, $position, $playerColor);
        $enemyPossiblePlaceArray = Piece::getPossiblePlaceArray($board, Player::getEnemyColor($playerColor));
        $point = self::getMaxPoint($enemyPossiblePlaceArray);

        return $point - $getMaxEnemyPoint;
    }

    private function getMaxPoint($possiblePlaceArray) {
        $point = PHP_INT_MIN;
        if (empty($possiblePlaceArray)) {
            return 0;
        }

        $position = array(0, 0);
        foreach ($possiblePlaceArray as $possiblePlace) {
            if ($point <= $possiblePlace[2]) {
                $point = $possiblePlace[2];
                $position = array($possiblePlace[0], $possiblePlace[1]);
            }
        }
        return $point;
    }

    private static function chosePosition($possiblePlaceArray) {
        $position = array();
        $getMaxPiece = 0;
        foreach ($possiblePlaceArray as $possiblePlace) {
            if ($getMaxPiece <= $possiblePlace[2]) {
                $position[0] = $possiblePlace[0];
                $position[1] = $possiblePlace[1];
            }
        }
        return $position;
    }

}