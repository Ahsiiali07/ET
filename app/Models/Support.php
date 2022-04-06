<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

/**
 * @property string $name
 * @property string $description
 * @property string $client_email
 * @property integer $status
 */
class Support extends Model
{
    use Notifiable, ModelHelper;

    /** @var string $table */
    protected $table = 'support';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'client_email',
        'description',
        'status',
    ];
}
