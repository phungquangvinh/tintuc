@extends('admin.layouts.index')
@section('title')
    Danh sách người dùng
@stop
@section('content')

<!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Users
                            <small>danh sách</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    @if(session('thongbao'))
                        <div class="alert alert-success">
                            {{ session('thongbao') }}
                        </div>
                    @endif
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>ID</th>
                                <th>Tên</th>
                                <th>Email</th>
                                <th>Quyền truy cập</th>
                                <th>Ngày tạo</th>
                                <th>Sửa info</th>
                                <th>Ban nick</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($user as $u)
                                <tr class="odd gradeX" align="center">
                                    <td> {{$u->id}} </td>
                                    <td> {{$u->name}} </td>
                                    <td> {{$u->email}} </td>
                                    <td>
                                        @if($u->quyen == 1)
                                            {{"Admin"}}
                                        @else {{"User"}}
                                        @endif
                                    </td>
                                    <td> {{$u->created_at}} </td>
                                    <td class="center"><i class="fa fa-trash-o fa-fw"></i><a href="admin/user/edit/{{$u->id}}"> Edit</a></td>
                                    <td class="center"><i class="fa fa-trash-o fa-fw"></i><a href="admin/user/delete/{{$u->id}}"> Delete</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
@endsection