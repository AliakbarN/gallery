<div class="col-lg-2 col-md-3 col-12 menu_block">

    <!--logo -->
    <div class="logo_box">
        <a href="/">
            {{--                            <img src="assets/img/logo.png" alt="cocoon">--}}
            <h3 style="color: white"><i>GALLERY</i></h3>
        </a>
    </div>
    <!--logo end-->

    <!--main menu -->
    <div class="side_menu_section">
        <ul class="menu_nav">
            <li class="">
                <a href="{{ route('photos.index') }}">
                    Home
                </a>
            </li>
            <li class="">
                <a href="{{ route('photos.search.index') }}">
                    Search
                </a>
            </li>
            <li class="">
                <a href="{{ route('photos.create') }}">
                    Add new photos
                </a>
            </li>
        </ul>
    </div>
    <!--main menu end -->

    <!--social -->
    <div class="side_menu_bottom">
        <div class="side_menu_bottom_inner">
            <ul class="social_menu">
                <li>
                    <a href="#"> <i class="ion ion-social-pinterest"></i> </a>
                </li>
                <li>
                    <a href="#"> <i class="ion ion-social-facebook"></i> </a>
                </li>
                <li>
                    <a href="#"> <i class="ion ion-social-twitter"></i> </a>
                </li>
                <li>
                    <a href="#"> <i class="ion ion-social-dribbble"></i> </a>
                </li>
            </ul>
        </div>
    </div>
    <!--social end -->

</div>
