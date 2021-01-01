<?php

Class Piece
{
    public static function setPiece($board, $position, $playerColor) {
        $x = $position[0];
        $y = $position[1];
        $board[$y][$x] = $playerColor;
        $board = self::pieceReverce($board, $playerColor, $x, $y);
        Board::display($board);
        return $board;
    }

    private function pieceReverce($board, $playerColor, $x, $y) {
        $board = self::pieceReverceRightDown($board, $playerColor, $x, $y);
        $board = self::pieceReverceLeftDown($board, $playerColor, $x, $y);
        $board = self::pieceReverceDown($board, $playerColor, $x, $y);
        $board = self::pieceReverceRight($board, $playerColor, $x, $y);
        $board = self::pieceReverceLeft($board, $playerColor, $x, $y);
        $board = self::pieceReverceRightUp($board, $playerColor, $x, $y);
        $board = self::pieceReverceLeftUp($board, $playerColor, $x, $y);
        $board = self::pieceReverceUp($board, $playerColor, $x, $y);

        return $board;
    }

     private function pieceReverceRightDown($board, $playerColor, $x, $y) {
        if (self::checkRightDown($board, $playerColor, $x, $y) <= 0) {
            return $board;
        }

        $enemyColor = Player::getEnemyColor($playerColor);
        while ($board[$y + 1][$x + 1
            ] === $enemyColor) {
            $x++;
            $y++;
            $board[$y][$x] = $playerColor;
        }

        return $board;
    }

    private function pieceReverceDown($board, $playerColor, $x, $y) {
        if (self::checkDown($board, $playerColor, $x, $y) <= 0) {
            return $board;
        }

        $enemyColor = Player::getEnemyColor($playerColor);
        while ($board[$y + 1][$x] === $enemyColor) {
            $y++;
            $board[$y][$x] = $playerColor;
        }

        return $board;
    }

    private function pieceReverceLeftDown($board, $playerColor, $x, $y) {
        if (self::checkLeftDown($board, $playerColor, $x, $y) <= 0) {
            return $board;
        }

        $enemyColor = Player::getEnemyColor($playerColor);
        while ($board[$y + 1][$x - 1] === $enemyColor) {
            $x--;
            $y++;
            $board[$y][$x] = $playerColor;
        }

        return $board;

    }

    private function pieceReverceRight($board, $playerColor, $x, $y) {
        if (self::checkRight($board, $playerColor, $x, $y) <= 0) {
            return $board;
        }

        $enemyColor = Player::getEnemyColor($playerColor);
        while ($board[$y][$x + 1] === $enemyColor) {
            $x++;
            $board[$y][$x] = $playerColor;
        }

        return $board;
    }

     private function pieceReverceLeft($board, $playerColor, $x, $y) {
        if (self::checkLeft($board, $playerColor, $x, $y) <= 0) {
            return $board;
        }

        $enemyColor = Player::getEnemyColor($playerColor);
        while ($board[$y][$x - 1] === $enemyColor) {
            $x--;
            $board[$y][$x] = $playerColor;
        }

        return $board;
    }

    private function pieceReverceRightUp($board, $playerColor, $x, $y) {
        if (self::checkRightUp($board, $playerColor, $x, $y) <= 0) {
            return $board;
        }

        $enemyColor = Player::getEnemyColor($playerColor);
        while ($board[$y - 1][$x + 1] === $enemyColor) {
            $x++;
            $y--;
            $board[$y][$x] = $playerColor;
        }

        return $board;
    }

    private function pieceReverceUp($board, $playerColor, $x, $y) {
        if (self::checkUp($board, $playerColor, $x, $y) <= 0) {
            return $board;
        }

        $enemyColor = Player::getEnemyColor($playerColor);
        while ($board[$y - 1][$x] === $enemyColor) {
            $y--;
            $board[$y][$x] = $playerColor;
        }

        return $board;
    }

    private function pieceReverceLeftUp($board, $playerColor, $x, $y) {
        if (self::checkLeftUp($board, $playerColor, $x, $y) <= 0) {
            return $board;
        }

        $enemyColor = Player::getEnemyColor($playerColor);
        while ($board[$y - 1][$x - 1] === $enemyColor) {
            $x--;
            $y--;
            $board[$y][$x] = $playerColor;
        }

        return $board;
    }

    public static function getPlaceWeightPoint($board, $playerColor, $x, $y) {
        $sum = 0;
        $sum += self::checkLeftUp($board, $playerColor, $x, $y);
        $sum += self::checkUp($board, $playerColor, $x, $y);
        $sum += self::checkRightUp($board, $playerColor, $x, $y);
        $sum += self::checkLeft($board, $playerColor, $x, $y);
        $sum += self::checkRight($board, $playerColor, $x, $y);
        $sum += self::checkLeftDown($board, $playerColor, $x, $y);
        $sum += self::checkDown($board, $playerColor, $x, $y);
        $sum += self::checkRightDown($board, $palyerColor, $x, $y);

        if(0 < $sum) {
            $sum += Board::isCheckInBoard($x, $y) ? 1 : 0;
            $sum += Board::isCheckCorners($x, $y) ? 10 : 0;
        }

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
        while(Board::isCheckInBoard($x - 1, $y + 1)) {
            if($board[$y + 1][$x - 1] !== $enemyColor) {
                break;
            }
            $count++;
            $y++;
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
                    $pieceCount = self::getPlaceWeightPoint($board, $playerColor, $x, $y);
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