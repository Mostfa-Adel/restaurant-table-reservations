@extends('brackets/admin-ui::admin.layout.default')

@section('title', trans('admin.restaurant-table-reservation.actions.index'))

@section('body')

    <div id="make-reservation" v-pre>
        <modal name="bar" >
            <div class="modal-header text-center ">
                <h4 class="modal-title w-100 font-weight-bold">Create Reservation</h4>

            </div>
            <div class="modal-body mx-3 row">
                <div class="row no-margin">
                    <div class="col-md-4">
                        <div class="form-group">
                            <span class="form-label">Reservaiton Start</span>
                            <vtimepicker v-model="reservation_start" hide-disabled-hours :hour-range="working_hours" :minute-interval="5"
                                format="hh:mm A"></vtimepicker>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <span class="form-label">Reservation End</span>
                            <vtimepicker v-model="reservation_end" hide-disabled-hours :hour-range="working_hours" :minute-interval="5"
                                format="hh:mm A"></vtimepicker>

                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <span class="form-label">Seats</span>
                            <input disabled type="text" :value="seats_count" class="form-control" name="" id=""
                                aria-describedby="helpId" placeholder="">

                        </div>
                    </div>

                </div>

            </div>
            <div class="modal-footer d-flex justify-content-center">

                <a href="#" v-on:click="execute_reservation" class="btn btn-primary ">Execute</a>

            </div>
        </modal>
        <div class="section-center">
            <div class="container">
                <div class="row">
                    <div class="booking-form col-md-8 m-auto">
                        <form>
                            <div class="row no-margin">
                                <div class="col-md-4">
                                    <div class="form-header">
                                        <h4>Pick Required Seats</h4>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-row">
                                        <label class="col-sm-2 col-form-label mr-3" for="seats">Seats </label>

                                        <select v-model="seats_count" class="form-control col-sm-8">
                                            @for ($i = 1; $i <= \App\Services\Settings::getMaxSeatsPerTable(); $i++)
                                                <option value="{{ $i }}">{{ $i }}</option>
                                            @endfor

                                        </select>
                                        <span class="select-arrow"></span>
                                    </div>

                                </div>
                                <div class="col-md-4">
                                    <div class="form-btn">
                                        <a href="#" style="text" class="btn btn-primary"
                                            v-on:click="searchReservation">Check
                                            availability</a>
                                        <a v-if="show_modal_button" href="#" style="text" class="btn btn-primary mt-4"
                                            v-on:click="showReservationForm"> Make Reservation</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-4 " v-for="available_time in available_times">
                        <div class="card">

                            <div class="card-body pb-3">

                                <!-- Title -->
                                <h4 class="card-title font-weight-bold">@{{ available_time.table_description }}</h4>
                                <!-- Text -->

                                <div class="d-flex justify-content-between mb-2">
                                    <p><i class="fas fa-tint fa-lg text-info pr-2"></i>From: @{{ available_time.start }}</p>
                                    <p class="mr-4"><i class="fas fa-leaf fa-lg grey-text pr-2"></i>To:
                                        @{{ available_time.end }}</p>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('bottom-scripts')
    <script>
        app55 = new Vue({
            // components: { VueTimepicker },

            el: '#make-reservation',
            data: {
                reservation_start: '',
                reservation_end: '',
                seats_count: '',
                value: '',
                available_times: [],
                show_modal_button: false,
                max_seats: "{{$settings->getMaxSeatsPerTable()}}",
                seats_arr:[],
                working_hours:[],
                work_start_time:"{{$settings->extractHour($settings->getWorkStartTime())}}",
                work_end_time:"{{$settings->extractHour($settings->getWorkEndTime())}}",

            },
            mounted() {
                this.fill_working_hours()
            },
            methods: {
                fill_working_hours(){
                    d = new Date();
                    hour = d.getHours();
                    if (this.work_start_time>hour) {
                        hour = this.work_start_time
                    }
                    for (let i = hour; i <= this.work_end_time; i++) {
                        this.working_hours.push(i);
                    }
                },

                showReservationForm() {
                    this.$modal.show('bar')

                },
                searchReservation: function(e) {
                    e.preventDefault();
                    this.available_times = []
                    axios.get("/admin/seachAvailableTimes?required_Seats=" + this.seats_count)
                        .then(
                            response => {
                                if (response.data.success) {
                                    this.$notify({
                                        text: response.data.message,
                                        type: 'success'
                                    })
                                    this.available_times = response.data.available_times
                                    this.show_modal_button = true
                                } else {
                                    this.$notify({
                                        text: response.data.message,
                                        type: 'warn'
                                    })

                                }
                            })
                        .catch(error => {
                            this.errorMessage = error.message;
                            console.log(error.response.data.message);
                            this.$notify({
                                text: error.response.data.message,
                                type: 'error'
                            })
                        });


                    return false

                },
                execute_reservation: function(e) {
                    e.preventDefault();
                    axios.post("/admin/execute_reservation", {
                        seats_count:this.seats_count,
                        reservation_start:this.reservation_start,
                        reservation_end:this.reservation_end,
                    })
                        .then(
                            response => {
                                if (response.data.success) {
                                    this.$notify({
                                        text: response.data.message,
                                        type: 'success',
                                        duration: 10000,
                                    })
                                    this.$modal.hide('bar')
                                    this.available_times = []
                                    this.show_modal_button = false

                                } else {
                                    this.$notify({
                                        text: response.data.message,
                                        type: 'warn'
                                    })

                                }
                            })
                        .catch(error => {
                            this.errorMessage = error.message;
                            console.log(error.response.data.message);
                            this.$notify({
                                text: error.response.data.message,
                                type: 'error'
                            })
                        });


                    return false

                }
            }
        })
    </script>
@endsection
