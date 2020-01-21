<?php


namespace PuzzleSolver;


use Exception;
use Formatter\OutputFormatter;
use Helper\MathHelper;
use Puzzle\PourPuzzle;
use Puzzle\PourPuzzleTestCase;

class PourPuzzleSolver
{
    /**
     * @var OutputFormatter
     */
    private $outputFormatter;

    /**
     * @var int
     */
    private $depth;

    public function __construct(OutputFormatter $outputFormatter, int $depth = 80000)
    {
        $this->depth = $depth;
        $this->outputFormatter = $outputFormatter;
    }

    /**
     * @inheritDoc
     */
    public function solve(PourPuzzle $puzzle): string
    {
        $output = [];
        foreach ($puzzle->getTestCases() as $testCase) {
            $output[] = $this->solveTestCase($testCase);
        }

        return $this->outputFormatter->format($output);
    }

    protected function solveTestCase(PourPuzzleTestCase $testCase): int
    {
        if (false === $this->isPossibleToFindSolution($testCase)) {
            return -1;
        }

        return $this->calculateStepCountRequired($testCase);
    }

    protected function isPossibleToFindSolution(PourPuzzleTestCase $testCase): bool
    {
        $goal = $testCase->getGoal();
        $firstVolume = $testCase->getFirstVolume();
        $secondVolume = $testCase->getSecondVolume();

        // impossible to solve, if goal is greater than both of vessels
        if ($goal > $firstVolume && $goal > $secondVolume) {
            return false;
        }

        $greatestCommonDivisor = MathHelper::gcd($firstVolume, $secondVolume);
        // also impossible to solve, if greatest common divisor doesn't divide goal
        if ($goal % $greatestCommonDivisor !== 0) {
            return false;
        }

        return true;
    }

    protected function calculateStepCountRequired(PourPuzzleTestCase $testCase): int
    {
        try {
            // Try to pour water from A vessel to B vessel and find the required step count
            $firstAnswer = $this->pourUnilaterally($testCase);
        } catch (Exception $exception) {
            $firstAnswer = null;
        }

        try {
            // Try to pour water in reverse order
            $secondAnswer = $this->pourUnilaterally($testCase, true);
        } catch (Exception $exception) {
            $secondAnswer = null;
        }

        if (null === $firstAnswer && null === $secondAnswer) {
            throw new Exception('Could not find calculate step count');
        }

        return (int)min($firstAnswer, $secondAnswer);
    }

    protected function pourUnilaterally(PourPuzzleTestCase $testCase, $reverse = false): int
    {
        if ($reverse) {
            $fromVolume = $testCase->getSecondVolume();
            $toVolume = $testCase->getFirstVolume();
        } else {
            $fromVolume = $testCase->getFirstVolume();
            $toVolume = $testCase->getSecondVolume();
        }

        $fromCurrentState = 0;
        $toCurrentState = 0;
        $goal = $testCase->getGoal();

        for ($i = 0; $i <= $this->depth; $i++) {
            // Return steps count if goal found
            if ($goal === $fromCurrentState || $goal === $toCurrentState) {
                return $i;
            }

            // If source vessel is empty, fill it
            if ($fromCurrentState === 0) {
                $fromCurrentState = $fromVolume;

                // If target vessel is full, empty it
            } elseif ($toCurrentState === $toVolume) {
                $toCurrentState = 0;
            } else {
                // Otherwise pour water from source vessel to target vessel
                $toCurrentState += $fromCurrentState;
                $fromCurrentState = 0;

                // If target vessel is overfilled, keep some water in source vessel
                if ($toCurrentState > $toVolume) {
                    $fromCurrentState = $toCurrentState - $toVolume;
                    $toCurrentState = $toVolume;
                }
            }
        }

        throw new Exception('Reached maximum depth, could not find solution');
    }
}