<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

/**
 * @property string $name
 * @property string $image_url
 */
class Category extends Model {

    use Notifiable, ModelHelper;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'image_url',

    ];





    /**
     * @return HasMany
     */
    public function club(): HasMany
    {
        return $this->hasMany(Place::class);
    }





}
