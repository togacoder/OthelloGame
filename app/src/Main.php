<?php
require "Player.php";

$main = new Main();
$main->game();

class Main
{
    public function game() {
        echo "Othello Start\n";
        self::loop(Player::getPlayerColor());
        echo "Othello End\n";
    }

    private function loop($playerColor) {
        $bd = new Board();
        $board = $bd->boardInit();
        $bd->display($board);
        while(true) {
            // 勝敗判定
            $result = self::judgment($board);
            if ($result) {
                echo "$result\n";
                return;
            }
            // 駒を置く
            // 着手可能手
            $possiblePlaceArray = self::getPossiblePlaceArray($board, $playerColor);
            foreach ($possiblePlaceArray as $value) {
                echo "$value[0], $value[1] = $value[2]\n";
            }
            while(true) {
                $position = Player::getPlayerPosition();
                $board = $bd->setPiece($board, $position, $playerColor);
                break;
            }

        }
    }

    private function getPossiblePlaceArray($board, $playerColor) {
        $possiblePlaceArray = array();
        for ($y = 1; $y <= Board::VERTICAL; $y++) {
            for ($x = 1; $x <= Board::HORIZONTAL; $x++) {
                if ($board[$x][$y] === '*') {
                    $pieceCount = self::acquirablePiece($board, $playerColor, $x, $y);
                    if (0 < $pieceCount) {
                        array_push($possiblePlaceArray, array($x, $y, $pieceCount));
                    }
                }
            }
            break;
        }
        return $possiblePlaceArray;
    }

    private function acquirablePiece($board, $playerColor, $x, $y) {
        //self::checkLefteftUp($x, $y, $board);
    }

    private function judgment($board) {
        $pieceCount = self::getPieceCount($board);
        $blackCount = $pieceCount['black'];
        $whiteCount = $pieceCount['white'];
        echo "black: $blackCount\twhite: $whiteCount\n";
        if($blackCount === 0) {
            return 'w1';
        } elseif ($whiteCount === 0) {
            return 'b1';
        }

        if ($blackCount + $whiteCount == Board::VERTICAL * Board::HORIZONTAL) {
            if ($blackCount < $whiteCount) {
                return 'w2';
            } elseif ($blackCount > $whiteCount) {
                return 'b2';
            } else {
                return 'd2';
            }
        }
        return 0;
    }

    private function getPieceCount($board) {
        $pieceCount['black'] = 0;
        $pieceCount['white'] = 0;
        for ($y = 1; $y <= BOARD::VERTICAL; $y++) {
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