<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Score extends Model
{
    protected $appends = [
        'organization1_name',
        'player1_a_name',
        'player1_b_name',
        'organization2_name',
        'player2_a_name',
        'player2_b_name',
        'game_count',
    ];
    /**
     * 関連のあるUserオブジェクトを返す
     *
     * @return \App\User $user
     */
    public function user()
    {
        return $this->belongsTo(\App\User::class);
    }

    public function score_type()
    {
        return $this->belongsTo(ScoreType::class);
    }
    
    /**
     * 関連のあるPlauerオブジェクトを返す
     *
     * @return \App\Models\Player $player
     */
    public function player1_a()
    {
        return $this->belongsTo(Player::class, __FUNCTION__ . '_id');
    }

    /**
     * 関連のあるPlauerオブジェクトを返す
     *
     * @return \App\Models\Player $player
     */
    public function player1_b()
    {
        return $this->belongsTo(Player::class, __FUNCTION__ . '_id');
    }
    /**
     * 関連のあるPlauerオブジェクトを返す
     *
     * @return \App\Models\Player $player
     */
    public function player2_a()
    {
        return $this->belongsTo(Player::class, __FUNCTION__ . '_id');
    }

    /**
     * 関連のあるPlauerオブジェクトを返す
     *
     * @return \App\Models\Player $player
     */
    public function player2_b()
    {
        return $this->belongsTo(Player::class, __FUNCTION__ . '_id');
    }

    /**
     * 関連のあるOrganizationオブジェクトを返す
     *
     * @return BelongsTo
     */
    public function organization1(): BelongsTo
    {
        return $this->belongsTo(Organization::class, __FUNCTION__ . '_id');
    }
    
    /**
     * 関連のあるOrganizationオブジェクトを返す
     *
     * @return BelongsTo
     */
    public function organization2(): BelongsTo
    {
        return $this->belongsTo(Organization::class, __FUNCTION__ . '_id');
    }

    public function getPlayer1ANameAttribute(){
        return $this->player1_a->name;
    }
    public function getPlayer1BNameAttribute(){
        return $this->player1_b->name;
    }
    public function getPlayer2ANameAttribute(){
        return $this->player2_a->name;
    }
    public function getPlayer2BNameAttribute(){
        return $this->player2_b->name;
    }
    public function getOrganization1NameAttribute(){
        return $this->organization1->name;
    }
    public function getOrganization2NameAttribute(){
        return $this->organization2->name;
    }
    public function getGameCountAttribute(){
        return '4-2';
    }
}
