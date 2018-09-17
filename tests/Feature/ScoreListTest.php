<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Game;

class ScoreListTest extends TestCase
{
    protected $game;
	protected $frames;

    public function setUp()
    {
        parent::setUp();
        $this->game = new Game;
        $this->initalizeInputData();
    }

    public function testDefaultInputGivesCorrectScore() 
    {
    	$this->game->setFrames($this->frames);
        $this->assertEquals([7, 16, 26, 41, 46, 54, 63, 71, 78, 96], $this->game->getScoreList());
    }

    public function testAllStrikesGives300() 
    {
    	$this->game->setFrames(self::ALL_STRIKES_INPUT);
        $this->assertEquals([30, 60, 90, 120, 150, 180, 210, 240, 270, 300], $this->game->getScoreList());
    }

    public function testAllOneGives20() 
    {
    	$this->game->setFrames(self::ALL_ONE_INPUT);
        $this->assertEquals([2, 4, 6, 8, 10, 12, 14, 16, 18, 20], $this->game->getScoreList());
    }

}
