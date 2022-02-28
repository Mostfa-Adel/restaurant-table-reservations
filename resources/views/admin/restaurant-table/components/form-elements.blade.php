<div class="form-group row align-items-center" :class="{'has-danger': errors.has('number_of_seats'), 'has-success': fields.number_of_seats && fields.number_of_seats.valid }">
    <label for="number_of_seats" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.restaurant-table.columns.number_of_seats') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.number_of_seats" v-validate="'required|integer'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('number_of_seats'), 'form-control-success': fields.number_of_seats && fields.number_of_seats.valid}" id="number_of_seats" name="number_of_seats" placeholder="{{ trans('admin.restaurant-table.columns.number_of_seats') }}">
        <div v-if="errors.has('number_of_seats')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('number_of_seats') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('table_number'), 'has-success': fields.table_number && fields.table_number.valid }">
    <label for="table_number" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.restaurant-table.columns.table_number') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.table_number" v-validate="'required|integer'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('table_number'), 'form-control-success': fields.table_number && fields.table_number.valid}" id="table_number" name="table_number" placeholder="{{ trans('admin.restaurant-table.columns.table_number') }}">
        <div v-if="errors.has('table_number')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('table_number') }}</div>
    </div>
</div>


