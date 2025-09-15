@extends('layouts.app')
@section('content')

    <!--================Breadcrumb Area =================-->
    <section class="breadcrumb_area">
        <div class="overlay bg-parallax" data-stellar-ratio="0.8" data-stellar-vertical-offset="0" data-background=""></div>
        <div class="container">
            <div class="page-cover text-center">
                <h2 class="page-cover-tittle">Student Success Stories</h2>
                <ol class="breadcrumb">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li class="active">Success Stories</li>
                </ol>
            </div>
        </div>
    </section>
    <!--================Breadcrumb Area =================-->
    
    <!--================ Success Statistics =================-->
    <section class="counter_area section_gap_bottom mt-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="single_counter text-center">
                        <h3><span class="counter">8</span></h3>
                        <p>Students Working in Japan</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="single_counter text-center">
                        <h3><span class="counter">4</span></h3>
                        <p>Different Industries</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="single_counter text-center">
                        <h3><span class="counter">100</span>%</h3>
                        <p>Job Placement Rate</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="single_counter text-center">
                        <h3><span class="counter">3</span></h3>
                        <p>Major Cities Covered</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================ Success Statistics =================-->
    
    <!--================ Success Stories Area  =================-->
    <section class="about_history_area section_gap">
        <div class="container">
            <div class="section_title text-center">
                <h2 class="title_color">Our Student Achievements</h2>
                <p>
                    Over the years, Tokyo Japanese School has proudly trained students who are now thriving in Japan.  
                    Till today, <strong>8 of our dedicated students</strong> have successfully completed their Japanese language 
                    education with us and secured prestigious positions in different companies across Japan.
                </p>
                <p class="mt-3">
                    <em>"Success is not just about learning a language; it's about opening doors to new opportunities 
                    and building bridges between cultures."</em>
                </p>
            </div>
            <div class="row">
                <div class="col-md-6 d_flex align-items-center">
                    <div class="about_content">
                        <h2 class="title title_color">Inspiring Journeys to Success</h2>
                        <div>
                            Our students come from diverse backgrounds, but they all share one common dream: 
                            to build their future in Japan. With unwavering dedication, expert guidance, and the 
                            continuous support of our experienced native and Pakistani teachers, they have 
                            transformed their dreams into reality. 
                        </div>
                        <div class="mt-4">
                            Today, they are making significant contributions in industries such as 
                            <strong>Information Technology, Hospitality Management, Mechanical Engineering, 
                            and International Education</strong>. Their remarkable success stories serve as 
                            both a source of immense pride and powerful motivation for our current and future students. 
                        </div>
                        <div class="mt-4">
                            <div class="d-flex align-items-center mb-2">
                                <i class="fa fa-check-circle text-success mr-2"></i>
                                <span>Personalized career guidance</span>
                            </div>
                            <div class="d-flex align-items-center mb-2">
                                <i class="fa fa-check-circle text-success mr-2"></i>
                                <span>Industry-specific Japanese training</span>
                            </div>
                            <div class="d-flex align-items-center mb-2">
                                <i class="fa fa-check-circle text-success mr-2"></i>
                                <span>Job placement assistance</span>
                            </div>
                        </div>
                        <a href="{{ url('/contact') }}" class="button_hover theme_btn_two mt-3">Start Your Success Journey</a>
                    </div>
                </div>
                <div class="col-md-6">
                    <img class="img-fluid rounded shadow img" src="{{ asset('assets/image/our-mission.jpg') }}" alt="Student Success">
                    <div class="mt-3 text-center">
                        <small class="text-muted">Our students celebrating their achievements in Japan</small>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================ Success Stories Area  =================-->

    <!--================ Individual Student Stories =================-->
   <section class="facilities_area section_gap">
        <div class="container">
            <div class="section_title text-center">
                <h2 class="title_w">Meet Our Successful Students</h2>
                <p>Here are some of the inspiring stories of students who are now working in Japan.</p>
            </div>
            <div class="row mb_30">
                <div class="col-lg-3 col-md-6">
                    <div class="facilities_item">
                        <h4 class="sec_h4"><i class="lnr lnr-user"></i> Ali Raza</h4>
                        <p>Now working as a Software Engineer in Tokyo after completing his Japanese Language Program.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="facilities_item">
                        <h4 class="sec_h4"><i class="lnr lnr-user"></i> Ayesha Khan</h4>
                        <p>Secured a position in a Japanese hospitality company, bridging cultural and service excellence.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="facilities_item">
                        <h4 class="sec_h4"><i class="lnr lnr-user"></i> Muhammad Bilal</h4>
                        <p>Currently employed in an engineering firm in Osaka, contributing to global projects.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="facilities_item">
                        <h4 class="sec_h4"><i class="lnr lnr-user"></i> Sana Ahmed</h4>
                        <p>Teaching English and supporting Japanese students while experiencing a rich cultural exchange.</p>
                    </div>
                </div>
            </div>
            <div class="row mb_30">
                <div class="col-lg-3 col-md-6">
                    <div class="facilities_item">
                        <h4 class="sec_h4"><i class="lnr lnr-user"></i> Imran Khan</h4>
                        <p>Working in a Japanese automotive company after mastering technical Japanese terms.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="facilities_item">
                        <h4 class="sec_h4"><i class="lnr lnr-user"></i> Hina Fatima</h4>
                        <p>Part of a marketing team in Tokyo, connecting Japanese products to international markets.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="facilities_item">
                        <h4 class="sec_h4"><i class="lnr lnr-user"></i> Ahmed Ali</h4>
                        <p>Contributing to research and development in an electronics firm in Japan.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="facilities_item">
                        <h4 class="sec_h4"><i class="lnr lnr-user"></i> Maria Khan</h4>
                        <p>Working in the education sector in Tokyo, assisting Japanese students in learning English.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================ Individual Student Stories =================-->

    <!--================ Student Testimonials =================-->
    <section class="testimonial_area section_gap">
        <div class="container">
            <div class="section_title text-center">
                <h2 class="title_color">What Our Alumni Say</h2>
                <p>Hear directly from our successful graduates about their journey</p>
            </div>
            <div class="testimonial_slider owl-carousel">
                <div class="media testimonial_item">
                    <img class="rounded-circle" src="{{ asset('assets/image/testtimonial-1.jpg') }}" alt="Student">
                    <div class="media-body">
                        <p>Tokyo Japanese School helped me pass JLPT N3 in just 8 months. The instructors are amazing and
                            the hostel facilities made my learning journey comfortable and focused.</p>
                        <a href="#">
                            <h4 class="sec_h4">Ahmad Ali</h4>
                        </a>
                    
                    </div>
                </div>
                <div class="media testimonial_item">
                    <img class="rounded-circle" src="{{ asset('assets/image/testtimonial-1.jpg') }}" alt="Student">
                    <div class="media-body">
                        <p>The best decision I made was joining Tokyo Japanese School. From N5 to N2, the systematic
                            approach and cultural classes prepared me well for living in Japan.</p>
                        <a href="#">
                            <h4 class="sec_h4">Fatima Khan</h4>
                        </a>
                    
                    </div>
                </div>
                <div class="media testimonial_item">
                    <img class="rounded-circle" src="{{ asset('assets/image/testtimonial-1.jpg') }}" alt="Student">
                    <div class="media-body">
                        <p>Excellent teaching methods and supportive environment. I'm now working in Japan thanks to the
                            solid foundation I got from Tokyo Japanese School.</p>
                        <a href="#">
                            <h4 class="sec_h4">Muhammad Hassan</h4>
                        </a>
                    
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--================ Call to Action =================-->

    <style>
        .facilities_item {
    /* background: #fff; */
    /* border: 1px solid #eee; */
    border-radius: 8px;
    padding: 20px;
    margin-bottom: 30px;
    height: 100%; /* sab cards equal height le lenge */
    box-shadow: 0 2px 6px rgba(0,0,0,0.1);
}

.facilities_item h4 {
    margin-bottom: 10px;
}

.row.mb_30 {
    margin-bottom: 30px;
}

.col-lg-3.col-md-6 {
    margin-bottom: 30px; /* columns k beech spacing */
}

        .img{
            height: 400px;
            width: auto;
            object-fit: cover;
        }
    .success_story_card {
        height: 100%;
        padding: 25px;
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        transition: transform 0.3s ease;
        background: white;
    }
    
    .success_story_card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.15);
    }
    
    .student_avatar {
        text-align: center;
    }
    
    .student_avatar i {
        font-size: 2.5rem;
        color: #007bff;
        background: #f8f9fa;
        padding: 15px;
        border-radius: 50%;
    }
    
    .student_details .role {
        font-weight: bold;
        color: #007bff;
        margin-bottom: 5px;
    }
    
    .student_details .company {
        color: #6c757d;
        font-style: italic;
        margin-bottom: 10px;
    }
    
    .achievement_badge {
        margin-top: 10px;
        text-align: center;
    }
    
    .single_counter {
        padding: 30px;
        background: white;
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        margin-bottom: 30px;
    }
    
    .single_counter h3 {
        font-size: 2.5rem;
        font-weight: bold;
        color: #007bff;
        margin-bottom: 10px;
    }
    
    .testimonial_item {
        background: white;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        height: 100%;
    }
    
    .testimonial_content {
        margin-bottom: 20px;
    }
    
    .testimonial_author h5 {
        margin-bottom: 5px;
        color: #007bff;
    }
    
    .cta_area {
        background: linear-gradient(135deg, #007bff, #0056b3);
        color: white;
        padding: 60px 0;
    }
    
    .theme_btn_outline {
        border: 2px solid white;
        color: white;
        background: transparent;
        padding: 12px 30px;
        border-radius: 5px;
        text-decoration: none;
        transition: all 0.3s ease;
    }
    
    .theme_btn_outline:hover {
        background: white;
        color: #007bff;
        text-decoration: none;
    }
    </style>

@endsection