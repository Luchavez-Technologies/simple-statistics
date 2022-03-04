<?php

namespace Luchtech\SimpleStatistics\Models;

use Fligno\StarterKit\Traits\UsesUUIDTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Statistics
 *
 * Note:
 * By default, models and factories inside a package need to explicitly connect with each other.
 * Thanks to `fligno/boilerplate-generator` package, once you create a factory file, it will also create a trait.
 * The trait then should be used inside the concerned model.
 *
 * @author James Carlo Luchavez <jamescarlo.luchavez@fligno.com>
 */
class Statistics extends Model
{
    use UsesUUIDTrait, SoftDeletes;

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName(): string
    {
        return 'uuid';
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        // write here...
        'deleted_at',
    ];

    /******** RELATIONSHIPS ********/

    //

    /***** ACCESSORS & MUTATORS *****/

    //

    /******** OTHER METHODS ********/

    //
}
