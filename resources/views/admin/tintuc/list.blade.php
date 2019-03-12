@extends('admin.layouts.index')
@section('title')
    Quản lý tin tức
@stop
@section('content')

<!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Tin Tức
                            <small>Danh sách</small>
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
                                <th>Tiêu đề</th>
                                <th>Tiêu đề không dấu</th>
                                <th>Loại tin</th>
                                <th>Tóm tắt</th>
                                <th>Nội dung</th>
                                <th>Nổi bật</th>
                                <th>Số lượt xem</th>
                                <th>Delete</th>
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tintuc as $tt)
                                <tr class="odd gradeX" align="center">
                                    <td> {{$tt->id}} </td>
                                    <td>{{$tt->TieuDe}}</td>
                                    <td> {{$tt->TieuDeKhongDau}}<br><img src="upload/tintuc/{{$tt->Hinh}}" style="width: 200px"> </td>
                                    <td> {{$tt->loaitin->theloai->Ten}} </td>
                                    <td> {{$tt->TomTat}} </td>
                                    <td> {{$tt->NoiDung}} </td>
                                    <td> {{$tt->NoiBat}} </td>
                                    <td> {{$tt->SoLuotXem}} </td>
                                    <td class="center"><i class="fa fa-trash-o fa-fw"></i><a href="admin/tin-tuc/delete/{{$tt->id}}"> Delete</a></td>
                                    <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/tin-tuc/edit/{{$tt->id}}">Edit</a></td>
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