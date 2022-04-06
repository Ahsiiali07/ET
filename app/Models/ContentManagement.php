<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

/**
 * @property string $name
 * @property string $slug
 * @property string $content
 * @property string $type
 */
class ContentManagement extends Model
{
    use Notifiable, ModelHelper;

    protected $table = 'content_management';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
        'slug', 
        'content', 
        'type'
    ];
}
