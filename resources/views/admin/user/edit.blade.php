@extends('admin.layouts.index')
@section('title')
    Sửa thông tin người dùng
@stop
@section('content')

<!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Người dùng
                            <small> {{$user->Ten}} </small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7" style="padding-bottom:120px">
                        @if(count($errors)>0))
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
                        <form action="admin/user/edit/{{$user->id}}" method="POST">
                            @csrf

                            <div class="form-group">
                                <label>Tên người dùng</label>
                                <input class="form-control" name="Ten" placeholder="Điền tên vào..." value="{{$user->name}}" />
                            </div>

                            <div class="form-group">
                                <label>Email</label>
                                <input class="form-control" name="email" type="email" value="{{$user->email}}" readonly="" />
                            </div>

                            <div class="form-group">
                                <label>Cấp quyền</label>
                                <label class="radio-inline">
                                    <input name="quyen" value="1" 
                                    @if($user->quyen == 1)
                                        {{"checked"}}
                                    @endif
                                    type="radio">Admin
                                </label>
                                <label class="radio-inline">
                                    <input name="quyen" value="0" 
                                    @if($user->quyen == 0)
                                        {{"checked"}}
                                    @endif
                                    type="radio">User
                                </label>
                            </div>

                            <button type="submit" class="btn btn-default">Thực hiện</button>
                            <button type="reset" class="btn btn-default">Reset</button>
                        <form>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
@endsection