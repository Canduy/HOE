 @extends('layout.index')

@section('content')
 <!-- Page Content -->
    <div class="container">

    	<!-- slider -->
        @include('layout.slide')
        <!-- end slide -->

        <div class="space20"></div>


        <div class="row main-left">
            @include('layout.menu')

            <div class="col-md-9">
	            <div class="panel panel-default">            
	            	<div class="panel-heading" style="background-color:#337AB7; color:white;" >
	            		<h2 style="margin-top:0px; margin-bottom:0px;">Liên hệ</h2>
	            	</div>

	            	<div class="panel-body">
	            		<!-- item -->
                        <h3><span class="glyphicon glyphicon-align-left"></span> Thông tin liên hệ</h3>
					    
                        <div class="break"></div>
					   	<h4><span class= "glyphicon glyphicon-home "></span> Địa chỉ : </h4>
                        <p>Tầng7, Số 42, Tần Vỹ, Mai Dịch, Cầu Giấy, Hà Nội </p>

                        <h4><span class="glyphicon glyphicon-envelope"></span> Email : </h4>
                        <p>bantruyenthong.hoe@gmail.com</p>



                        <br><br>
                        <h3><span class="glyphicon glyphicon-globe"></span> Bản đồ</h3>
                        <div class="break"></div><br>
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3723.821977173193!2d105.77062531488356!3d21.03980798599239!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x313454c8494ae523%3A0x544841a217c8bc1b!2zNDIgVHLhuqduIFbhu7ksIE1haSBE4buLY2gsIEPhuqd1IEdp4bqleSwgSMOgIE7hu5lpLCBWaeG7h3QgTmFt!5e0!3m2!1svi!2s!4v1615904115653!5m2!1svi!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>

					</div>
	            </div>
        	</div>
        </div>
        <!-- /.row -->
    </div>
    <!-- end Page Content -->
@endsection    