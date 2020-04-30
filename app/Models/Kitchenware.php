<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kitchenware extends Model
{

    /**
     * @var array
     */
    protected $fillable = [
        'quantity', 'name', 'description'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function recipe()
    {
        return $this->belongsTo(Recipe::class);
    }

}
