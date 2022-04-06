<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Favorite extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     *
     */
    protected $table ='favorites';
    protected $fillable = [
        'user_id',
        'event_id',
    ];

    /**
     * @return BelongsTo
     */
    public function event(): BelongsTo
    {
        return $this->belongsTo( Event::class );
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo( User::class );
    }

}
