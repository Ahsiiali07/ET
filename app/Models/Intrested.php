<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
/**
 * @property int $user_id
 * @property  int $event_id
 *
 */
class Intrested extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     *
     */
    protected $table ='interesteds';
    protected $fillable = [
        'user_id',
        'event_id',
    ];
    /**
     * @return BelongsTo
     */
    public function event(): BelongsTo
    {
        return $this->belongsTo( Events::class,'event_id','id' );
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo( User::class,'user_id','id' );
    }


}
