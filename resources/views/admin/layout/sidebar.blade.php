<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            <li class="nav-title">{{ trans('brackets/admin-ui::admin.sidebar.content') }}</li>
            @if (auth()->user()->hasRole('Administrator'))

            <li class="nav-item"><a class="nav-link" href="{{ url('admin/restaurant-tables') }}"><i class="nav-icon icon-umbrella"></i> {{ trans('admin.restaurant-table.title') }}</a></li>
            @endif
            <li class="nav-item"><a class="nav-link" href="{{ url('admin/restaurant-table-reservations') }}">
            <i class="nav-icon icon-magnet"></i> Reservations
            </a></li>
           <li class="nav-item"><a class="nav-link" href="{{ url('admin/make-reservation') }}">
            {{-- <i class="nav-icon icon-location-pin"></i>  --}}
            {{ __('Make Reservation') }}</a></li>
           {{-- Do not delete me :) I'm used for auto-generation menu items --}}

            <li class="nav-title">{{ trans('brackets/admin-ui::admin.sidebar.settings') }}</li>
            @if (auth()->user()->hasRole('Administrator'))
                
            <li class="nav-item"><a class="nav-link" href="{{ url('admin/admin-users') }}"><i class="nav-icon icon-user"></i> {{ __('Manage access') }}</a></li>
            @endif
            {{-- <li class="nav-item"><a class="nav-link" href="{{ url('admin/translations') }}"><i class="nav-icon icon-location-pin"></i> {{ __('Translations') }}</a></li> --}}
            {{-- Do not delete me :) I'm also used for auto-generation menu items --}}
            {{--<li class="nav-item"><a class="nav-link" href="{{ url('admin/configuration') }}"><i class="nav-icon icon-settings"></i> {{ __('Configuration') }}</a></li>--}}
        </ul>
    </nav>
    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>
