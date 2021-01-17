<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

include_once "autoload.php";

use Board\Board;
use Board\Position;
use Board\Side;

// Initialising board & sides
$board     = new Board(8, 8);
$sideWhite = new Side(Side::COLOR_WHITE, Side::DIR_UP);
$sideBlack = new Side(Side::COLOR_BLACK, Side::DIR_DOWN);

// Adding pieces
$board->addPiece(new Piece\Pawn($sideBlack), Position::get('B7'));
$board->addPiece(new Piece\Pawn($sideBlack), Position::get('C7'));

$board->addPiece(new Piece\Pawn($sideWhite), Position::get('B2'));
$board->addPiece(new Piece\Pawn($sideWhite), Position::get('B6'));
$board->addPiece(new Piece\Pawn($sideWhite), Position::get('G7'));

$board->addPiece(new Piece\Bishop($sideBlack), Position::get('D4'));

// Prompt with moves
foreach ($board->getNonEmptySquares() as $square) {
    $side           = $square->getPiece()->getSide()->getColor();
    $pieceClass     = get_class($square->getPiece());
    $squareName     = $square->getPosition()->getSquareName();
    $availableMoves = $board->getPieceAvailableMoves($square->getPosition())->asString();
    printf('%s %s on %s available moves: %s<br>', $side, $pieceClass, $squareName, $availableMoves);
}
