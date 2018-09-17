<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Rules\FramesValidator;
use InvalidArgumentException;
use Validator;

class Game extends Model
{
	const MAX_FRAMES = 10;
	protected $frames;
	protected $shots;

    /**
     * Sets the user input of frames list if validation passes otherwise throw InvalidArgumentException.
     * @param array
     */
	public function setFrames($frames) {
		
    	$validator = Validator::make(["frames" => $frames], ["frames"=>new FramesValidator]);
		
		if ($validator->fails()) {
			throw new InvalidArgumentException($validator->messages()->first('frames'));
		}

		$this->frames = $frames;
		$this->shots = array_collapse($frames);
		return $this;
	}

	/**
     * Return true if shot score is 10
     * 
	 * @param  int
	 * @return boolean
	 */
	private function isStrike(int $shotIndex): bool {
		return $this->shots[$shotIndex] === 10;
	}

    /**
     * 
     * @param  int
     * @return int
     */
    private function getStrikeFrameScore(int $shotIndex): int {
    	return 10 + $this->shots[$shotIndex + 1] + $this->shots[$shotIndex + 2];
    }

    /**
     *
     * @param $shotIndex
     * @return int
     */
    private function getNonStrikeFrameScore(int $shotIndex): int {
    	return $this->shots[$shotIndex] + $this->shots[$shotIndex + 1];
    }
    
    /**
     * @return array
     */
    public function getScoreList(): array {
    	$scoreList = [];
    	$shotIndex = 0;
    	$totalScore = 0;

    	for($i=0; $i<self::MAX_FRAMES; $i++) {
    		if ($this->isStrike($shotIndex)) {
    			$totalScore = $totalScore + $this->getStrikeFrameScore($shotIndex);
    			$shotIndex++;
    		} else {
    			$totalScore = $totalScore + $this->getNonStrikeFrameScore($shotIndex);
    			$shotIndex = $shotIndex + 2;
    		}
    		$scoreList[] = $totalScore;
    	}
    	return $scoreList;
    }
}
