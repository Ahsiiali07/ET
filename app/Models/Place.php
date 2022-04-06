<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Place extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'address',
        'description',
        'image_url',
        'category_id',
        'district_id',
        'user_id'


    ];


    /**
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }


    /**
     * @return BelongsTo
     */
    public function district(): BelongsTo
    {
        return $this->belongsTo(District::class);
    }

    /**
     * @return HasMany
     */
    public function visited(): HasMany {
        return $this->hasMany( PlaceVisited::class,'place_id','id' );
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo( User::class );
    }

//
//    public function visited()
//    {
//        if (auth()->id()) {
//            return $this->hasMany(PlaceVisited::class,'place_id', 'id')->where('user_id', auth()->id());
//        }
//
//        return null;
//    }



}
