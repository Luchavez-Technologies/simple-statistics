<?php

namespace Luchtech\SimpleStatistics\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

// Model
use Luchtech\SimpleStatistics\Models\Statistics;

// Requests
use Luchtech\SimpleStatistics\Http\Requests\Statistics\IndexStatisticsRequest;
use Luchtech\SimpleStatistics\Http\Requests\Statistics\StoreStatisticsRequest;
use Luchtech\SimpleStatistics\Http\Requests\Statistics\ShowStatisticsRequest;
use Luchtech\SimpleStatistics\Http\Requests\Statistics\UpdateStatisticsRequest;
use Luchtech\SimpleStatistics\Http\Requests\Statistics\DeleteStatisticsRequest;
use Luchtech\SimpleStatistics\Http\Requests\Statistics\RestoreStatisticsRequest;

// Events
use Luchtech\SimpleStatistics\Events\Statistics\StatisticsCollectedEvent;
use Luchtech\SimpleStatistics\Events\Statistics\StatisticsCreatedEvent;
use Luchtech\SimpleStatistics\Events\Statistics\StatisticsShownEvent;
use Luchtech\SimpleStatistics\Events\Statistics\StatisticsUpdatedEvent;
use Luchtech\SimpleStatistics\Events\Statistics\StatisticsArchivedEvent;
use Luchtech\SimpleStatistics\Events\Statistics\StatisticsRestoredEvent;

/**
 * Class StatisticsController
 *
 * @author James Carlo Luchavez <jamescarlo.luchavez@fligno.com>
 */
class StatisticsController extends Controller
{
    /**
     * Statistics List
     *
     * @group Statistics Management
     *
     * @param IndexStatisticsRequest $request
     * @return JsonResponse
     */
    public function index(IndexStatisticsRequest $request): JsonResponse
    {
        $data = new Statistics;

        if ($request->has('full_data') === TRUE) {
            $data = $data->get();
        } else {
            $data = $data->simplePaginate($request->get('per_page', 15));
        }

        event(new StatisticsCollectedEvent($data));

        return customResponse()
            ->data($data)
            ->message('Successfully collected record.')
            ->success()
            ->generate();
    }

    /**
     * Create Statistics
     *
     * @group Statistics Management
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function create(Request $request): JsonResponse
    {
        $data = $request->all();

        $model = Statistics::create($data)->fresh();

        event(new StatisticsCreatedEvent($model));

        return customResponse()
            ->data($model)
            ->message('Successfully created record.')
            ->success()
            ->generate();
    }

    /**
     * Store Statistics
     *
     * @group Statistics Management
     *
     * @param StoreStatisticsRequest $request
     * @return JsonResponse
     */
    public function store(StoreStatisticsRequest $request): JsonResponse
    {
        $data = $request->all();

        $model = Statistics::create($data)->fresh();

        event(new StatisticsCreatedEvent($model));

        return customResponse()
            ->data($model)
            ->message('Successfully created record.')
            ->success()
            ->generate();
    }

    /**
     * Show Statistics
     *
     * @group Statistics Management
     *
     * @param ShowStatisticsRequest $request
     * @param Statistics $statistics
     * @return JsonResponse
     */
    public function show(ShowStatisticsRequest $request, Statistics $statistics): JsonResponse
    {
        event(new StatisticsShownEvent($statistics));

        return customResponse()
            ->data($statistics)
            ->message('Successfully collected record.')
            ->success()
            ->generate();
    }

    /**
     * Edit Statistics
     *
     * @group Statistics Management
     *
     * @param Request $request
     * @param Statistics $statistics
     * @return JsonResponse
     */
    public function edit(Request $request, Statistics $statistics): JsonResponse
    {
        // Logic here...

        event(new StatisticsUpdatedEvent($statistics));

        return customResponse()
            ->data($statistics)
            ->message('Successfully updated record.')
            ->success()
            ->generate();
    }

    /**
     * Update Statistics
     *
     * @group Statistics Management
     *
     * @param UpdateStatisticsRequest $request
     * @param Statistics $statistics
     * @return JsonResponse
     */
    public function update(UpdateStatisticsRequest $request, Statistics $statistics): JsonResponse
    {
        // Logic here...

        event(new StatisticsUpdatedEvent($statistics));

        return customResponse()
            ->data($statistics)
            ->message('Successfully updated record.')
            ->success()
            ->generate();
    }

    /**
     * Archive Statistics
     *
     * @group Statistics Management
     *
     * @param DeleteStatisticsRequest $request
     * @param Statistics $statistics
     * @return JsonResponse
     */
    public function destroy(DeleteStatisticsRequest $request, Statistics $statistics): JsonResponse
    {
        $statistics->delete();

        event(new StatisticsArchivedEvent($statistics));

        return customResponse()
            ->data($statistics)
            ->message('Successfully archived record.')
            ->success()
            ->generate();
    }

    /**
     * Restore Statistics
     *
     * @group Statistics Management
     *
     * @param RestoreStatisticsRequest $request
     * @param $statistics
     * @return JsonResponse
     */
    public function restore(RestoreStatisticsRequest $request, $statistics): JsonResponse
    {
        $data = Statistics::withTrashed()->find($statistics)->restore();

        event(new StatisticsRestoredEvent($data));

        return customResponse()
            ->data($data)
            ->message('Successfully restored record.')
            ->success()
            ->generate();
    }
}
