import AppListing from '../app-components/Listing/AppListing';

Vue.component('restaurant-table-reservation-listing', {
    // mixins: [AppListing]
    extends:AppListing,
    date(){
        return{
            reservation_start_date:'',
            reservation_from:'',
            reservation_to:'',
        }
    },
    methods:{
        loadData: function loadData(resetCurrentPage) {
            var _this6 = this;

            var options = {
                params: {
                    per_page: this.pagination.state.per_page,
                    page: this.pagination.state.current_page,
                    orderBy: this.orderBy.column,
                    orderDirection: this.orderBy.direction,
                }
            };

            if (resetCurrentPage === true) {
                options.params.page = 1;
            }

            Object.assign(options.params, this.filters);

            axios.get(this.url, options).then(function (response) {
                return _this6.populateCurrentStateAndData(response.data.data);
            }, function (error) {
                // TODO handle error
            });
        },
    }
});