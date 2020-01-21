<?php


namespace Puzzle;


class PourPuzzle
{
    /**
     * @var array|PourPuzzleTestCase[]
     */
    private $testCases;

    /**
     * @param PourPuzzleTestCase $pourPuzzleTestCase
     * @return $this
     */
    public function addTestCase(PourPuzzleTestCase $pourPuzzleTestCase)
    {
        $this->testCases[] = $pourPuzzleTestCase;
        return $this;
    }

    /**
     * @return array|PourPuzzleTestCase[]
     */
    public function getTestCases()
    {
        return $this->testCases;
    }
}