<?php

use Illuminate\Database\Seeder;

class ScoreTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //データの準備
        $seeds[] = ['name' => 'シングルス'];
        $seeds[] = ['name' => 'ダブルス'];
    
        //DBへの挿入
        foreach($seeds as $seed){
            
            $scoreType = new \App\Models\ScoreType();
            foreach($seed as $key => $value){
                $scoreType->$key = $value;
            }
            $scoreType->save();
        }
    }
}
