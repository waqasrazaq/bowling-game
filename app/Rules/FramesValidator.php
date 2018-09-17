<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class FramesValidator implements Rule
{
    private $error_message;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $frames = $value;
        $lastFrame = end($frames);
        
        if (sizeof($frames) !== 10) {
            $this->error_message = "Frames count is not equal to 10";
            return false;
        }

        foreach($frames as $frame) {
            if (is_array($frame) === false) {
                $this->error_message = "Each frame should be a type of array";
                return false;
            }

            foreach ($frame as $num) {
                if (is_int($num) === false || $num < 0 || $num > 10) {
                    $this->error_message = "Each number in a frame should always be an integer between 0 and 10";
                    return false;
                }
            }

            if ($frame !== $lastFrame) {
                if (count($frame) > 2) {
                    $this->error_message = "Intermidiate frames cannot have more than 2 shots. Only last frame can have upto three shots";
                    return false;
                }

                if ($frame[0] === 10 && count($frame) > 1) {
                    $this->error_message = "If 1st shot is strike in the intermediate frame then that frame cannot have more shots";
                    return false;
                }

                if (array_sum($frame) > 10) {
                    $this->error_message = "Sum of each intermediate frame cannot exceed 10";
                    return false;
                }
            }

            if (count($frame) > 3) {
                $this->error_message = "Last frame cannot have more than 3 shots";
                return false;
            }

            if ($frame[0] !== 10 && count($frame) > 2) {
                $this->error_message = "In the last frame, if first shot is not a strike then total shots cannot exceed to 2";
                return false;
            }

        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return $this->error_message;
    }
}
