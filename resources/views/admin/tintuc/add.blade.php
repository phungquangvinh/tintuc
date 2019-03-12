@extends('admin.layouts.index')
@section('title')
    Thêm bài viết
@stop
@section('content')

<!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Tin tức
                            <small>thêm</small>
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
                        <form action="admin/tin-tuc/add" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{csrf_token()}}" />

                            <div class="form-group">
                                <label>Chọn thể loại</label>
                                <select class="form-control" name="ChonTheLoai" id="ChonTheLoai">
                                @foreach($theloai as $tl)
                                    <option value="{{$tl->id}}">{{$tl->Ten}}</option>
                                @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Chọn loại tin</label>
                                <select class="form-control" name="ChonLoaiTin" id="ChonLoaiTin">
                                @foreach($loaitin as $lt)
                                    <option value="{{$lt->id}}">{{$lt->Ten}}</option>
                                @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Tiêu Đề</label>
                                <input class="form-control" name="title" placeholder="Nhập tiêu đề" />
                            </div>
                            
                            <div class="form-group">
                                <label>Tóm tắt</label>
                                <textarea id="demo" class="form-control ckeditor" name="tomtat" rows="3"></textarea>
                            </div>

                            <div class="form-group">
                                <label>Nội dung</label>
                                <textarea id="demo" class="form-control ckeditor" name="noidung"></textarea>
                            </div>

                            <div class="form-group">
                                <label>Hình ảnh</label>
                                <input type="file" name="image" class="form-control" />
                            </div>

                            <div class="form-group">
                                <label>Chọn tin nổi bật</label><br>
                                <label class="radio-inline">
                                    <input name="noibat" value="1" checked="" type="radio">Nổi bật
                                </label>
                                <label class="radio-inline">
                                    <input name="noibat" value="0" type="radio">Không nổi bật
                                </label>
                            </div>
                            <button type="submit" class="btn btn-default">Đăng tin</button>
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