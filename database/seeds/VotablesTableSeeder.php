<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Answer;
use App\Question;
class VotablesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('votables')->delete();
        $users = User::all();
        $numberOfUSer = count($users);

        $votes = [-1,1];

        foreach (Question::all() as $question){
            for ($i = 0; $i<rand(1,$numberOfUSer);$i++){
                $user = $users[$i];
                $user->voteQuestion($question,$votes[rand(0,1)]);
            }
        }
        foreach (Answer::all() as $answer){
            for ($i = 0; $i<rand(1,$numberOfUSer);$i++){
                $user = $users[$i];
                $user->voteAnswer($answer,$votes[rand(0,1)]);
            }
        }

    }
}
