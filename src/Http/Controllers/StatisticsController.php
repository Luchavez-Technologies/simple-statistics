<?php

namespace Luchavez\SimpleStatistics\Http\Controllers;

use App\Http\Controllers\Controller;
use Luchavez\SimpleStatistics\Events\Statistics\StatisticsArchivedEvent;
use Luchavez\SimpleStatistics\Events\Statistics\StatisticsCollectedEvent;
use Luchavez\SimpleStatistics\Events\Statistics\StatisticsCreatedEvent;
// Model
use Luchavez\SimpleStatistics\Events\Statistics\StatisticsRestoredEvent;
// Requests
use Luchavez\SimpleStatistics\Events\Statistics\StatisticsShownEvent;
use Luchavez\SimpleStatistics\Events\Statistics\StatisticsUpdatedEvent;
use Luchavez\SimpleStatistics\Http\Requests\Statistics\DeleteStatisticsRequest;
use Luchavez\SimpleStatistics\Http\Requests\Statistics\IndexStatisticsRequest;
use Luchavez\SimpleStatistics\Http\Requests\Statistics\RestoreStatisticsRequest;
use Luchavez\SimpleStatistics\Http\Requests\Statistics\ShowStatisticsRequest;
// Events
use Luchavez\SimpleStatistics\Http\Requests\Statistics\StoreStatisticsRequest;
use Luchavez\SimpleStatistics\Http\Requests\Statistics\UpdateStatisticsRequest;
use Luchavez\SimpleStatistics\Models\Statistics;
use Luchavez\SimpleStatistics\Repositories\StatisticsRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class StatisticsController
 *
 * @author James Carlo Luchavez <jamescarloluchavez@gmail.com>
 */
class StatisticsController extends Controller
{
    /**
     * @param  StatisticsRepository  $statisticsRepository
     */
    public function __construct(public StatisticsRepository $statisticsRepository)
    {
        //
    }

    /**
     * Statistics List
     *
     * @group Statistics Management
     *
     * @param  IndexStatisticsRequest  $request
     * @return JsonResponse
     */
    public function index(IndexStatisticsRequest $request): JsonResponse
    {
        $data = $this->statisticsRepository->getBuilder();

        if ($request->has('full_data') === true) {
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
     * @param  Request  $request
     * @return JsonResponse
     */
    public function create(Request $request): JsonResponse
    {
        $data = $request->all();

        $model = $this->statisticsRepository->create($data)?->fresh();

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
     * @param  StoreStatisticsRequest  $request
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
     * @param  ShowStatisticsRequest  $request
     * @param  Statistics  $statistics
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
     * @param  Request  $request
     * @param  Statistics  $statistics
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
     * @param  UpdateStatisticsRequest  $request
     * @param  Statistics  $statistics
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
     * @param  DeleteStatisticsRequest  $request
     * @param  Statistics  $statistics
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
     * @param  RestoreStatisticsRequest  $request
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
