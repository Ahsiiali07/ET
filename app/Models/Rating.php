<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $table='ratings';
    protected $fillable=[
      'rating',  'review', 'user_id','event_id'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function event(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {

        return $this->belongsTo(Event::class, 'event_id','id');
    }
}
