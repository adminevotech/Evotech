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

class Client extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, LogsActivity, InteractsWithMedia, HasTranslations;

    protected $fillable = ['name', 'link'];
    public $translatable = ['name'];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection(Media_Collections::CLIENT)->singleFile();
    }
}
