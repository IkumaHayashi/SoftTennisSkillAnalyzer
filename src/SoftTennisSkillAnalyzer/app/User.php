<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Undocumented function
     *
     * @return void
     */
    public function scores() : HasMany
    {
        return $this->hasMany(\App\Models\Score::class);
    }

    /**
     * 作成した組織をすべて返す
     *
     * @return HasMany 組織のリレーション
     */
    public function organizations() : HasMany
    {
        return $this->hasMany(\App\Models\Organization::class);
    }
    
    /**
     * 名前指定で完全一致した作成した組織を1件返す。なければ作成して返す。
     *
     * @param string $name 指定した名前
     * @return \App\Models\Organization 一致 もしくは作成した組織オブジェクトを返す
     */
    public function organization(string $name) : \App\Models\Organization
    {
        $organization = $this->organizations()->where('name', $name)->first();
        if(is_null($organization)){
            $organization = new \App\Models\Organization();
            $organization->name = $name;
            $this->organizations()->save($organization);
        }
        return $organization;
    }
    
    /**
     * 作成したプレイヤーをすべて返す
     *
     * @return HasMany 組織のリレーション
     */
    public function players() : HasMany
    {
        return $this->hasMany(\App\Models\Player::class);
    }
    
    /**
     * 名前指定で完全一致した作成したプレイヤーを1件返す。なければ作成して返す。
     *
     * @param string $name 指定した名前
     * @return \App\Models\Player 一致 もしくは作成したプレイヤーオブジェクトを返す
     */
    public function player(string $name) : \App\Models\Player
    {
        $player = $this->players()->where('name', $name)->first();
        if(is_null($player)){
            $player = new \App\Models\Player();
            $player->name = $name;
            $this->players()->save($player);
        }
        return $player;
    }
}
