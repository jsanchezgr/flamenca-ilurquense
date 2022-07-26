<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasTimestamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Orchid\Attachment\Attachable;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;


/**
 * @property string   $name
 * @property string   $nick
 * @property string   $slug
 * @property string   $image
 * @property string   $biography
 * @property int      $birthdate
 * @property int      $created_at
 * @property int      $updated_at
 * @property int      $deleted_at
 */
class Artist extends Model
{
    use AsSource,
        Filterable,
        Attachable,
        SoftDeletes,
        HasTimestamps,
        HasSlug,
        HasFactory;

    protected $table = 'artists';

    protected $fillable = [
        'name',
        'nick',
        'slug',
        'image',
        'biography',
        'birthdate',
    ];

    protected $hidden = [

    ];

    protected $casts = [

    ];

    protected $dates = [
        'created_at', 'updated_at', 'deleted_at',
    ];

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('nick')
            ->saveSlugsTo('slug')
            ->usingLanguage('es')
            ->doNotGenerateSlugsOnUpdate();
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
