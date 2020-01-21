<?php
$loader = require_once __DIR__ . '/../vendor/autoload.php';

use Formatter\HtmlFormatter;
use PuzzleFactory\PourPuzzleFactory;
use PuzzleSolver\PourPuzzleSolver;

if (isset($_POST['input'])) {
    $input = $_POST['input'];

    $formatter = new HtmlFormatter();
    $puzzleSolver = new PourPuzzleSolver($formatter);
    $puzzleFactory = new PourPuzzleFactory();

    $puzzle = $puzzleFactory->buildPuzzle($input);
    $output = $puzzleSolver->solve($puzzle);
}

include_once __DIR__ . '/../src/views/form.php';