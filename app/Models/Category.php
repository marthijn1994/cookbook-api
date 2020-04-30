<?php

namespace App\Models;

use App\Models\Traits\HasChildren;
use App\Models\Traits\IsOrderable;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    use IsOrderable, HasChildren;

    /**
     * @var array
     */
    protected $fillable = [
        'order', 'name', 'slug'
    ];

    /**
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function children()
    {
        return $this->hasMany(__CLASS__, 'parent_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function recipes()
    {
        return $this->hasMany(Recipe::class);
    }

}
