<?php

Class Enemy
{
    const DEBUG = true;

    public static function move($board, $playerColor) {
        $possiblePlaceArray = Piece::getPossiblePlaceArray($board, $playerColor);
        if (empty($possiblePlaceArray)) {
            echo "指せる手がありません。\n";
            return $board;
        }
        //$position = self::chosePosition($possiblePlaceArray);
        $position = self::AI($board, $possiblePlaceArray, $playerColor);
        $board = Piece::setPiece($board, $position, $playerColor);
        echo "相手の手 : ([$position[0], $position[1]])\n";
        return $board;
    }

    private static function AI($board, $possiblePlaceArray, $playerColor) {
        $boardArray = array();
        $positionArray = array();
        foreach ($possiblePlaceArray as $possiblePlace) {
            $position = array($possiblePlace[0], $possiblePlace[1]);
            $getPointArray[] = self::getMaxDiffPoint($board, $possiblePlace, $playerColor);
        }

        $keepPoint = array(0, 0);
        foreach ($getPointArray as $index => $getPoint) {
            if ($keepPoint[1] <= $getPoint) {
                $keepPoint[0] = $index;
                $keepPoint[1] = $getPoint;
            }
        }

        $position = array($possiblePlaceArray[$keepPoint[0]][0], $possiblePlaceArray[$keepPoint[0]][1]);
        return $position;
    }

    private function getMaxDiffPoint($board, $possiblePlace, $playerColor) {
        $position = array($possiblePlace[0], $possiblePlace[1]);
        $point = $possiblePlace[2];

        if (self::DEBUG) {
            echo "着手可能手 [($position[0], $position[1])] : $point -> ";
        }

        $board = Piece::setPiece($board, $position, $playerColor);
        $enemyPossiblePlaceArray = Piece::getPossiblePlaceArray($board, Player::getEnemyColor($playerColor));

        $position = array();
        $getMaxEnemyPoint = PHP_INT_MIN;
        foreach ($enemyPossiblePlaceArray as $enemyPossiblePlace) {
            if ($getMaxEnemyPoint < $enemyPossiblePlace[2]) {
                $position = array($enemyPossiblePlace[0], $enemyPossiblePlace[1]);
                $getMaxEnemyPoint = $enemyPossiblePlace[2];
            }
        }

        if (self::DEBUG) {
            echo "相手の予想手 [($position[0], $position[1])] : $getMaxEnemyPoint\n";
            Board::display($board);
        }

        return $point - $getMaxEnemyPoint;
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