<?php


namespace Puzzle;


class PourPuzzleTestCase
{
    /**
     * @var int
     */
    private $firstVolume;
    /**
     * @var int
     */
    private $secondVolume;
    /**
     * @var int
     */
    private $goal;

    public function __construct(int $firstVolume, int $secondVolume, int $goal)
    {
        $this->firstVolume = $firstVolume;
        $this->secondVolume = $secondVolume;
        $this->goal = $goal;
    }

    /**
     * @return int
     */
    public function getFirstVolume(): int
    {
        return $this->firstVolume;
    }

    /**
     * @return int
     */
    public function getSecondVolume(): int
    {
        return $this->secondVolume;
    }

    /**
     * @return int
     */
    public function getGoal(): int
    {
        return $this->goal;
    }
}