<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ScorePost extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'score_type_id' => 'required',
            'game_numbers' => 'required',
            'player1_a' => 'required',
            'player1_b' => 'required',
            'player2_a' => 'required',
            'player2_b' => 'required',
            'match_day' => 'required',
        ];
    }

    /**
    * 定義済みバリデーションルールのエラーメッセージ取得
    *
    * @return array
    */
    public function messages()
    {
        return [
            'score_type_id.required' => 'シングルスかダブルスを選択してください',
            'game_numbers.required'  => 'ゲーム数を指定してください',
            'player1_a.required'  => 'プレイヤーを指定してください',
            'player1_b.required'  => 'プレイヤーを指定してください',
            'player2_a.required'  => 'プレイヤーを指定してください',
            'player2_b.required'  => 'プレイヤーを指定してください',
            'match_day.required'  => '試合日を設定してください',
        ];
    }
}
