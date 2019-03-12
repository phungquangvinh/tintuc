@extends('admin.layouts.index')
@section('title')
    Danh sách loại tin
@stop
@section('content')

<!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Loại Tin
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
                                <th>ID thể loại</th>
                                <th>Tên loại tin</th>
                                <th>Tên đường truyền</th>
                                <th>Delete</th>
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($loaitin as $lt)
                                <tr class="odd gradeX" align="center">
                                    <td> {{$lt->id}} </td>
                                    <td> {{$lt->idTheLoai}} </td>
                                    <td> {{$lt->Ten}} </td>
                                    <td> {{$lt->TenKhongDau}} </td>
                                    <td class="center"><i class="fa fa-trash-o fa-fw"></i><a href="admin/loai-tin/delete/{{$lt->id}}"> Delete</a></td>
                                    <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/loai-tin/edit/{{$lt->id}}">Edit</a></td>
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