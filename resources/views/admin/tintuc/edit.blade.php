@extends('admin.layouts.index')
@section('title')
    Sửa bài viết
@stop
@section('content')

<!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Tin tức
                            <small>{{$tintuc->TieuDe}}</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7" style="padding-bottom:120px">
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
                        <form action="admin/tin-tuc/edit/{{$tintuc->id}}" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{csrf_token()}}" />

                            <div class="form-group">
                                <label>Chọn thể loại</label>
                                <select class="form-control" name="ChonTheLoai" id="ChonTheLoai">
                                @foreach($theloai as $tl)
                                    <option 
                                    @if($tintuc->loaitin->theloai->id == $tl->id)
                                        {{"selected"}}
                                    @endif
                                    value="{{$tl->id}}">{{$tl->Ten}}</option>
                                @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Chọn loại tin</label>
                                <select class="form-control" name="ChonLoaiTin" id="ChonLoaiTin">
                                @foreach($loaitin as $lt)
                                    <option
                                    @if($tintuc->loaitin->id == $lt->id)
                                        {{"selected"}}
                                    @endif
                                    value="{{$lt->id}}">{{$lt->Ten}}</option>
                                @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Tiêu Đề</label>
                                <input class="form-control" name="title" placeholder="Nhập tiêu đề" value="{{$tintuc->TieuDe}}" />
                            </div>
                            
                            <div class="form-group">
                                <label>Tóm tắt</label>
                                <textarea id="demo" class="form-control ckeditor" name="tomtat" rows="3">
                                    {{$tintuc->TomTat}}
                                </textarea>
                            </div>

                            <div class="form-group">
                                <label>Nội dung</label>
                                <textarea id="demo" class="form-control ckeditor" name="noidung">
                                    {{$tintuc->NoiDung}}
                                </textarea>
                            </div>

                            <div class="form-group">
                                <label>Chỉnh sửa hình ảnh</label>
                                <img width="200px" src="upload/tintuc/{{$tintuc->Hinh}}"><br>
                                <input type="file" name="image" class="form-control" />
                            </div>

                            <div class="form-group">
                                <label>Chọn tin nổi bật</label><br>
                                <label class="radio-inline">
                                    <input name="noibat" value="1" 
                                    @if($tintuc->NoiBat == 1)
                                        {{"checked"}}
                                    @endif
                                    type="radio">Nổi bật
                                </label>
                                <label class="radio-inline">
                                    <input name="noibat" value="0"
                                    @if($tintuc->NoiBat == 0)
                                        {{"checked"}}
                                    @endif
                                    type="radio">Không nổi bật
                                </label>
                            </div>
                            <button type="submit" class="btn btn-default">Sửa tin</button>
                            <button type="reset" class="btn btn-default">Reset</button>
                        <form>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Tin Tức
                            <small>Danh sách</small>
                        </h1>
                    </div>

                    <!-- /.col-lg-12 -->                    
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>ID</th>
                                <th>Người dùng</th>
                                <th>Nội dung</th>
                                <th>Ngày đăng</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tintuc->comment as $cm)
                                <tr class="odd gradeX" align="center">
                                    <td> {{$cm->id}} </td>
                                    <td>{{$cm->user->name}}</td>
                                    <td> {{$cm->NoiDung}} </td>
                                    <td> {{$cm->create_at}} </td>
                                    <td class="center"><i class="fa fa-trash-o fa-fw"></i><a href="admin/comment/delete/{{$cm->id}}/{{$tintuc->id}}"> Delete</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready(function() {
            $("#ChonTheLoai").change(function() {
                var idTheLoai = $(this).val();
                $.get("admin/ajax/loai-tin/"+idTheLoai, function(data) {
                    $("#ChonLoaiTin").html(data);
                })
            })
        });
    </script>
@endsection