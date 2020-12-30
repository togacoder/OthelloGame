<?php
require "Board.php";
require "Piece.php";
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
        $board = Board::boardInit();
        Board::display($board);
        while(true) {
            // 勝敗判定
            $result = self::judgment($board);
            if ($result) {
                echo "$result\n";
                return;
            }
            // 駒を置く
            // 着手可能手
            $possiblePlaceArray = Piece::getPossiblePlaceArray($board, $playerColor);
            foreach ($possiblePlaceArray as $value) {
                echo "$value[0], $value[1] = $value[2]\n";
            }
            while(true) {
                $position = Player::getPlayerPosition();
                $board = Board::setPiece($board, $position, $playerColor);
                break;
            }

        }
    }

    private function judgment($board) {
        $pieceCount = Piece::getPieceCount($board);
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

}