<?php

use Illuminate\Database\Seeder;

class OrganizationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = \App\User::first();

        //データの準備
        $seeds[] = ['name' => '岐阜しらさぎクラブ', 'user_id' => $user->id];
        $seeds[] = ['name' => '金華クラブ', 'user_id' => $user->id];
        $seeds[] = ['name' => '大翔会', 'user_id' => $user->id];
        $seeds[] = ['name' => '岐阜大学', 'user_id' => $user->id];;
        $seeds[] = ['name' => '岐阜高専', 'user_id' => $user->id];
    
        //DBへの挿入
        foreach($seeds as $seed){
            
            $organization = new \App\Models\Organization();
            foreach($seed as $key => $value){
                $organization->$key = $value;
            }
            $organization->save();
        }
    }
}
