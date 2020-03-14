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
    return Score::with([
      'player1_a'
      , 'player1_b'
      , 'player2_a'
      , 'player2_b'
      , 'player1_a.organization'
      , 'player1_b.organization'
      , 'player2_a.organization'
      , 'player2_b.organization'
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
    $organization = \App\Models\Organization::get();
    $score = new \App\Models\Score();
    return [
        'oraganization' => $organization,
        'score_types' => config('score.types'),
        'game_numbers' => config('score.game_numbers'),
        'score' => $score,
    ];
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
      $score = new Score();
      \Log::debug($request);
      $score->player1_a_id = $request->input('player1_a.id');
      $score->player1_b_id = $request->input('player1_b.id');
      $score->player2_a_id = $request->input('player2_a.id');
      $score->player2_b_id = $request->input('player2_b.id');
      $score->note = $request->input('note');
      $score->game_numbers = $request->input('game_numbers');
      $score->score_type_id = $request->input('score_type.id');
      Auth::user()->scores()->save($score);
    return response($score, 201);
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    //
  }
}
