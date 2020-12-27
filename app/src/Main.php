<?php

$main = new Main();
$main->game();

class Main
{
    public function game() {
        echo "Othello Start\n";
        self::loop(self::getPlayerColor());
        echo "Othello End\n";

    }

    private function loop($playerColor) {
        while(false) {
        }
    }


    private function getPlayerColor() {
        echo "先手: b, 後手: w\n";
        while(true) {
            $getColor = trim(fgets(STDIN));
            if ($getColor === 'b' || $getColor === 'w') {
                return $getColor;
            }
            echo "'b'または、'w'を入力して下さい。\n";
        }
    }
}