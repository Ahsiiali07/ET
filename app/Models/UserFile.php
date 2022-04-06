<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

/**
 * @property string $name
 * @property integer $user_id
 * @property string $url
 */
class UserFile extends Model
{
    use Notifiable, ModelHelper;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'user_id',
        'url',
    ];
}
