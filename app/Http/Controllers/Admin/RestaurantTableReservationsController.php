<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RestaurantTableReservation\BulkDestroyRestaurantTableReservation;
use App\Http\Requests\Admin\RestaurantTableReservation\DestroyRestaurantTableReservation;
use App\Http\Requests\Admin\RestaurantTableReservation\IndexRestaurantTableReservation;
use App\Http\Requests\Admin\RestaurantTableReservation\StoreRestaurantTableReservation;
use App\Http\Requests\Admin\RestaurantTableReservation\UpdateRestaurantTableReservation;
use App\Models\RestaurantTable;
use App\Models\RestaurantTableReservation;
use App\Services\ReservationService;
use App\Services\Settings;
use Brackets\AdminListing\Facades\AdminListing;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Support\Facades\Gate;

class RestaurantTableReservationsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexRestaurantTableReservation $request
     * @return array|Factory|View
     */
    public function index(IndexRestaurantTableReservation $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(RestaurantTableReservation::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'reservation_date', 'reservation_start_time', 'reservation_end_time', 'table_number', 'table_seats_count', 'created_by', 'restaurant_table_id', 'guests_count', 'note'],

            // set columns to searchIn
            ['table_number'],
            function ($q) use ($request) {
                
                if (auth()->user()->hasRole('Administrator')) {
                    
                    $q->when($request->reservation_from, function ($qq) use ($request){
                        $qq->where('reservation_date', '>=', $request->reservation_from);
                    });
                    $q->when($request->reservation_to, function ($qq) use ($request){
                        $qq->where('reservation_date', '<=', $request->reservation_to);
                    });
                }else{
                    $q->where('reservation_date', date('Y-m-d'));
                }

            }
        );

        if ($request->ajax()) {
            if ($request->has('bulk')) {
                return [
                    'bulkItems' => $data->pluck('id')
                ];
            }
            return ['data' => $data];
        }

        return view('admin.restaurant-table-reservation.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.restaurant-table-reservation.create');

        return view('admin.restaurant-table-reservation.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRestaurantTableReservation $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreRestaurantTableReservation $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Store the RestaurantTableReservation
        $restaurantTableReservation = RestaurantTableReservation::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/restaurant-table-reservations'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/restaurant-table-reservations');
    }

    /**
     * Display the specified resource.
     *
     * @param RestaurantTableReservation $restaurantTableReservation
     * @throws AuthorizationException
     * @return void
     */
    public function show(RestaurantTableReservation $restaurantTableReservation)
    {
        $this->authorize('admin.restaurant-table-reservation.show', $restaurantTableReservation);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param RestaurantTableReservation $restaurantTableReservation
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(RestaurantTableReservation $restaurantTableReservation)
    {
        $this->authorize('admin.restaurant-table-reservation.edit', $restaurantTableReservation);


        return view('admin.restaurant-table-reservation.edit', [
            'restaurantTableReservation' => $restaurantTableReservation,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRestaurantTableReservation $request
     * @param RestaurantTableReservation $restaurantTableReservation
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateRestaurantTableReservation $request, RestaurantTableReservation $restaurantTableReservation)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values RestaurantTableReservation
        $restaurantTableReservation->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/restaurant-table-reservations'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/restaurant-table-reservations');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyRestaurantTableReservation $request
     * @param RestaurantTableReservation $restaurantTableReservation
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyRestaurantTableReservation $request, RestaurantTableReservation $restaurantTableReservation)
    {
        
        if ($restaurantTableReservation->reservation_date == date('Y-m-d') && $restaurantTableReservation->reservation_start_time>date('H:i:s')) {

            $restaurantTableReservation->delete();
    
            if ($request->ajax()) {
                return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
            }
        }else{
            return response(['message' => trans('Reservations In The past not allowed to be deleted')], 422);

        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyRestaurantTableReservation $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyRestaurantTableReservation $request): Response
    {
        // DB::transaction(static function () use ($request) {
        //     collect($request->data['ids'])
        //         ->chunk(1000)
        //         ->each(static function ($bulkChunk) {
        //             RestaurantTableReservation::whereIn('id', $bulkChunk)->delete();

        //             // TODO your code goes here
        //         });
        // });

        // return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }


    public function makeReservation(Settings $settings)
    {

        Gate::authorize('admin.restaurant-table-reservation.create');
        $data=[];

        return view('admin.restaurant-table-reservation.makeReservation', ['data' => $data, 'settings' => $settings]);
    }


    public function seachAvailableTimes(Request $request, ReservationService $reservationService)
    {
        Gate::authorize('admin.restaurant-table-reservation.create');

        $requiredSeats = (int)$request->required_Seats;
        if (!($requiredSeats && is_numeric($requiredSeats) && $requiredSeats <= Settings::getMaxSeatsPerTable())) {
            return response(
                [
                    'success' => false,
                    'message' => "Please Enter valid Required Seats Less Than Or Equal " .  Settings::getMaxSeatsPerTable()
                ],
                422
            );
        }
        $minRequiredSeats = $reservationService->minRequiredSeats($requiredSeats);
        $availableTables = RestaurantTable::where('number_of_seats', $minRequiredSeats)->get();
        if (!$availableTables->count()) {
            return response(
                [
                    'success' => false,
                    'message' => "No Available Tables With This Size In The Current Day :(",
                    'available_times' => []
                ],
                200
            );
            //TODO check This scenario with frontend
        }
        $firstReservationTimeFromNow = $reservationService->getFirstReservationTimeFromNow();
        $available_times = [];
        foreach ($availableTables as $table) {
            $reservations = $table->reservations()
                ->where('reservation_start_time', '>=', $firstReservationTimeFromNow)
                ->where('reservation_date', date('Y-m-d'))
                ->get();
            $rr = $reservationService->tableAvailableTimeSlots($firstReservationTimeFromNow, Settings::getWorkEndTime(), $reservations, $table);
            $available_times = array_merge($available_times, $rr);
        }

        return response(
            [
                'success' => true,
                'message' => "There is Available Dates Today :)",
                'available_times' => $available_times
            ],
            200
        );
    }

    public function execute_reservation(Request $request, ReservationService $reservationService)
    {
        Gate::authorize('admin.restaurant-table-reservation.create');
        
        //TODO validation day today, start && end are times ,  start greater than or equal current(message reservations in the past not allowed),  end greater than start,  end-start=minreservationTime
        $reservation_start_time = date("H:i:s", strtotime($request->reservation_start));
        $reservation_end_time = date("H:i:s", strtotime($request->reservation_end));
        $requiredSeats = (int)$request->seats_count;
        if (!($requiredSeats && is_numeric($requiredSeats) && $requiredSeats <= Settings::getMaxSeatsPerTable())) {
            return response(
                [
                    'success' => false,
                    'message' => "Please Enter valid Required Seats Less Than Or Equal " .  Settings::getMaxSeatsPerTable()
                ],
                422
            );
        }
        $minRequiredSeats = $reservationService->minRequiredSeats($requiredSeats);
        $availableTables = RestaurantTable::where('number_of_seats', $minRequiredSeats)->get();
        if (!$availableTables->count()) {
            return response(
                [
                    'success' => false,
                    'message' => "No Available Tables With This Size In The Current Day :(",
                    'available_times' => []
                ],
                200
            );
            //TODO check This scenario with frontend
        }
        $firstReservationTimeFromNow = $reservationService->getFirstReservationTimeFromNow();
        $available_times = [];
        foreach ($availableTables as $table) {
            $reservations = $table->reservations()
                ->where('reservation_start_time', '>=', $firstReservationTimeFromNow)
                ->where('reservation_date', date('Y-m-d'))
                ->get();
            $reservations2 = $reservationService->tableAvailableTimeSlots($firstReservationTimeFromNow, Settings::getWorkEndTime(), $reservations, $table);
            foreach ($reservations2 as $key => $reservation) {
                if ($reservation_start_time >= $reservation['start'] && $reservation_end_time <= $reservation['end']) {
                    $chosenTable = RestaurantTable::findOrFail($reservation['table_id']);
                    $chosen_reservation = RestaurantTableReservation::create([
                        'reservation_date' => date('Y-m-d'),
                        'reservation_start_time' => $reservation_start_time,
                        'reservation_end_time' => $reservation_end_time,
                        'created_by' => auth()->id(),
                        'restaurant_table_id' => $reservation['table_id'],
                        'note' => $request->note,
                        'guests_count' => $requiredSeats,
                        'table_seats_count' => $chosenTable->number_of_seats,
                        'table_number' => $chosenTable->table_number,


                    ]);
                    return response(
                        [
                            'success' => true,
                            'message' => "Reservation Made Successfully With Table Number 
                            $chosenTable->table_number From $request->reservation_start To $request->reservation_end :)",
                        ],
                        200
                    );
                    break;
                }
            }
        }

        return response(
            [
                'success' => false,
                'message' => "No Available Tables With This Date And Size In The Current Day :(",
            ],
            200
        );
    }
}
