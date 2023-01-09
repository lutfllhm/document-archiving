<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Brackets\Media\HasMedia\ProcessMediaTrait;
use Brackets\Media\HasMedia\AutoProcessMediaTrait;
use Brackets\Media\HasMedia\HasMediaCollectionsTrait;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\HasMedia;
use Brackets\Media\HasMedia\HasMediaThumbsTrait;

class Document extends Model implements HasMedia
{
    // Add Media
    use ProcessMediaTrait;
    use AutoProcessMediaTrait;
    use HasMediaCollectionsTrait;
    use HasMediaThumbsTrait;

    protected $table = 'document';

    protected $fillable = [
        'title',
        'slug',
        'perex',
        'published_at',
        'enabled',

    ];


    protected $dates = [
        'published_at',
        'created_at',
        'updated_at',

    ];

    protected $appends = ['resource_url'];

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute()
    {
        return url('/admin/documents/'.$this->getKey());
    }

    // Added New Gallery Media Collection
    public function registerMediaCollections() : void {
        $this->addMediaCollection('pdf')
            ->accepts('application/pdf')
            ->maxNumberOfFiles(1);
    }

    public function registerMediaConversions(Media $media = null) : void
    {
        $this->autoRegisterThumb200();
    }
}
