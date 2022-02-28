<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RestaurantTable\BulkDestroyRestaurantTable;
use App\Http\Requests\Admin\RestaurantTable\DestroyRestaurantTable;
use App\Http\Requests\Admin\RestaurantTable\IndexRestaurantTable;
use App\Http\Requests\Admin\RestaurantTable\StoreRestaurantTable;
use App\Http\Requests\Admin\RestaurantTable\UpdateRestaurantTable;
use App\Models\RestaurantTable;
use Brackets\AdminListing\Facades\AdminListing;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class RestaurantTablesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexRestaurantTable $request
     * @return array|Factory|View
     */
    public function index(IndexRestaurantTable $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(RestaurantTable::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'number_of_seats', 'table_number'],

            // set columns to searchIn
            ['table_number']
        );

        if ($request->ajax()) {
            if ($request->has('bulk')) {
                return [
                    'bulkItems' => $data->pluck('id')
                ];
            }
            return ['data' => $data];
        }

        return view('admin.restaurant-table.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.restaurant-table.create');

        return view('admin.restaurant-table.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRestaurantTable $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreRestaurantTable $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Store the RestaurantTable
        $restaurantTable = RestaurantTable::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/restaurant-tables'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/restaurant-tables');
    }

    /**
     * Display the specified resource.
     *
     * @param RestaurantTable $restaurantTable
     * @throws AuthorizationException
     * @return void
     */
    public function show(RestaurantTable $restaurantTable)
    {
        $this->authorize('admin.restaurant-table.show', $restaurantTable);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param RestaurantTable $restaurantTable
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(RestaurantTable $restaurantTable)
    {
        $this->authorize('admin.restaurant-table.edit', $restaurantTable);


        return view('admin.restaurant-table.edit', [
            'restaurantTable' => $restaurantTable,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRestaurantTable $request
     * @param RestaurantTable $restaurantTable
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateRestaurantTable $request, RestaurantTable $restaurantTable)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values RestaurantTable
        $restaurantTable->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/restaurant-tables'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/restaurant-tables');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyRestaurantTable $request
     * @param RestaurantTable $restaurantTable
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyRestaurantTable $request, RestaurantTable $restaurantTable)
    {
        if ($restaurantTable->reservations()->count()) {
            
            if ($request->ajax()) {
                return response(['message' => trans('This Table has Reservations and cannot be deleted')], 422);
            }
        }else{

            $restaurantTable->delete();
            if ($request->ajax()) {
                return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
            }
    
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyRestaurantTable $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyRestaurantTable $request) : Response
    {
        // DB::transaction(static function () use ($request) {
        //     collect($request->data['ids'])
        //         ->chunk(1000)
        //         ->each(static function ($bulkChunk) {
        //             RestaurantTable::whereIn('id', $bulkChunk)->delete();

        //             // TODO your code goes here
        //         });
        // });

        // return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
