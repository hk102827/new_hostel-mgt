@extends('layouts.app')
@section('content')
<!--================Breadcrumb Area =================-->
<section class="breadcrumb_area">
    <div class="overlay bg-parallax" data-stellar-ratio="0.8" data-stellar-vertical-offset="0" data-background=""></div>
    <div class="container">
        <div class="page-cover text-center">
            <h2 class="page-cover-tittle">About Us</h2>
            <ol class="breadcrumb">
                <li><a href="{{ url('/') }}">Home</a></li>
                <li class="active">About</li>
            </ol>
        </div>
    </div>
</section>
<!--================Breadcrumb Area =================-->

<!--================ About History Area  =================-->
<section class="about_history_area section_gap">
    <div class="container">
        <div class="row">
            <div class="col-md-6 d_flex align-items-center">
                <div class="about_content ">
                    <h2 class="title title_color">About Tokyo Japanese School <br>Mission & Vision</h2>
                    <div>
                        Tokyo Japanese School was established with the vision of providing high-quality Japanese language education 
                        and cultural understanding to students from all around the world. Over the years, we have grown into one 
                        of the most reputable institutions, offering modern teaching methods, interactive learning environments, 
                        and a supportive community for our students.
                    </div>
                    <div class="mt-4">
                        <b><strong>Our Mission:</strong></b> To equip students with strong Japanese language skills and prepare them for 
                        academic and professional success in Japan.  
                        <br>
                        <strong>Our Vision:</strong> To be recognized globally as a center of excellence for Japanese language and 
                        cultural studies while nurturing discipline, respect, and lifelong learning among our students.
                    </div>
                    <a href="{{ url('/contact') }}" class="button_hover theme_btn_two mt-3">Request Information</a>
                </div>
            </div>
            <div class="col-md-6">
                <img class="img-fluid img" src="{{ asset('assets/image/class1.jpg') }}" alt="Tokyo Japanese School">
            </div>
        </div>
    </div>
</section>
<!--================ About History Area  =================-->

<!--================ Facilities Area  =================-->
<section class="facilities_area section_gap mb-4">
    <div class="overlay bg-parallax" data-stellar-ratio="0.8" data-stellar-vertical-offset="0" data-background="">  
    </div>
    <div class="container">
        <div class="section_title text-center">
            <h2 class="title_w">Our Facilities</h2>
            <p>We provide world-class facilities to ensure our students enjoy a comfortable and productive learning journey.</p>
        </div>
        <div class="row mb_30">
            <div class="col-lg-4 col-md-6">
                <div class="facilities_item">
                    <h4 class="sec_h4"><i class="lnr lnr-home"></i>Hostel Accommodation</h4>
                    <p>Safe and modern hostel facilities with 24/7 support, nutritious meals, and a friendly environment for international students.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="facilities_item">
                    <h4 class="sec_h4"><i class="lnr lnr-dinner"></i>Cafeteria</h4>
                    <p>Healthy and delicious Japanese as well as international cuisines are served to meet the needs of our diverse student community.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="facilities_item">
                    <h4 class="sec_h4"><i class="lnr lnr-bicycle"></i>Sports Club</h4>
                    <p>Indoor and outdoor sports activities to keep students active, balanced, and refreshed alongside their studies.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="facilities_item">
                    <h4 class="sec_h4"><i class="lnr lnr-book"></i>Library & Study Rooms</h4>
                    <p>A well-stocked library and quiet study areas to support research, self-study, and group discussions.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="facilities_item">
                    <h4 class="sec_h4"><i class="lnr lnr-graduation-hat"></i>Modern Classrooms</h4>
                    <p>Smart classrooms equipped with modern learning tools and interactive teaching methods.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="facilities_item">
                    <h4 class="sec_h4"><i class="lnr lnr-heart"></i>Student Support</h4>
                    <p>Personal counseling, academic guidance, and career support to help students achieve their goals in Japan.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .img {
       height: 60vh;
       width: auto;
       /* object-fit: cover; */
    }
</style>
@endsection
