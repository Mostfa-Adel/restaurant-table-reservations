@extends('brackets/admin-ui::admin.layout.default')

@section('title', trans('admin.restaurant-table-reservation.actions.index'))

@section('body')

    <restaurant-table-reservation-listing
        :data="{{ $data->toJson() }}"
        :url="'{{ url('admin/restaurant-table-reservations') }}'"
        :filters="['reservation_date']"

        inline-template>

        <div class="row">
            <div class="col">
                <div class="card">
                    {{-- <div class="card-header">
                        <i class="fa fa-align-justify"></i> {{ trans('admin.restaurant-table-reservation.actions.index') }}
                        <a class="btn btn-primary btn-spinner btn-sm pull-right m-b-0" href="{{ url('admin/restaurant-table-reservations/create') }}" role="button"><i class="fa fa-plus"></i>&nbsp; {{ trans('admin.restaurant-table-reservation.actions.create') }}</a>
                    </div> --}}
                    <div class="card-body" v-cloak>
                        <div class="card-block">
                            <form @submit.prevent="">
                                <div class="row justify-content-md-between">
                                    @if (auth()->user()->hasRole('Administrator'))
                                        
                                    <div class="col col-lg-2 col-xl-2 form-group">
                                        <span class="form-label">Reservations From</span>
                                        <div class="input-group">
                                            <input v-model="reservation_from" type="date" class="form-control"  aria-describedby="helpId" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col col-lg-2 col-xl-2 form-group">
                                        <div class="form-group">
                                            <span class="form-label">Reservation To</span>
                                            <input v-model="reservation_to" type="date" class="form-control"  aria-describedby="helpId" placeholder="">
                
                                        </div>
                                    </div>
                                    @endif
                                    <div class="col col-lg-2 col-xl-2 form-group">
                                            <span class="form-label">Table Number</span>
                                            <input v-model="search" class="form-control" placeholder="{{ trans('brackets/admin-ui::admin.placeholder.search') }}"  @keyup.enter="filter('reservation_start_date', $event.target.value)" />
                                            
                                    </div>
                                    <div class="col col-lg-2 col-xl-2 form-group">
                                        <div class="input-group">
                                            <span class="input-group-append">
                                                <span class="form-label">&nbsp;</span>

                                                <button type="button" class="btn btn-primary" @click="filter('search', search);filter('reservation_from', reservation_from);filter('reservation_to', reservation_to);loadData(true)"><i class="fa fa-search"></i>&nbsp; {{ trans('brackets/admin-ui::admin.btn.search') }}</button>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-sm-auto form-group ">
                                        <select class="form-control" v-model="pagination.state.per_page">
                                            
                                            <option value="10">10</option>
                                            <option value="25">25</option>
                                            <option value="100">100</option>
                                        </select>
                                    </div>
                                </div>
                            </form>

                            <table class="table table-hover table-listing">
                                <thead>
                                    <tr>
                                        {{-- <th class="bulk-checkbox">
                                            <input class="form-check-input" id="enabled" type="checkbox" v-model="isClickedAll" v-validate="''" data-vv-name="enabled"  name="enabled_fake_element" @click="onBulkItemsClickedAllWithPagination()">
                                            <label class="form-check-label" for="enabled">
                                                #
                                            </label>
                                        </th> --}}

                                        {{-- <th is='sortable' :column="'id'">{{ trans('admin.restaurant-table-reservation.columns.id') }}</th> --}}
                                        <th is='sortable' :column="'reservation_date'">{{ trans('admin.restaurant-table-reservation.columns.reservation_date') }}</th>
                                        <th is='sortable' :column="'reservation_start_time'">{{ trans('admin.restaurant-table-reservation.columns.reservation_start_time') }}</th>
                                        <th is='sortable' :column="'reservation_end_time'">{{ trans('admin.restaurant-table-reservation.columns.reservation_end_time') }}</th>
                                        {{-- <th is='sortable' :column="'created_by'">{{ trans('admin.restaurant-table-reservation.columns.created_by') }}</th> --}}
                                        <th is='sortable' :column="'restaurant_table_id'">{{ trans('admin.restaurant-table-reservation.columns.restaurant_table_id') }}</th>

                                        <th></th>
                                    </tr>
                                    <tr v-show="(clickedBulkItemsCount > 0) || isClickedAll">
                                        <td class="bg-bulk-info d-table-cell text-center" colspan="8">
                                            <span class="align-middle font-weight-light text-dark">{{ trans('brackets/admin-ui::admin.listing.selected_items') }} @{{ clickedBulkItemsCount }}.  <a href="#" class="text-primary" @click="onBulkItemsClickedAll('/admin/restaurant-table-reservations')" v-if="(clickedBulkItemsCount < pagination.state.total)"> <i class="fa" :class="bulkCheckingAllLoader ? 'fa-spinner' : ''"></i> {{ trans('brackets/admin-ui::admin.listing.check_all_items') }} @{{ pagination.state.total }}</a> <span class="text-primary">|</span> <a
                                                        href="#" class="text-primary" @click="onBulkItemsClickedAllUncheck()">{{ trans('brackets/admin-ui::admin.listing.uncheck_all_items') }}</a>  </span>

                                            <span class="pull-right pr-2">
                                                <button class="btn btn-sm btn-danger pr-3 pl-3" @click="bulkDelete('/admin/restaurant-table-reservations/bulk-destroy')">{{ trans('brackets/admin-ui::admin.btn.delete') }}</button>
                                            </span>

                                        </td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(item, index) in collection" :key="item.id" :class="bulkItems[item.id] ? 'bg-bulk' : ''">
                                        {{-- <td class="bulk-checkbox">
                                            <input class="form-check-input" :id="'enabled' + item.id" type="checkbox" v-model="bulkItems[item.id]" v-validate="''" :data-vv-name="'enabled' + item.id"  :name="'enabled' + item.id + '_fake_element'" @click="onBulkItemClicked(item.id)" :disabled="bulkCheckingAllLoader">
                                            <label class="form-check-label" :for="'enabled' + item.id">
                                            </label>
                                        </td> --}}

                                    {{-- <td>@{{ item.id }}</td> --}}
                                        <td>@{{ item.reservation_date | date }}</td>
                                        <td>@{{ item.reservation_start_time | time }}</td>
                                        <td>@{{ item.reservation_end_time | time }}</td>
                                        {{-- <td>@{{ item.created_by }}</td> --}}
                                        <td>@{{ item.table_description }}</td>
                                        
                                        <td>
                                            <div class="row no-gutters">
                                                {{-- <div class="col-auto">
                                                    <a class="btn btn-sm btn-spinner btn-info" :href="item.resource_url + '/edit'" title="{{ trans('brackets/admin-ui::admin.btn.edit') }}" role="button"><i class="fa fa-edit"></i></a>
                                                </div> --}}
                                                <form class="col" @submit.prevent="deleteItem(item.resource_url)">
                                                    <button type="submit" class="btn btn-sm btn-danger" title="{{ trans('brackets/admin-ui::admin.btn.delete') }}"><i class="fa fa-trash-o"></i></button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <div class="row" v-if="pagination.state.total > 0">
                                <div class="col-sm">
                                    <span class="pagination-caption">{{ trans('brackets/admin-ui::admin.pagination.overview') }}</span>
                                </div>
                                <div class="col-sm-auto">
                                    <pagination></pagination>
                                </div>
                            </div>

                            <div class="no-items-found" v-if="!collection.length > 0">
                                <i class="icon-magnifier"></i>
                                <h3>{{ trans('brackets/admin-ui::admin.index.no_items') }}</h3>
                                <p>{{ trans('brackets/admin-ui::admin.index.try_changing_items') }}</p>
                                <a class="btn btn-primary btn-spinner" href="{{ url('admin/restaurant-table-reservations/create') }}" role="button"><i class="fa fa-plus"></i>&nbsp; {{ trans('admin.restaurant-table-reservation.actions.create') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </restaurant-table-reservation-listing>

@endsection