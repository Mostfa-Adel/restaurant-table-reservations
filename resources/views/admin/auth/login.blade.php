@extends('brackets/admin-ui::admin.layout.master')

@section('title', trans('admin.login.title'))

@section('content')
	<div class="container" id="app">
	    <div class="row align-items-center justify-content-center auth">
	        <div class="col-md-6 col-lg-5">
				<div class="card">
					<div class="card-block">
						<auth-form
								:action="'{{ url('/admin/login') }}'"
								:data="{}"
								inline-template>
							<form class="form-horizontal" role="form" method="POST" action="{{ url('/admin/login') }}" novalidate>
								{{ csrf_field() }}
								<div class="auth-header">
									<h1 class="auth-title">{{ trans('admin.login.title') }}</h1>
									<p class="auth-subtitle">{{ trans('admin.login.sign_in_text') }}</p>
								</div>
								<div class="auth-body">
									@include('admin.auth.includes.messages')
									<div class="form-group" :class="{'has-danger': errors.has('employee_number'), 'has-success': fields.employee_number && fields.employee_number.valid }">
										<label for="employee_number">{{ trans('admin.auth_global.employee_number') }}</label>
										<div class="input-group input-group--custom">
											<div class="input-group-addon"><i class="input-icon input-icon--mail"></i></div>
											<input type="text" v-model="form.employee_number" v-validate="'required'" class="form-control" :class="{'form-control-danger': errors.has('employee_number'), 'form-control-success': fields.employee_number && fields.employee_number.valid}" id="employee_number" name="employee_number" placeholder="{{ trans('admin.auth_global.employee_number') }}">
										</div>
										<div v-if="errors.has('employee_number')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('employee_number') }}</div>
									</div>

									<div class="form-group" :class="{'has-danger': errors.has('password'), 'has-success': fields.password && fields.password.valid }">
										<label for="password">{{ trans('admin.auth_global.password') }}</label>
										<div class="input-group input-group--custom">
											<div class="input-group-addon"><i class="input-icon input-icon--lock"></i></div>
											<input type="password" v-model="form.password"  class="form-control" :class="{'form-control-danger': errors.has('password'), 'form-control-success': fields.password && fields.password.valid}" id="password" name="password" placeholder="{{ trans('admin.auth_global.password') }}">
										</div>
										<div v-if="errors.has('password')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('password') }}</div>
									</div>

									<div class="form-group">
										<input type="hidden" name="remember" value="1">
										<button type="submit" class="btn btn-primary btn-block btn-spinner"><i class="fa"></i> {{ trans('admin.login.button') }}</button>
									</div>
									<div class="form-group text-center">
										<a href="{{ url('/admin/password-reset') }}" class="auth-ghost-link">{{ trans('admin.login.forgot_password') }}</a>
									</div>
								</div>
							</form>
						</auth-form>
					</div>
				</div>
	        </div>
	    </div>
	</div>
   
@endsection


@section('bottom-scripts')
<script type="text/javascript">
    // fix chrome password autofill
    // https://github.com/vuejs/vue/issues/1331
    document.getElementById('password').dispatchEvent(new Event('input'));
</script>
@endsection