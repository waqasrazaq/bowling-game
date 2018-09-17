<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Game;
use InvalidArgumentException;

class GameInputTest extends TestCase
{
	protected $game;
	protected $frames;

    public function setUp()
    {
        parent::setUp();
        $this->game = new Game;
        $this->initalizeInputData();
    }

    public function testFailIfFramesCountIsNotEqual10() 
    {
    	$this->expectException(InvalidArgumentException::class);
    	 $this->expectExceptionMessage("Frames count is not equal to 10");
        $this->game->setFrames(array_merge($this->frames, [1]));
    }

    public function testFailIfNonLastFrameHasMoreThan2Shots() 
    {
    	$this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Intermidiate frames cannot have more than 2 shots. Only last frame can have upto three shots");
        $this->frames[rand(0, 8)] = [3, 3, 6];
        $this->game->setFrames($this->frames); 
    }

    public function testFailIfNonLastFrameHasStrikeAndThatFrameContainsShotsMoreThan1() 
    {
    	$this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("If 1st shot is strike in the intermediate frame then that frame cannot have more shots");
        $this->frames[2] = [10 ,6];
        $this->game->setFrames($this->frames); 
    }

    public function testFailIfFrameTypeIsNotArray()
    {
    	$this->expectException(InvalidArgumentException::class);
    	$this->expectExceptionMessage("Each frame should be a type of array");
        $this->frames[1] = "non array frame"; 
        $this->game->setFrames($this->frames);
    }

    public function testFailIfSumOfNonLastFramesGreaterThan10() 
    {
    	$this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Sum of each intermediate frame cannot exceed 10");
        $this->frames[2] = [5, 6];
        $this->game->setFrames($this->frames); 
    }

    public function testFailIfLastFrameHasNoStrikeButShotCountIsGreaterThan2() 
    {
    	$this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("In the last frame, if first shot is not a strike then total shots cannot exceed to 2");
        $this->frames[9] = [3, 5, 1];
        $this->game->setFrames($this->frames); 
    }
}
