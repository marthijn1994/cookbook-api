<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Step extends Model
{

    /**
     * @var array
     */
    protected $fillable = [
        'uuid', 'order', 'title', 'body'
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

        static::creating(function(Step $step) {
            $step->uuid = Str::uuid();
        });
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function recipe()
    {
        return $this->belongsTo(Recipe::class);
    }

}
