@extends('backend.layouts.default')
@section('main-content')
<div class="login-page bk-img" style="background-image: url(img/login-bg.jpg);">
    <div class="form-content">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <h1 class="text-center text-bold text-light mt-4x">Sign in</h1>
                    <div class="well row pt-2x pb-3x bk-light">
                        <div class="col-md-8 col-md-offset-2">
                            <form action="{{route('login')}}" class="mt" method="post">

                                <label for="" class="text-uppercase text-sm">Your Username or Email</label>
                                <input type="text" name="name" placeholder="Username" class="form-control mb">

                                <label for="" class="text-uppercase text-sm">Password</label>
                                <input type="password" name="password" placeholder="Password" class="form-control mb">
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <div class="checkbox checkbox-circle checkbox-info">
                                    <input id="checkbox7" type="checkbox" checked name="remember">
                                    <label for="checkbox7">
                                        Keep me signed in
                                    </label>
                                </div>

                                <button class="btn btn-primary btn-block" type="submit">LOGIN</button>
                                @if($errors)
                                    @foreach($errors->all() as $error)
                                        <p class="text-danger">{{ $error }}</p>
                                    @endforeach
                                @endif
                            </form>
                        </div>
                    </div>
                    <div class="text-center text-light">
                        <a href="#" class="text-light">Forgot password?</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
