<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Parsedown;

class Answer extends Model
{
    public function question(){
        return $this->belongsTo(Question::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function getBodyHtmlAttribute(){
        return Parsedown::instance()->text($this->body);
    }

    public static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub
        static::created(function ($answer){
            $answer->question->increment('answers_count');
            $answer->question->save();
        });

        static::saved(function ($answer){
            echo "Answer saved\n";
        });
    }

    public function getCreatedDateAttribute(){
        return $this->created_at->diffForHumans();
    }
}