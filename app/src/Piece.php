<?php

Class Piece
{
    public static function acquirablePiece($board, $playerColor, $x, $y) {
        $sum = 0;
        $sum += self::checkLeftUp($board, $playerColor, $x, $y);
        $sum += self::checkUp($board, $playerColor, $x, $y);
        $sum += self::checkRightUp($board, $playerColor, $x, $y);
        $sum += self::checkLeft($board, $playerColor, $x, $y);
        $sum += self::checkRight($board, $playerColor, $x, $y);
        $sum += self::checkLeftDown($board, $playerColor, $x, $y);
        $sum += self::checkDown($board, $playerColor, $x, $y);
        $sum += self::checkRightDown($board, $palyerColor, $x, $y);

        return $sum;
    }

    private function checkLeftUp($board, $playerColor, $x, $y) {
        $count = 0;
        $enemyColor = Player::getEnemyColor($playerColor);
        while(Board::isCheckInBoard($x - 1, $y - 1)) {
            if ($board[$y - 1][$x - 1] !== $enemyColor) {
                break;
            }
            $count++;
            $x--;
            $y--;
        }
        return $board[$y - 1][$x - 1] === $playerColor ? $count : 0;
    }

    private function checkUp($board, $playerColor, $x, $y) {
        $count = 0;
        $enemyColor = Player::getEnemyColor($playerColor);
        while(Board::isCheckInBoard($x, $y - 1)) {
            if($board[$y - 1][$x] !== $enemyColor) {
                break;
            }
            $count++;
            $y--;
        }
        return $board[$y - 1][$x] === $playerColor ? $count : 0;
    }

    private function checkRightUp($board, $playerColor, $x, $y) {
        $count = 0;
        $enemyColor = Player::getEnemyColor($playerColor);
        while(Board::isCheckInBoard($x + 1, $y - 1)) {
            if($board[$y - 1][$x + 1] !== $enemyColor) {
                break;
            }
            $count++;
            $x++;
            $y--;
        }
        return $board[$y - 1][$x + 1] === $playerColor ? $count : 0;
    }

    private function checkLeft($board, $playerColor, $x, $y) {
        $count = 0;
        $enemyColor = Player::getEnemyColor($playerColor);
        while(Board::isCheckInBoard($x - 1, $y)) {
            if($board[$y][$x - 1] !== $enemyColor) {
                break;
            }
            $count++;
            $x--;
        }
        return $board[$y][$x - 1] === $playerColor ? $count : 0;
    }

    private function checkRight($board, $playerColor, $x, $y) {
        $count = 0;
        $enemyColor = Player::getEnemyColor($playerColor);
        while(Board::isCheckInBoard($x + 1, $y)) {
            if($board[$y][$x + 1] !== $enemyColor) {
                break;
            }
            $count++;
            $x++;
        }
        return $board[$y][$x + 1] === $playerColor ? $count : 0;
    }

    private function checkLeftDown($board, $playerColor, $x, $y) {
        $count = 0;
        $enemyColor = Player::getEnemyColor($playerColor);
        while(Board::isCheckInBoard($x - 1, $y - 1)) {
            if($board[$y - 1][$x - 1] !== $enemyColor) {
                break;
            }
            $count++;
            $y--;
            $x--;
        }
        return $board[$y - 1][$x - 1] === $playerColor ? $count : 0;
    }

    private function checkDown($board, $playerColor, $x, $y) {
        $count = 0;
        $enemyColor = Player::getEnemyColor($playerColor);
        while(Board::isCheckInBoard($x, $y + 1)) {
            if($board[$y + 1][$x] !== $enemyColor) {
                break;
            }
            $count++;
            $y++;
        }
        return $board[$y + 1][$x] === $playerColor ? $count : 0;
    }

    private function checkRightDown($board, $playerColor, $x, $y) {
        $count = 0;
        $enemyColor = Player::getEnemyColor($playerColor);
        while(Board::isCheckInBoard($y + 1, $x + 1)) {
            if($board[$y + 1][$x + 1] !== $enemyColor) {
                break;
            }
            $count++;
            $x++;
            $y++;
        }
        return $board[$y + 1][$x + 1] === $playerColor ? $count : 0;
    }

    public static function getPossiblePlaceArray($board, $playerColor) {
        $possiblePlaceArray = array();
        for ($y = 1; $y <= Board::VERTICAL; $y++) {
            for ($x = 1; $x <= Board::HORIZONTAL; $x++) {
                if ($board[$y][$x] === '*') {
                    $pieceCount = self::acquirablePiece($board, $playerColor, $x, $y);
                    if (0 < $pieceCount) {
                        array_push($possiblePlaceArray, array($x, $y, $pieceCount));
                    }
                }
            }
        }
        return $possiblePlaceArray;
    }

    public static function getPieceCount($board) {
        $pieceCount['black'] = 0;
        $pieceCount['white'] = 0;
        for ($y = 1; $y <= Board::VERTICAL; $y++) {
            for ($x = 1; $x <= Board::HORIZONTAL; $x++) {
                if ($board[$y][$x] === 'b') {
                    $pieceCount['black']++;
                } elseif ($board[$y][$x] === 'w') {
                    $pieceCount['white']++;
                }
            }
        }
        return $pieceCount;
    }
}