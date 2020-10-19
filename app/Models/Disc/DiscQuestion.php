<?php namespace App\Models\Disc;

use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;

class DiscQuestion extends Model
{
    use Translatable;
    protected $translatable = ['question_1', 'question_2', 'question_3', 'question_4', 'description'];
}