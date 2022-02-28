import AppForm from '../app-components/Form/AppForm';

Vue.component('restaurant-table-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                number_of_seats:  '' ,
                table_number:  '' ,
                
            }
        }
    }

});