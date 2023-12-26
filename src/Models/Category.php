<?php

namespace Corals\Modules\CMS\Models;

use Corals\Foundation\Models\BaseModel;
use Corals\Foundation\Transformers\PresentableTrait;
use Illuminate\Database\Eloquent\Builder;
use Spatie\Activitylog\Traits\LogsActivity;

class Category extends BaseModel
{
    use PresentableTrait;
    use LogsActivity;

    /**
     *  Model configuration.
     * @var string
     */
    public $config = 'cms.models.category';

    protected $guarded = ['id'];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('order', function(Builder $builder) {
            $builder->orderBy('categories.name', 'ASC');
        });
    }

    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }

    public function faqs()
    {
        return $this->belongsToMany(Faq::class, 'category_post', 'category_id', 'post_id');
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = \Str::slug($value);
    }
}
