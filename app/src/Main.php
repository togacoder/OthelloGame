<?php
require "Board.php";
require "Piece.php";
require "Player.php";
require "Enemy.php";

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
        $turnPlayerColor = 'b';
        Board::display($board);
        while(true) {
            // 勝敗判定
            $result = self::judgment($board);
            if ($result) {
                echo "$result Win!!\n";
                return;
            }

            if ($turnPlayerColor === $playerColor) {
                echo "自分のターン\n";
                $board = self::movePlayer($board, $turnPlayerColor);
            } else {
                echo "相手のターン\n";
                $board = Enemy::move($board, $turnPlayerColor);
            }
            Board::display($board);
            $turnPlayerColor = $turnPlayerColor === 'b' ? 'w' : 'b';
        }
    }

    private function movePlayer($board, $playerColor) {
        $possiblePlaceArray = Piece::getPossiblePlaceArray($board, $playerColor);
        self::showPossibleArray($possiblePlaceArray);
        if (empty($possiblePlaceArray)) {
            return $board;
        }
        $position = Player::getPlayerPosition($possiblePlaceArray);
        $board = Piece::setPiece($board, $position, $playerColor);
        return $board;
    }

    public static  function showPossibleArray($possiblePlaceArray) {
        if (empty($possiblePlaceArray)) {
            echo "showPlaceArraey 指せる手がありません。\n";
        }
        echo "(x, y) : point\n";
        foreach ($possiblePlaceArray as $value) {
            echo "([$value[0], $value[1]]) : $value[2], ";
        }
        echo "\n";
    }

    private function judgment($board) {
        $pieceCount = Piece::getPieceCount($board);
        $blackCount = $pieceCount['black'];
        $whiteCount = $pieceCount['white'];
        echo "black: $blackCount\twhite: $whiteCount\n";
        if($blackCount === 0) {
            return 'white';
        } elseif ($whiteCount === 0) {
            return 'black';
        }

        if ($blackCount + $whiteCount == Board::VERTICAL * Board::HORIZONTAL || self::isGameFreeze($board)) {
           return self::pieceCountCompare($blackCount, $whiteCount);
        }

        return 0;
    }

    private function pieceCountCompare($blackCount, $whiteCount) {
        if ($blackCount > $whiteCount) {
            return 'black';
        } elseif ($blackCount < $whiteCount) {
            return 'white';
        } else {
            return 'draw';
        }
    }

    private function isGameFreeze($board) {
        $blackPossiblePlace = count(Piece::getPossiblePlaceArray($board, 'b'));
        $whitePossiblePiece = count(Piece::getPossiblePlaceArray($board, 'w'));

        return ($blackPossiblePlace === 0 && $whitePossiblePiece === 0) ? true : false;
    }
}