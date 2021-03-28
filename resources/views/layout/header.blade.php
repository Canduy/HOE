 <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="trang-chu"><img src="./image/logo.png"></a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <!-- <li>
                        <a href="#">Giới thiệu</a>
                    </li> -->
                    <li>
                        <a href="lien-he">Liên hệ</a>
                    </li>
                </ul>

                <form action="timkiem" method="POST" class="navbar-form navbar-left" role="search">
                     <input type="hidden" name="_token" value="{{csrf_token()}}" >
			        <div class="form-group">
			          <input type="text" name="tukhoa" class="form-control" placeholder="Tìm kiếm">
			        </div>
			        <button type="submit" class="btn btn-default">Search</button>
			    </form>

			    <ul class="nav navbar-nav pull-right">
                    <li>
                        <span style="line-height: 50px">Địa chỉ:</span>
                    </li>
                    <li>
                        <span style="line-height: 50px" >Tầng7, Số 42, Tần Vỹ, Mai Dịch, Cầu Giấy, Hà Nội</span>
                    </li>
                  
                    
                </ul>
            </div>


            
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
    <marquee onmouseover="this.stop();" onmouseout="this.start();" behavior="scroll" direction="left" scrollamount="3">Chào mừng bạn đến website của Chương trình Trái Tim Quả Địa Cầu</marquee>