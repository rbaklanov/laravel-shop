<?php

namespace App\Domain\Filter;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Filter extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'filterable_type',
        'filterable_id',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function filterable(): MorphTo
    {
        return $this->morphTo();
    }
}
