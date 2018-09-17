<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    
	const ALL_STRIKES_INPUT = [[10],[10],[10],[10],[10],[10],[10],[10],[10],[10,10,10]];
	const ALL_ONE_INPUT = [[1,1],[1,1],[1,1],[1,1],[1,1],[1,1],[1,1],[1,1],[1,1],[1,1]];
    
    protected function initalizeInputData()
    {
        $this->frames = [[5,2],[8,1],[6,4],[10],[0,5],[2,6],[8,1],[5,3],[6,1],[10,2,6]];
    }
}
