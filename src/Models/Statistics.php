<?php

namespace Luchavez\SimpleStatistics\Models;

use Luchavez\SimpleStatistics\Traits\HasStatisticsFactoryTrait;
use Luchavez\StarterKit\Traits\UsesUUIDTrait;
use Illuminate\Database\Eloquent\Casts\AsCollection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Statistics
 *
 * Note:
 * By default, models and factories inside a package need to explicitly connect with each other.
 *
 * @author James Carlo Luchavez <jamescarloluchavez@gmail.com>
 */
class Statistics extends Model
{
    use UsesUUIDTrait;
    use SoftDeletes;
    use HasStatisticsFactoryTrait;

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
        'type',
        'sub_type',
        'description',
        'data',
        'start_at',
        'end_at',
        'deleted_at',
    ];

    protected $casts = [
        'data' => AsCollection::class,
        'start_at' => 'timestamp',
        'end_at' => 'timestamp',
    ];

    /******** RELATIONSHIPS ********/

    //

    /***** ACCESSORS & MUTATORS *****/

    //

    /******** OTHER METHODS ********/

    //
}
