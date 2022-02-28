import AppForm from '../app-components/Form/AppForm';

Vue.component('restaurant-table-reservation-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                reservation_date:  '' ,
                reservation_start_time:  '' ,
                reservation_end_time:  '' ,
                created_by:  '' ,
                restaurant_table_id:  '' ,
                
            }
        }
    }

});