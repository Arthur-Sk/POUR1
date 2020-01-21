<?php


namespace PuzzleFactory;


use Exception;
use Puzzle\PourPuzzle;
use Puzzle\PourPuzzleTestCase;

class PourPuzzleFactory
{
    public function buildPuzzle(string $input): PourPuzzle
    {
        $inputArray = explode(PHP_EOL, $input);
        $numberOfTestCases = trim($inputArray[0]);

        if (
            false === is_numeric($numberOfTestCases) ||
            $numberOfTestCases < 1 ||
            $numberOfTestCases > 100
        ) {
            throw new Exception('Invalid number of test cases for the pour puzzle');
        }

        $puzzle = new PourPuzzle();
        for ($i = 0; $i < $numberOfTestCases * 3; $i += 3) {
            $firstVolume = (int)$inputArray[$i + 1];
            $secondVolume = (int)$inputArray[$i + 2];
            $goal = (int)$inputArray[$i + 3];

            if (
                $firstVolume <= 0 || $firstVolume > 40000 ||
                $secondVolume <= 0 || $secondVolume > 40000 ||
                $goal <= 0 || $goal > 40000
            ) {
                throw new Exception('Incorrect integers given for pour puzzle test case');
            }

            $puzzleTestCase = new PourPuzzleTestCase($firstVolume, $secondVolume, $goal);
            $puzzle->addTestCase($puzzleTestCase);
        }

        return $puzzle;
    }
}