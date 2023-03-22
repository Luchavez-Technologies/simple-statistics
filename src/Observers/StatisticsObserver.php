<?php

namespace Luchavez\SimpleStatistics\Observers;

use Luchavez\SimpleStatistics\Models\Statistics;

/**
 * Class StatisticsObserver
 *
 * @author James Carlo Luchavez <jamescarloluchavez@gmail.com>
 */
class StatisticsObserver
{
    /**
     * Handle events after all transactions are committed.
     *
     * @var bool
     */
    public bool $afterCommit = true;

    /**
     * Handle the Statistics "created" event.
     *
     * @param  Statistics  $statistics
     * @return void
     */
    public function created(Statistics $statistics): void
    {
        //
    }

    /**
     * Handle the Statistics "updated" event.
     *
     * @param  Statistics  $statistics
     * @return void
     */
    public function updated(Statistics $statistics): void
    {
        //
    }

    /**
     * Handle the Statistics "deleted" event.
     *
     * @param  Statistics  $statistics
     * @return void
     */
    public function deleted(Statistics $statistics): void
    {
        //
    }

    /**
     * Handle the Statistics "restored" event.
     *
     * @param  Statistics  $statistics
     * @return void
     */
    public function restored(Statistics $statistics): void
    {
        //
    }

    /**
     * Handle the Statistics "force deleted" event.
     *
     * @param  Statistics  $statistics
     * @return void
     */
    public function forceDeleted(Statistics $statistics): void
    {
        //
    }
}
