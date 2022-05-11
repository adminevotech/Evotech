<?php

namespace App\Models;

use App\Constants\Media_Collections;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;

class Service extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, LogsActivity, HasTranslations, InteractsWithMedia;
    protected $fillable = ['title', 'description', 'short_description', 'active'];
    public $translatable = ['title', 'description', 'short_description'];

    //media
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection(Media_Collections::SERVICE_COVER)->singleFile();
        $this->addMediaCollection(Media_Collections::SERVICE_PHOTO)->singleFile();
    }
}
