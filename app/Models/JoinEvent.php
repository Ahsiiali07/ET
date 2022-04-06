<?php

namespace App\Models;

use Doctrine\DBAL\Events;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class JoinEvent extends Model
{
    protected $table='join_events';

    protected $fillable = [
      'user_id',
      'event_id',
      'join-date',
    ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsto(User::class,'users');
    }

    /**
     * @return BelongsTo
     */
    public function event(): BelongsTo
    {
        return $this->belongsto(Event::class,'events');
    }

}

