<?php

use Illuminate\Database\Seeder;

class PointKindSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //データの準備
        $seeds[] = ['name' => 'サービス'
                    , 'description' => 'プレーを開始するとき(ポイントの最初)の打球'];
        $seeds[] = ['name' => 'レシーブ'
                    , 'description' => 'サービスへの返球のこと'];
        $seeds[] = ['name' => 'ローボレー'
                    , 'description' => '肩より下の低い球をノーバウンドで返球すること'];
        $seeds[] = ['name' => 'ハイボレー'
                    , 'description' => '顔より高い球をノーバウンドで返球すること'];
        $seeds[] = ['name' => 'ボレー'
                    , 'description' => '顔あたりの球をノーバウンドで返球すること'];
        $seeds[] = ['name' => 'スマッシュ'
                    , 'description' => 'ロビングのボールが落ちてくるところをノーバウンドで打ち込むこと'];
        $seeds[] = ['name' => 'ストローク'
                    , 'description' => 'ワンバウンドで返球すること'];
    
        //DBへの挿入
        foreach($seeds as $seed){
            
            $pointKind = new \App\Models\PointKind();
            foreach($seed as $key => $value){
                $pointKind->$key = $value;
            }
            $pointKind->save();
        }
    }
}
