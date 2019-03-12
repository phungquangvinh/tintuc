@extends('layouts.index')
@section('title', 'HOME')

@section('content')

<!-- Page Content -->
<div class="container">

	@include('layouts.slide')

    <div class="space20"></div>


    <div class="row main-left">
        @include('layouts.menu')

        <div class="col-md-9">
            <div class="panel panel-default">            
            	<div class="panel-heading" style="background-color:#337AB7; color:white;" >
            		<h2 style="margin-top:0px; margin-bottom:0px;">Laravel Tin Tức</h2>
            	</div>

            	<div class="panel-body">
            		@foreach($theloai as $tl)
	            		<!-- item -->
					    <div class="row-item row">
		                	<h3>
		                		<a href="#">{{$tl->Ten}}</a> | 	
		                		@foreach($tl->loaitin as $lt)
		                			<small><a href="category/{{$lt->id}}/{{$lt->TenKhongDau}}.html"><i>{{$lt->Ten}}</i></a>/</small>
		                		@endforeach
		                	</h3>
		                	<?php $data = $tl->tintuc->where('NoiBat',1)->sortByDesc('created_at')->take(5);
		                	$tin = $data->shift(); ?>
		                	<div class="col-md-8 border-right">
		                		<div class="col-md-5">
			                        <a href="tintuc/{{$tin['id']}}/{{$tin['TieuDeKhongDau']}}.html">
			                            <img class="img-responsive" src="upload/tintuc/{{$tin['Hinh']}}" alt="">
			                        </a>
			                    </div>

			                    <div class="col-md-7">
			                        <h3>{{$tin['TieuDe']}}</h3>
			                        <p>{{$tin['TomTat']}}</p>
			                        <a class="btn btn-primary" href="tintuc/{{$tin['id']}}/{{$tin['TieuDeKhongDau']}}.html">Xem Tin<span class="glyphicon glyphicon-chevron-right"></span></a>
								</div>
		                	</div>		                    

							<div class="col-md-4">
							@foreach($data->all() as $tintuc)
								<a href="tintuc/{{$tintuc['id']}}/{{$tintuc['TieuDeKhongDau']}}.html">
									<h4>
										<span class="glyphicon glyphicon-list-alt"></span>
										{{$tintuc['TieuDe']}}
									</h4>
								</a>
							@endforeach
							</div>
							
							<div class="break"></div>
		                </div>
		                <!-- end item -->
	                @endforeach
				</div>
            </div>
    	</div>
    </div>
    <!-- /.row -->
</div>
<!-- end Page Content -->
@endsection