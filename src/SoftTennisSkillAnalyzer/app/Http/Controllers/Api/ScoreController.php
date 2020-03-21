<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Score;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ScoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Score::where('user_id' ,    Auth::user()->id )->with([
            'organization1'
            , 'player1_a'
            , 'player1_b'
            , 'organization2'
            , 'player2_a'
            , 'player2_b'
            , 'score_type'
        ])->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // 生成に必要なデータを取得
        return [
            'organizations' => Auth::user()->organizations()->get(),
            'score_types' => \App\Models\ScoreType::get(),
            'game_numbers' => config('score.game_numbers'),
            'players' =>  Auth::user()->players()->get(),
        ];
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param    \Illuminate\Http\Request    $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $organization1 = $user->organization($request->input('new_or_edit_score.organization1_name'));
        $organization2 = $user->organization($request->input('new_or_edit_score.organization2_name'));
        $player1_a = $user->player($request->input('new_or_edit_score.player1_a_name'));
        $player1_b = $user->player($request->input('new_or_edit_score.player1_b_name'));
        $player2_a = $user->player($request->input('new_or_edit_score.player2_a_name'));
        $player2_b = $user->player($request->input('new_or_edit_score.player2_b_name'));

        $score = new Score();
        $score->organization1_id = $organization1->id;
        $score->player1_a_id = $player1_a->id;
        $score->player1_b_id = $player1_b->id;
        $score->organization2_id = $organization2->id;
        $score->player2_a_id = $player2_a->id;
        $score->player2_b_id = $player2_b->id;
        $score->note = $request->input('new_or_edit_score.note');
        $score->game_number = $request->input('new_or_edit_score.game_number');
        $score->score_type_id = \App\Models\ScoreType::find($request->input('new_or_edit_score.score_type_id'))->id;
        $user->scores()->save($score);

        return response($score, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param    int    $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param    int    $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $score = Auth::user()->scores()->find($id);
        return $score ?? abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param    \Illuminate\Http\Request    $request
     * @param    int    $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param    int    $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
