@extends('adminlte::layouts.auth')

@section('htmlheader_title')
    Register
@endsection

@section('content')

<body class="hold-transition register-page">
    <div id="app" v-cloak>
        <div class="register-box">
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> {{ trans('adminlte_lang::message.someproblems') }}<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="register-box-body">
                <p class="login-box-msg">New Officer</p>

                <!-- <register-form></register-form> -->
                <form action="{{route('users.store')}}" method="post">
                  {{ csrf_field() }}
                  <div class="form-group has-feedback">
                    <input name="name" type="text" class="form-control" placeholder="Name">
                  </div>
                  <div class="form-group has-feedback">
                    <input name="email" type="email" class="form-control" placeholder="Email">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                  </div>
                  <div class="form-group has-feedback">
                    <input name="phone" type="text" class="form-control" placeholder="Phone">
                    <span class="glyphicon glyphicon-phone form-control-feedback"></span>
                  </div>
                  <div class="form-group has-feedback">
                    <input name="title" type="text" class="form-control" placeholder="Title">
                  </div>
                   <div class="form-group has-feedback">
                      <select class="form-control" id="province" name="type" placeholder="Province">
                        <option value="1">Admin</option>
{{--                         @foreach($provinces as $province) --}}
                        <option value="2">Normal</option>
{{--                         @endforeach --}}
                      </select>
                    </div>
                  <div class="form-group has-feedback">
                      <select class="form-control" id="province" name="province" placeholder="Province">
                        <option value="">Select Province</option>
{{--                         @foreach($provinces as $province) --}}
                        <option value="1">West</option>
{{--                         @endforeach --}}
                      </select>
                    </div>
                     <div class="form-group has-feedback">
                      <select class="form-control" id="district" name="district" placeholder="District">
                        <option value="">Select District</option>
{{--                         @foreach($provinces as $province) --}}
                        <option value="1">Rubavu</option>
{{--                         @endforeach --}}
                      </select>
                    </div>
                      <div class="form-group has-feedback">
                      <select class="form-control" id="station" name="station" placeholder="Police Station">
                        <option value="">Select Police Station</option>
{{--                         @foreach($provinces as $province) --}}
                        <option value="1">Kanama</option>
{{--                         @endforeach --}}
                      </select>
                    </div> 
                  <div class="form-group has-feedback">
                    <input name="password" type="password" class="form-control" placeholder="Password">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                  </div>
                  <div class="form-group has-feedback">
                    <input  type="password" class="form-control" placeholder="Retype password">
                    <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
                  </div>
                  <div class="row">
                    <div class="col-xs-7 text-center">
                          <div class="checkbox icheck">
                            <label>
                              <input checked name="terms" type="checkbox" id="termsCheck"> I agree to the <a href="#" data-toggle="modal" data-target="#termsModal">terms</a>
                            </label>
                          </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-xs-4">
                      <button type="submit" class="btn btn-primary btn-block btn-flat" id="btnRegister">Register</button>
                    </div>
                    <!-- /.col -->
                  </div>
                </form>

                <a href="{{ url('/login') }}" class="text-center">{{ trans('adminlte_lang::message.membreship') }}</a>
            </div><!-- /.form-box -->
        </div><!-- /.register-box -->
    </div>

    @include('adminlte::layouts.partials.scripts_auth')

    @include('adminlte::auth.terms')
    <script type="text/javascript">
        $('#termsCheck').change(function(){
            $('#btnRegister').prop('disabled', !this.checked);
        });
    </script>
</body>

@endsection
