<div class="form-group row align-items-center" :class="{'has-danger': errors.has('reservation_date'), 'has-success': fields.reservation_date && fields.reservation_date.valid }">
    <label for="reservation_date" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.restaurant-table-reservation.columns.reservation_date') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-sm-8'">
        <div class="input-group input-group--custom">
            <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
            <datetime v-model="form.reservation_date" :config="datePickerConfig" v-validate="'required|date_format:yyyy-MM-dd HH:mm:ss'" class="flatpickr" :class="{'form-control-danger': errors.has('reservation_date'), 'form-control-success': fields.reservation_date && fields.reservation_date.valid}" id="reservation_date" name="reservation_date" placeholder="{{ trans('brackets/admin-ui::admin.forms.select_a_date') }}"></datetime>
        </div>
        <div v-if="errors.has('reservation_date')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('reservation_date') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('reservation_start_time'), 'has-success': fields.reservation_start_time && fields.reservation_start_time.valid }">
    <label for="reservation_start_time" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.restaurant-table-reservation.columns.reservation_start_time') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <div class="input-group input-group--custom">
            <div class="input-group-addon"><i class="fa fa-clock-o"></i></div>
            <datetime v-model="form.reservation_start_time" :config="timePickerConfig" v-validate="'required|date_format:HH:mm:ss'" class="flatpickr" :class="{'form-control-danger': errors.has('reservation_start_time'), 'form-control-success': fields.reservation_start_time && fields.reservation_start_time.valid}" id="reservation_start_time" name="reservation_start_time" placeholder="{{ trans('brackets/admin-ui::admin.forms.select_a_time') }}"></datetime>
        </div>
        <div v-if="errors.has('reservation_start_time')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('reservation_start_time') }}</div>
    </div>
</div>


<div class="form-group row align-items-center" :class="{'has-danger': errors.has('reservation_end_time'), 'has-success': fields.reservation_end_time && fields.reservation_end_time.valid }">
    <label for="reservation_end_time" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.restaurant-table-reservation.columns.reservation_end_time') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <div class="input-group input-group--custom">
            <div class="input-group-addon"><i class="fa fa-clock-o"></i></div>
            <datetime v-model="form.reservation_end_time" :config="timePickerConfig" v-validate="'required|date_format:HH:mm:ss'" class="flatpickr" :class="{'form-control-danger': errors.has('reservation_end_time'), 'form-control-success': fields.reservation_end_time && fields.reservation_end_time.valid}" id="reservation_end_time" name="reservation_end_time" placeholder="{{ trans('brackets/admin-ui::admin.forms.select_a_time') }}"></datetime>
        </div>
        <div v-if="errors.has('reservation_end_time')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('reservation_end_time') }}</div>
    </div>
</div>


<div class="form-group row align-items-center" :class="{'has-danger': errors.has('created_by'), 'has-success': fields.created_by && fields.created_by.valid }">
    <label for="created_by" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.restaurant-table-reservation.columns.created_by') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.created_by" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('created_by'), 'form-control-success': fields.created_by && fields.created_by.valid}" id="created_by" name="created_by" placeholder="{{ trans('admin.restaurant-table-reservation.columns.created_by') }}">
        <div v-if="errors.has('created_by')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('created_by') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('restaurant_table_id'), 'has-success': fields.restaurant_table_id && fields.restaurant_table_id.valid }">
    <label for="restaurant_table_id" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.restaurant-table-reservation.columns.restaurant_table_id') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.restaurant_table_id" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('restaurant_table_id'), 'form-control-success': fields.restaurant_table_id && fields.restaurant_table_id.valid}" id="restaurant_table_id" name="restaurant_table_id" placeholder="{{ trans('admin.restaurant-table-reservation.columns.restaurant_table_id') }}">
        <div v-if="errors.has('restaurant_table_id')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('restaurant_table_id') }}</div>
    </div>
</div>


