<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Recipe extends Model
{

    /**
     * @var array
     */
    protected $fillable = [
        'uuid', 'title', 'description', 'calories', 'persons', 'time'
    ];

    /**
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'uuid';
    }

    /**
     * @inheritDoc
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function(Recipe $recipe) {
            $recipe->uuid = Str::uuid();
        });

        static::created(function(Recipe $recipe) {
            $recipe->steps()->create([
                'order' => 1
            ]);
            $recipe->ingredients()->create();
            $recipe->kitchenwares()->create();
        });
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function steps()
    {
        return $this->hasMany(Step::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ingredients()
    {
        return $this->hasMany(Ingredient::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function kitchenwares()
    {
        return $this->hasMany(Kitchenware::class);
    }

}
