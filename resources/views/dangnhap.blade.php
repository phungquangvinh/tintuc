@extends('layouts.app')
@section('title', 'Đăng nhập')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="login-panel panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Đăng nhập</h3>
                </div>
                <div class="panel-body">
                	@if(count($errors)>0)
					    <div class="alert alert-danger">
					        @foreach($errors->all() as $err)
					            {{ $err }}<br />
					        @endforeach
					    </div>
					@endif

					@if(session('thongbao'))
					    <div class="alert alert-success">
					        {{ session('thongbao') }}
					    </div>
					@endif
                    <form role="form" action="dangnhap" method="POST">
                    	@csrf
                        <fieldset>
                            <div class="form-group">
                                <input class="form-control" placeholder="E-mail" name="email" type="email" required autofocus />
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="Password" name="password" type="password" value="" required />
                            </div>
                            <button type="submit" class="btn btn-lg btn-success btn-block">Login</button>
                            <p>Bạn chưa có tài khoản? <a href="{{ route('dangki') }}">Đăng kí ngay</a></p>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
