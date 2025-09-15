@extends('layouts.app')
@section('content')
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">


    <style>
        .social_links a {
            display: inline-block;
            width: 30px;
            height: 30px;
            line-height: 30px;
            border-radius: 50%;
            transition: all 0.3s ease;
            font-size: 14px;
        }

        .social_links a:hover {
            transform: scale(1.2);
            color: white !important;
        }

        .social_links a.text-primary:hover {
            background-color: #3b5998;
        }

        .social_links a.text-info:hover {
            background-color: #1da1f2;
        }

        .social_links a.text-danger:hover {
            background-color: #e1306c;
        }

        .social_links a.text-success:hover {
            background-color: #25d366;
        }

        @media (max-width: 768px) {
            .col-lg-3.col-sm-6 {
                margin-bottom: 20px;
            }
        }

        .col-lg-2-4 {
            flex: 0 0 20%;
            max-width: 20%;
        }

        .custom-list {
            list-style: none;
            /* padding: 0; */
            margin: 0 auto;
            display: table;
            /* UL ko center align kar dega */
        }

        .custom-list li {
            position: relative;
            padding-left: 25px;
            /* tick ke liye space */
            margin-bottom: 10px;
            text-align: left;
            /* text straight ho */
        }

        .section_gap {
            padding: 80px 0;
        }

        .title_color {
            color: #2c3e50;
        }

        .team-swiper {
            padding: 70px 100px;
            overflow: hidden;

        }

        .team_item {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            transform: scale(0.9);
            /* opacity: 0.7; */
        }

        /* Center slide styling */
        /* Active card ke background + icons */
        .swiper-slide-active .team_item {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #fff;
        }

        /* Jab card active ho to icons bhi white ho jaye */
        .swiper-slide-active .team_item .social_links a {
            color: #fff !important;
            background-color: rgba(255, 255, 255, 0.2);
            /* halka transparent bg */
        }

        /* Active card ke hover effect */
        .swiper-slide-active .team_item .social_links a:hover {
            background-color: #fff !important;
            color: #764ba2 !important;
            /* contrast hover */
        }

        .swiper-slide-active .title_color {
            color: white !important;
        }

        .swiper-slide-active .text-muted {
            color: rgba(255, 255, 255, 0.8) !important;
        }

        /* Adjacent slides */
        .swiper-slide-prev .team_item,
        .swiper-slide-next .team_item {
            transform: scale(0.95);
            /* opacity: 0.8; */
        }

        .team_img {
            position: relative;
            overflow: visible;
        }

        .team_img img {
            transition: all 0.4s ease;
        }

        .swiper-slide-active .team_img img {
            transform: scale(1.1);
            border: 3px solid rgba(255, 255, 255, 0.3);
        }

        /* Custom navigation */
        .swiper-button-next,
        .swiper-button-prev {
            width: 40px;
            height: 40px;
            margin-top: -25px;
            background: rgba(162, 177, 241, 0.9);
            border-radius: 50%;
            color: white;
            transition: all 0.3s ease;

        }

        .swiper-button-next:after,
        .swiper-button-prev:after {
            font-size: 16px;
            font-weight: bold;
        }

        .swiper-button-next:hover,
        .swiper-button-prev:hover {
            background: rgba(102, 126, 234, 1);
            transform: scale(1.1);
        }

        /* Custom pagination */
        .swiper-pagination-bullet {
            width: 12px;
            height: 12px;
            background: rgba(102, 126, 234, 0.3);
            border-radius: 50%;
            transition: all 0.3s ease;
        }

        .swiper-pagination-bullet-active {
            background: #667eea;
            transform: scale(1.3);
        }

        .social_links a {
            transition: all 0.3s ease;
            display: inline-block;
        }

        .social_links a:hover {
            transform: translateY(-3px) scale(1.2);
        }

        /* Dancing animation for center slide */
        @keyframes dance {

            0%,
            100% {
                transform: scale(1.1) rotateY(0deg);
            }

            25% {
                transform: scale(1.12) rotateY(2deg);
            }

            50% {
                transform: scale(1.1) rotateY(0deg);
            }

            75% {
                transform: scale(1.12) rotateY(-2deg);
            }
        }

        .swiper-slide-active .team_item {
            animation: dance 3s ease-in-out infinite;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .team-swiper {
                padding: 30px 0;
            }

            .swiper-slide-active .team_item {
                transform: scale(1.05);
            }

            .swiper-button-next,
            .swiper-button-prev {
                width: 40px;
                height: 40px;
                margin-top: -20px;
            }

            .swiper-button-next:after,
            .swiper-button-prev:after {
                font-size: 14px;
            }
        }

        @media (max-width: 576px) {
            .team_item {
                margin: 0 10px;
            }

            .swiper-slide-active .team_item {
                transform: scale(1.02);
            }
        }

        /* Smooth entrance animation */
        .team_item {
            animation: fadeInUp 0.8s ease-out;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px) scale(0.8);
            }

            to {
                opacity: 0.7;
                transform: translateY(0) scale(0.9);
            }
        }
          .img {
       height: 60vh;
       width: auto;
       /* object-fit: cover; */


       /* Apply model */
       
    }
    </style>

    <!--================Banner Area =================-->
    <section class="banner_area">
        <div class="booking_table d_flex align-items-center">
            <div class="overlay bg-parallax" data-stellar-ratio="0.9" data-stellar-vertical-offset="0" data-background=""></div>
            <div class="container">
                <div class="banner_content text-center">
                    <h6>Learn Japanese Language & Culture</h6>
                    <h2>Tokyo Japanese School</h2>
                    <p>Master Japanese language with professional JLPT preparation courses<br> and comfortable hostel
                        accommodation for students.</p>
                    <a href="#japanese-academy" class="btn theme_btn button_hover">Explore Programs</a>
                </div>
            </div>
        </div>
    </section>
    <!--================Banner Area =================-->

    <section class="section_gap">
        <div class="container">
            <div class="section_title text-center mb-5">
                <h2 class="title_color">Meet Our Team</h2>
                <p>Get to know the dedicated professionals who make Tokyo Japanese School a center of excellence in Japanese
                    language education.</p>
            </div>

            <div class="swiper team-swiper">
                <div class="swiper-wrapper">
                    <!-- Owner -->
                    <div class="swiper-slide">
                        <div class="team_item text-center p-4">
                            <div class="team_img mb-3">
                                <img src="{{ asset('assets/image/farid.jpg') }}" alt="School Owner"
                                    class="img-fluid rounded-circle"
                                    style="width: 120px; height: 120px; object-fit: cover;">
                            </div>
                            <div class="team_content">
                                <h5 class="title_color mb-2">Mr. Tanaka Hiroshi</h5>
                                <p class="text-muted mb-2" style="font-size: 13px; font-weight: 600;">Founder & Owner</p>
                                <p style="font-size: 12px; line-height: 1.5;">Visionary leader with 15+ years in Japanese
                                    education. Established
                                    the school to bridge cultural gaps.</p>
                                <div class="social_links mt-3">
                                    <a href="#" class="text-primary mx-2"><i class="fab fa-facebook-f"></i></a>
                                    <a href="#" class="text-info mx-2"><i class="fab fa-twitter"></i></a>
                                    <a href="#" class="text-primary mx-2"><i class="fab fa-linkedin-in"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Head Teacher -->
                    <div class="swiper-slide">
                        <div class="team_item text-center p-4">
                            <div class="team_img mb-3">
                                <img src="{{ asset('assets/image/waleed.jpeg') }}" alt="Head Teacher"
                                    class="img-fluid rounded-circle"
                                    style="width: 120px; height: 120px; object-fit: cover;">
                            </div>
                            <div class="team_content">
                                <h5 class="title_color mb-2">Ms. Yuki Sato</h5>
                                <p class="text-muted mb-2" style="font-size: 13px; font-weight: 600;">Head Teacher</p>
                                <p style="font-size: 12px; line-height: 1.5;">Native Japanese speaker with JLPT
                                    certification expertise.
                                    Specializes in N1-N5 preparation.</p>
                                <div class="social_links mt-3">
                                    <a href="#" class="text-primary mx-2"><i class="fab fa-facebook-f"></i></a>
                                    <a href="#" class="text-info mx-2"><i class="fab fa-twitter"></i></a>
                                    <a href="#" class="text-danger mx-2"><i class="fab fa-instagram"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- UK Coordinator -->
                    <div class="swiper-slide">
                        <div class="team_item text-center p-4">
                            <div class="team_img mb-3">
                                <img src="{{ asset('assets/image/hazrat.jpg') }}" alt="UK Coordinator"
                                    class="img-fluid rounded-circle"
                                    style="width: 120px; height: 120px; object-fit: cover;">
                            </div>
                            <div class="team_content">
                                <h5 class="title_color mb-2">Mrs. Sarah Johnson</h5>
                                <p class="text-muted mb-2" style="font-size: 13px; font-weight: 600;">UK Program Coordinator
                                </p>
                                <p style="font-size: 12px; line-height: 1.5;">International education expert helping
                                    students with overseas
                                    opportunities and cultural integration.</p>
                                <div class="social_links mt-3">
                                    <a href="#" class="text-primary mx-2"><i class="fab fa-facebook-f"></i></a>
                                    <a href="#" class="text-info mx-2"><i class="fab fa-twitter"></i></a>
                                    <a href="#" class="text-primary mx-2"><i class="fab fa-linkedin-in"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Principal -->
                    <div class="swiper-slide">
                        <div class="team_item text-center p-4">
                            <div class="team_img mb-3">
                                <img src="{{ asset('assets/image/professor2.jpeg') }}" alt="Principal"
                                    class="img-fluid rounded-circle"
                                    style="width: 120px; height: 120px; object-fit: cover;">
                            </div>
                            <div class="team_content">
                                <h5 class="title_color mb-2">Dr. Ahmed Hassan</h5>
                                <p class="text-muted mb-2" style="font-size: 13px; font-weight: 600;">Principal</p>
                                <p style="font-size: 12px; line-height: 1.5;">Educational leader with PhD in Language
                                    Studies. Ensures quality
                                    education and student success.</p>
                                <div class="social_links mt-3">
                                    <a href="#" class="text-primary mx-2"><i class="fab fa-facebook-f"></i></a>
                                    <a href="#" class="text-primary mx-2"><i class="fab fa-linkedin-in"></i></a>
                                    <a href="#" class="text-success mx-2"><i class="fab fa-whatsapp"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Admin -->
                    <div class="swiper-slide">
                        <div class="team_item text-center p-4">
                            <div class="team_img mb-3">
                                <img src="{{ asset('assets/image/man.jpeg') }}" alt="Admin"
                                    class="img-fluid rounded-circle"
                                    style="width: 120px; height: 120px; object-fit: cover;">
                            </div>
                            <div class="team_content">
                                <h5 class="title_color mb-2">Ms. Fatima Ali</h5>
                                <p class="text-muted mb-2" style="font-size: 13px; font-weight: 600;">Administrator</p>
                                <p style="font-size: 12px; line-height: 1.5;">Manages admissions, student records, and
                                    daily operations. Always
                                    ready to help students.</p>
                                <div class="social_links mt-3">
                                    <a href="#" class="text-primary mx-2"><i class="fab fa-facebook-f"></i></a>
                                    <a href="#" class="text-danger mx-2"><i class="fab fa-instagram"></i></a>
                                    <a href="#" class="text-success mx-2"><i class="fab fa-whatsapp"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Navigation buttons -->
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>

                <!-- Pagination -->
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </section>

    <!--================ Japanese Academy Area =================-->
    <section class="section_gap" id="japanese-academy">
        <div class="container">
            <div class="section_title text-center">
                <h2 class="title_color">Japanese Language Academy</h2>
                <p>Professional language training with comprehensive JLPT preparation, conversation practice, and cultural
                    immersion programs.</p>
            </div>
            {{-- Course Programs --}}

            <div class="row justify-content-center text-center">
                <div class="col-lg-6 mb-4">
                    <div class="shadow-sm equal-box" style="background:#ffffff;border-radius:8px">
                        <h4 class="sec_h4 mb-3"><i class="fa fa-book"></i> Course Programs</h4>
                        <ul class="custom-list mr-5">
                            <li>JLPT N5 – Beginner foundation course</li>
                            <li>JLPT N4 – Elementary grammar & vocabulary</li>
                            <li>JLPT N3 – Intermediate level preparation</li>
                            <li>Conversation & Listening practice sessions</li>
                            <li>Japanese culture & business etiquette</li>
                            <li>Kanji writing & reading practice</li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-6 mb-4">
                    <div class="shadow-sm equal-box" style="background:#ffffff;border-radius:8px">
                        <h4 class="sec_h4 mb-3"><i class="fa fa-graduation-cap"></i> Course Features</h4>
                        <ul class="custom-list">
                            <li>Native Japanese instructors</li>
                            <li>Interactive multimedia classes</li>
                            <li>Small batch sizes (10-15 students)</li>
                            <li>Mock JLPT examinations</li>
                            <li>Certificate upon completion</li>
                            <li>Study materials included</li>
                        </ul>
                    </div>
                </div>
            </div>




          <div class="row justify-content-center">
            <div class="col-lg-12 mb-4">
                <div class="p-4 shadow-sm" style="background:#ffffff;border-radius:8px">
                    <h4 class="sec_h4 mb-3 text-center">
                        <i class="fa fa-user-plus"></i> Admission Process
                    </h4>
                    <div class="row">
                        <div class="col-md-3 text-center mb-3">
                            <div class="p-3 admission-step">
                                <div class="step-icon">
                                    <i class="fa fa-file-text fa-2x text-primary"></i>
                                </div>
                                <h6>Step 1</h6>
                                <p>Fill Application Form</p>
                            </div>
                        </div>
                        <div class="col-md-3 text-center mb-3">
                            <div class="p-3 admission-step">
                                <div class="step-icon">
                                    <i class="fa fa-comments fa-2x text-primary"></i>
                                </div>
                                <h6>Step 2</h6>
                                <p>Counseling Session</p>
                            </div>
                        </div>
                        <div class="col-md-3 text-center mb-3">
                            <div class="p-3 admission-step">
                                <div class="step-icon">
                                    <i class="fa fa-clipboard fa-2x text-primary"></i>
                                </div>
                                <h6>Step 3</h6>
                                <p>Level Assessment Test</p>
                            </div>
                        </div>
                        <div class="col-md-3 text-center mb-3">
                            <div class="p-3 admission-step">
                                <div class="step-icon">
                                    <i class="fa fa-users fa-2x text-primary"></i>
                                </div>
                                <h6>Step 4</h6>
                                <p>Batch Allocation</p>
                            </div>
                        </div>
                    </div>
                    <div class="text-center mt-3">
                        <button type="button" class="btn theme_btn button_hover" data-bs-toggle="modal" data-bs-target="#studentAdmissionModal">
                            Apply Now
                        </button>
                    </div>
                </div>
            </div>
        </div>

            <!-- Academy Statistics -->
            <div class="row mt-4">
                <div class="col-md-3 col-6 mb-3 text-center">
                    <h3 class="title_color">95%+</h3>
                    <small>JLPT Success Rate</small>
                </div>
                <div class="col-md-3 col-6 mb-3 text-center">
                    <h3 class="title_color">20+</h3>
                    <small>Experienced Instructors</small>
                </div>
                <div class="col-md-3 col-6 mb-3 text-center">
                    <h3 class="title_color">50+</h3>
                    <small>Active Batches</small>
                </div>
                <div class="col-md-3 col-6 mb-3 text-center">
                    <h3 class="title_color">2K+</h3>
                    <small>Students Trained</small>
                </div>
            </div>
        </div>
    </section>

    <!--================ Hostel Accommodation Rooms =================-->
    <section class="accomodation_area section_gap">
        <div class="container">
            <div class="section_title text-center">
                <h2 class="title_color">Hostel Room Types</h2>
                <p>Choose from our variety of comfortable and affordable accommodation options designed for Japanese
                    language students.</p>
            </div>
            <div class="row mb_30">
                @foreach ($rooms as $room)
                    <div class="col-lg-3 col-sm-6">
                        <div class="accomodation_item text-center">
                            <div class="hotel_img position-relative">
                                @if ($room->picture)
                                    <img src="{{ asset('storage/' . $room->picture) }}" alt="{{ $room->room_type }}"
                                        class="img-fluid">
                                @else
                                    <img src="{{ asset('assets/image/default-room.jpg') }}" alt="{{ $room->room_type }}"
                                        class="img-fluid">
                                @endif

                                <!-- Status Badge -->
                                <div
                                    class="status-badge 
                            @if ($room->status == 'available') badge-success 
                            @elseif($room->status == 'full') badge-danger 
                            @else badge-warning @endif">
                                    {{ ucfirst($room->status) }}
                                </div>

                                <!-- Book Now Button - only show if available -->
                                @if ($room->status == 'available')
                                    <a href="#" class="btn theme_btn button_hover">Book Now</a>
                                @endif
                            </div>

                            <div class="room-details">
                                <a href="{{ route('admin.room.details', $room->id) }}">
                                    <h4 class="sec_h4">{{ $room->room_type }} Room</h4>
                                </a>

                                <div class="room-info">
                                    <p class="capacity"><i class="fa fa-users"></i> Capacity: {{ $room->capacity }}
                                        students</p>
                                    <p class="occupied"><i class="fa fa-bed"></i> Occupied:
                                        {{ $room->occupied }}/{{ $room->capacity }}</p>
                                </div>

                                <h5 class="price">Rs {{ number_format($room->rent, 2) }}<small>/month</small></h5>

                                @if ($room->facilities)
                                    <div class="facilities">
                                        <small class="text-muted">
                                            <i class="fa fa-check-circle"></i> {{ $room->facilities }}
                                        </small>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!--================ Hostel Accommodation Rooms =================-->

    <!--================ About Tokyo Japanese School =================-->
    <section class="about_history_area section_gap">
        <div class="container">
            <div class="row">
                <div class="col-md-6 d_flex align-items-center">
                    <div class="about_content">
                        <h2 class="title title_color">About Tokyo<br>Japanese School<br>Our Mission</h2>
                        <p>Tokyo Japanese School is dedicated to providing comprehensive Japanese language education with a
                            focus on JLPT preparation and cultural understanding. We combine quality education with
                            comfortable hostel facilities to create the perfect learning environment for our students.</p>
                        <p>Our experienced native instructors use modern teaching methods to help students master Japanese
                            language skills, from basic conversation to advanced business communication.</p>
                        <a href="{{ route('contact') }}" class="button_hover theme_btn_two">Get Information</a>
                    </div>
                </div>
                <div class="col-md-6">
                    <img class="img-fluid img" src="{{ asset('assets/image/class1.jpg') }}" alt="Tokyo Japanese School">
                </div>
            </div>
        </div>
    </section>
    <!--================ About Tokyo Japanese School =================-->

    <!--================ Why Choose Us =================-->
    <section class="facilities_area section_gap">
        <div class="overlay bg-parallax" data-stellar-ratio="0.8" data-stellar-vertical-offset="0" data-background="">
        </div>
        <div class="container">
            <div class="section_title text-center">
                <h2 class="title_w">Why Choose Tokyo Japanese School</h2>
                <p>Experience the best Japanese language learning with our comprehensive facilities and expert guidance.</p>
            </div>
            <div class="row mb_30">
                <div class="col-lg-4 col-md-6">
                    <div class="facilities_item">
                        <h4 class="sec_h4"><i class="lnr lnr-graduation-hat"></i>Expert Instructors</h4>
                        <p>Learn from native Japanese speakers and certified JLPT instructors with years of teaching
                            experience.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="facilities_item">
                        <h4 class="sec_h4"><i class="lnr lnr-book"></i>Comprehensive Curriculum</h4>
                        <p>Structured courses covering all aspects of Japanese language from basic to advanced levels with
                            cultural insights.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="facilities_item">
                        <h4 class="sec_h4"><i class="lnr lnr-home"></i>Comfortable Hostel</h4>
                        <p>Safe and comfortable accommodation with all necessary amenities for a conducive learning
                            environment.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="facilities_item">
                        <h4 class="sec_h4"><i class="lnr lnr-laptop"></i>Modern Facilities</h4>
                        <p>Well-equipped classrooms with multimedia tools, library, and high-speed internet for effective
                            learning.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="facilities_item">
                        <h4 class="sec_h4"><i class="lnr lnr-users"></i>Small Batch Sizes</h4>
                        <p>Personal attention with small class sizes ensuring every student gets proper guidance and
                            practice.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="facilities_item">
                        <h4 class="sec_h4"><i class="lnr lnr-certificate"></i>JLPT Success</h4>
                        <p>Proven track record with 95%+ success rate in JLPT examinations across all levels.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================ Why Choose Us =================-->

    <!--================ Student Testimonials =================-->
    <section class="testimonial_area section_gap">
        <div class="container">
            <div class="section_title text-center">
                <h2 class="title_color">What Our Students Say</h2>
                <p>Hear from our successful students who have mastered Japanese language and achieved their JLPT goals.</p>
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
                        <div class="star">
                            <a href="#"><i class="fa fa-star"></i></a>
                            <a href="#"><i class="fa fa-star"></i></a>
                            <a href="#"><i class="fa fa-star"></i></a>
                            <a href="#"><i class="fa fa-star"></i></a>
                            <a href="#"><i class="fa fa-star"></i></a>
                        </div>
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
                        <div class="star">
                            <a href="#"><i class="fa fa-star"></i></a>
                            <a href="#"><i class="fa fa-star"></i></a>
                            <a href="#"><i class="fa fa-star"></i></a>
                            <a href="#"><i class="fa fa-star"></i></a>
                            <a href="#"><i class="fa fa-star"></i></a>
                        </div>
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
                        <div class="star">
                            <a href="#"><i class="fa fa-star"></i></a>
                            <a href="#"><i class="fa fa-star"></i></a>
                            <a href="#"><i class="fa fa-star"></i></a>
                            <a href="#"><i class="fa fa-star"></i></a>
                            <a href="#"><i class="fa fa-star"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================ Apply model =================-->
     <div class="modal fade" id="studentAdmissionModal" tabindex="-1" aria-labelledby="studentAdmissionModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="studentAdmissionModalLabel">
                        <i class="fa fa-user-plus me-2"></i>Student Admission Form
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="studentAdmissionForm" enctype="multipart/form-data">
                        <!-- Personal Information Section -->
                        <div class="mb-4">
                            <h4 class="section-header">1. Personal Information</h4>
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="name" class="form-label required-field">Full Name</label>
                                    <input type="text" class="form-control" id="name" name="name" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="father_name" class="form-label required-field">Father's Name</label>
                                    <input type="text" class="form-control" id="father_name" name="father_name" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="gender" class="form-label required-field">Gender</label>
                                    <select class="form-select" id="gender" name="gender" required>
                                        <option value="">Select Gender</option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                        <option value="other">Other</option>
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="cnic" class="form-label required-field">CNIC</label>
                                    <input type="text" class="form-control" id="cnic" name="cnic" placeholder="12345-6789012-3" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="date_of_birth" class="form-label required-field">Date of Birth</label>
                                    <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="marital_status" class="form-label required-field">Marital Status</label>
                                    <select class="form-select" id="marital_status" name="marital_status" required>
                                        <option value="">Select Status</option>
                                        <option value="single">Single</option>
                                        <option value="married">Married</option>
                                        <option value="divorced">Divorced</option>
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="phone" class="form-label required-field">Phone</label>
                                    <input type="text" class="form-control" id="phone" name="phone" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="email" class="form-label required-field">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="nationality" class="form-label required-field">Nationality</label>
                                    <input type="text" class="form-control" id="nationality" name="nationality" value="Pakistani" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="religion" class="form-label">Religion</label>
                                    <input type="text" class="form-control" id="religion" name="religion">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="sect" class="form-label">Sect</label>
                                    <input type="text" class="form-control" id="sect" name="sect">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="emergency_contact" class="form-label required-field">Emergency Contact</label>
                                    <input type="text" class="form-control" id="emergency_contact" name="emergency_contact" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="postal_address" class="form-label required-field">Postal Address</label>
                                    <textarea class="form-control" id="postal_address" name="postal_address" rows="3" required></textarea>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="address" class="form-label required-field">Current Address</label>
                                    <textarea class="form-control" id="address" name="address" rows="3" required></textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Department & Station Information -->
                        <div class="mb-4">
                            <h4 class="section-header">Department & Station</h4>
                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <label for="station" class="form-label">Station</label>
                                    <select class="form-select" id="station" name="station">
                                        <option value="">Select Station</option>
                                        <option value="Islamabad">Islamabad</option>
                                        <option value="Lahore">Lahore</option>
                                        <option value="Karachi">Karachi</option>
                                    </select>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="department" class="form-label">Department</label>
                                    <input type="text" class="form-control" id="department" name="department">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="specialization" class="form-label">Specialization</label>
                                    <input type="text" class="form-control" id="specialization" name="specialization">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="job_type" class="form-label">Job Type</label>
                                    <select class="form-select" id="job_type" name="job_type">
                                        <option value="permanent">Permanent</option>
                                        <option value="contract">Contract</option>
                                        <option value="temporary">Temporary</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Qualifications Section -->
                        <div class="mb-4">
                            <h4 class="section-header">2. Qualifications</h4>
                            <div id="qualifications-container">
                                <div class="dynamic-row qualification-row">
                                    <div class="row">
                                        <div class="col-md-2 mb-2">
                                            <label class="form-label">Degree</label>
                                            <select name="qualifications[0][degree_type]" class="form-select">
                                                <option value="">Select</option>
                                                <option value="SSC">SSC</option>
                                                <option value="HSSC">HSSC</option>
                                                <option value="Bachelor">Bachelor</option>
                                                <option value="Masters">Masters</option>
                                                <option value="MS/M.Phil">MS/M.Phil</option>
                                                <option value="Ph.D">Ph.D</option>
                                            </select>
                                        </div>
                                        <div class="col-md-2 mb-2">
                                            <label class="form-label">Duration (Years)</label>
                                            <input type="number" step="0.1" name="qualifications[0][duration_years]" class="form-control">
                                        </div>
                                        <div class="col-md-2 mb-2">
                                            <label class="form-label">Specialization</label>
                                            <input type="text" name="qualifications[0][specialization]" class="form-control">
                                        </div>
                                        <div class="col-md-2 mb-2">
                                            <label class="form-label">Passing Year</label>
                                            <input type="number" min="1950" max="2030" name="qualifications[0][passing_year]" class="form-control">
                                        </div>
                                        <div class="col-md-2 mb-2">
                                            <label class="form-label">CGPA/Grade</label>
                                            <input type="text" name="qualifications[0][cgpa_grade]" class="form-control">
                                        </div>
                                        <div class="col-md-2 mb-2">
                                            <label class="form-label">Institute/Board/University</label>
                                            <input type="text" name="qualifications[0][institute_board_university]" class="form-control">
                                        </div>
                                        <div class="col-md-12 mb-2">
                                            <label class="form-label">Country</label>
                                            <input type="text" name="qualifications[0][country]" class="form-control" value="Pakistan">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <a href="#" class="add-more-btn" onclick="addQualification()">
                                <i class="fa fa-plus me-1"></i>Add Another Qualification
                            </a>
                        </div>

                        <!-- Experience Section -->
                        <div class="mb-4">
                            <h4 class="section-header">3. Experience</h4>
                            <div id="experience-container">
                                <div class="dynamic-row experience-row">
                                    <div class="row">
                                        <div class="col-md-3 mb-2">
                                            <label class="form-label">Institution/Organization</label>
                                            <input type="text" name="experiences[0][institution_organization]" class="form-control">
                                        </div>
                                        <div class="col-md-3 mb-2">
                                            <label class="form-label">Position/Job Title</label>
                                            <input type="text" name="experiences[0][position_job_title]" class="form-control">
                                        </div>
                                        <div class="col-md-2 mb-2">
                                            <label class="form-label">From Date</label>
                                            <input type="date" name="experiences[0][from_date]" class="form-control">
                                        </div>
                                        <div class="col-md-2 mb-2">
                                            <label class="form-label">To Date</label>
                                            <input type="date" name="experiences[0][to_date]" class="form-control">
                                        </div>
                                        <div class="col-md-2 mb-2">
                                            <label class="form-label">Total Period (Months)</label>
                                            <input type="number" name="experiences[0][total_period_months]" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <a href="#" class="add-more-btn" onclick="addExperience()">
                                <i class="fa fa-plus me-1"></i>Add Another Experience
                            </a>
                        </div>

                        <!-- References Section -->
                        <div class="mb-4">
                            <h4 class="section-header">4. References</h4>
                            <div id="references-container">
                                <div class="dynamic-row reference-row">
                                    <div class="row">
                                        <div class="col-md-4 mb-2">
                                            <label class="form-label">Name</label>
                                            <input type="text" name="references[0][name]" class="form-control">
                                        </div>
                                        <div class="col-md-4 mb-2">
                                            <label class="form-label">Designation</label>
                                            <input type="text" name="references[0][designation]" class="form-control">
                                        </div>
                                        <div class="col-md-4 mb-2">
                                            <label class="form-label">Contact No.</label>
                                            <input type="text" name="references[0][contact_no]" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <a href="#" class="add-more-btn" onclick="addReference()">
                                <i class="fa fa-plus me-1"></i>Add Another Reference
                            </a>
                        </div>

                        <!-- Admission Details -->
                        <div class="mb-4">
                            <h4 class="section-header">Admission Details</h4>
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="admission_date" class="form-label required-field">Admission Date</label>
                                    <input type="date" class="form-control" id="admission_date" name="admission_date" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="room_id" class="form-label">Assign Room</label>
                                    <select class="form-select" id="room_id" name="room_id">
                                        <option value="">Select Room (Optional)</option>
                                        <option value="1">Room 101 (5 spaces available)</option>
                                        <option value="2">Room 102 (3 spaces available)</option>
                                        <option value="3">Room 103 (2 spaces available)</option>
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="photo" class="form-label">Upload Photo</label>
                                    <input type="file" class="form-control" id="photo" name="photo" accept="image/*">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-submit" onclick="submitStudentForm()">
                        <i class="fa fa-save me-2"></i>Add Student
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Success Alert -->
    <div class="alert alert-success alert-dismissible fade" role="alert" id="successAlert" 
         style="position: fixed; top: 20px; right: 20px; z-index: 9999; display: none;">
        <i class="fa fa-check-circle me-2"></i>
        <strong>Success!</strong> Student application has been submitted successfully.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <style>
        .floating-social {
            position: fixed;
            right: 18px;
            bottom: 15px;
            z-index: 9999;
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .floating-social a {
            width: 54px;
            height: 54px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            box-shadow: 0 8px 20px rgba(0, 0, 0, .2);
            transition: transform .2s ease, box-shadow .2s ease, opacity .2s ease;
            text-decoration: none;
        }

        .floating-social a:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, .25);
        }

        .floating-social .whatsapp {
            background-color: #25D366;
        }

        .floating-social .facebook {
            background-color: #1877F2;
        }

        @media (max-width: 768px) {
            .floating-social {
                right: 14px;
                bottom: 10px;
                gap: 10px;
            }

            .floating-social a {
                width: 40px;
                height: 40px;
            }
        }
    </style>

    <div class="floating-social" aria-label="Quick contact">
        <a class="whatsapp" href="https://wa.me/923078919198" target="_blank" rel="noopener"
            aria-label="Chat on WhatsApp">
            <i class="fab fa-whatsapp" style="font-size:24px;"></i>
        </a>
        <a class="facebook" href="https://www.facebook.com/waleed.yaseen/" target="_blank" rel="noopener"
            aria-label="Open Facebook">
            <i class="fab fa-facebook" style="font-size:22px;"></i>
        </a>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/8.4.7/swiper-bundle.min.js"></script>
    <script>
        const swiper = new Swiper('.team-swiper', {
            slidesPerView: 1,
            spaceBetween: 30,
            centeredSlides: true,
            loop: true,
            autoplay: {
                delay: 4000,
                disableOnInteraction: false,
            },
            effect: 'slide',
            speed: 800,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            breakpoints: {
                640: {
                    slidesPerView: 2,
                    spaceBetween: 20,
                },
                768: {
                    slidesPerView: 3,
                    spaceBetween: 30,
                },
                1024: {
                    slidesPerView: 4,
                    spaceBetween: 30,
                },
            },
            on: {
                init: function() {
                    // Add smooth entrance animation
                    this.slides.forEach((slide, index) => {
                        slide.style.animationDelay = `${index * 0.1}s`;
                    });
                },
            }
        });
    </script>
    {{-- Apply Script --}}
     <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        let qualificationIndex = 1;
        let experienceIndex = 1;
        let referenceIndex = 1;

        // Add Qualification
        function addQualification() {
            const container = document.getElementById('qualifications-container');
            const newRow = document.createElement('div');
            newRow.className = 'dynamic-row qualification-row';
            newRow.innerHTML = `
                <button type="button" class="remove-btn" onclick="this.closest('.qualification-row').remove()">×</button>
                <div class="row">
                    <div class="col-md-2 mb-2">
                        <select name="qualifications[${qualificationIndex}][degree_type]" class="form-select">
                            <option value="">Select</option>
                            <option value="SSC">SSC</option>
                            <option value="HSSC">HSSC</option>
                            <option value="Bachelor">Bachelor</option>
                            <option value="Masters">Masters</option>
                            <option value="MS/M.Phil">MS/M.Phil</option>
                            <option value="Ph.D">Ph.D</option>
                        </select>
                    </div>
                    <div class="col-md-2 mb-2">
                        <input type="number" step="0.1" name="qualifications[${qualificationIndex}][duration_years]" class="form-control" placeholder="Duration">
                    </div>
                    <div class="col-md-2 mb-2">
                        <input type="text" name="qualifications[${qualificationIndex}][specialization]" class="form-control" placeholder="Specialization">
                    </div>
                    <div class="col-md-2 mb-2">
                        <input type="number" min="1950" max="2030" name="qualifications[${qualificationIndex}][passing_year]" class="form-control" placeholder="Year">
                    </div>
                    <div class="col-md-2 mb-2">
                        <input type="text" name="qualifications[${qualificationIndex}][cgpa_grade]" class="form-control" placeholder="CGPA/Grade">
                    </div>
                    <div class="col-md-2 mb-2">
                        <input type="text" name="qualifications[${qualificationIndex}][institute_board_university]" class="form-control" placeholder="Institute">
                    </div>
                    <div class="col-md-12 mb-2">
                        <input type="text" name="qualifications[${qualificationIndex}][country]" class="form-control" value="Pakistan" placeholder="Country">
                    </div>
                </div>
            `;
            container.appendChild(newRow);
            qualificationIndex++;
            return false;
        }

        // Add Experience
        function addExperience() {
            const container = document.getElementById('experience-container');
            const newRow = document.createElement('div');
            newRow.className = 'dynamic-row experience-row';
            newRow.innerHTML = `
                <button type="button" class="remove-btn" onclick="this.closest('.experience-row').remove()">×</button>
                <div class="row">
                    <div class="col-md-3 mb-2">
                        <input type="text" name="experiences[${experienceIndex}][institution_organization]" class="form-control" placeholder="Institution/Organization">
                    </div>
                    <div class="col-md-3 mb-2">
                        <input type="text" name="experiences[${experienceIndex}][position_job_title]" class="form-control" placeholder="Position/Job Title">
                    </div>
                    <div class="col-md-2 mb-2">
                        <input type="date" name="experiences[${experienceIndex}][from_date]" class="form-control">
                    </div>
                    <div class="col-md-2 mb-2">
                        <input type="date" name="experiences[${experienceIndex}][to_date]" class="form-control">
                    </div>
                    <div class="col-md-2 mb-2">
                        <input type="number" name="experiences[${experienceIndex}][total_period_months]" class="form-control" placeholder="Months">
                    </div>
                </div>
            `;
            container.appendChild(newRow);
            experienceIndex++;
            return false;
        }

        // Add Reference
        function addReference() {
            const container = document.getElementById('references-container');
            const newRow = document.createElement('div');
            newRow.className = 'dynamic-row reference-row';
            newRow.innerHTML = `
                <button type="button" class="remove-btn" onclick="this.closest('.reference-row').remove()">×</button>
                <div class="row">
                    <div class="col-md-4 mb-2">
                        <input type="text" name="references[${referenceIndex}][name]" class="form-control" placeholder="Name">
                    </div>
                    <div class="col-md-4 mb-2">
                        <input type="text" name="references[${referenceIndex}][designation]" class="form-control" placeholder="Designation">
                    </div>
                    <div class="col-md-4 mb-2">
                        <input type="text" name="references[${referenceIndex}][contact_no]" class="form-control" placeholder="Contact No.">
                    </div>
                </div>
            `;
            container.appendChild(newRow);
            referenceIndex++;
            return false;
        }

        // Submit Form
        function submitStudentForm() {
            const form = document.getElementById('studentAdmissionForm');
            
            if (form.checkValidity()) {
                // Create FormData object to handle file uploads
                const formData = new FormData(form);
                
                // Here you would normally send the data to your Laravel backend
                console.log('Form Data:', Object.fromEntries(formData.entries()));
                
                // For demonstration, we'll just show success message
                const modal = bootstrap.Modal.getInstance(document.getElementById('studentAdmissionModal'));
                modal.hide();
                
                // Show success message
                const successAlert = document.getElementById('successAlert');
                successAlert.style.display = 'block';
                successAlert.classList.add('show');
                
                // Reset form
                form.reset();
                
                // Reset dynamic sections
                resetDynamicSections();
                
                // Auto hide success message after 5 seconds
                setTimeout(() => {
                    successAlert.classList.remove('show');
                    setTimeout(() => {
                        successAlert.style.display = 'none';
                    }, 150);
                }, 5000);
                
            } else {
                form.reportValidity();
            }
        }

        // Reset dynamic sections
        function resetDynamicSections() {
            // Reset qualifications
            const qualContainer = document.getElementById('qualifications-container');
            qualContainer.innerHTML = `
                <div class="dynamic-row qualification-row">
                    <div class="row">
                        <div class="col-md-2 mb-2">
                            <label class="form-label">Degree</label>
                            <select name="qualifications[0][degree_type]" class="form-select">
                                <option value="">Select</option>
                                <option value="SSC">SSC</option>
                                <option value="HSSC">HSSC</option>
                                <option value="Bachelor">Bachelor</option>
                                <option value="Masters">Masters</option>
                                <option value="MS/M.Phil">MS/M.Phil</option>
                                <option value="Ph.D">Ph.D</option>
                            </select>
                        </div>
                        <div class="col-md-2 mb-2">
                            <label class="form-label">Duration (Years)</label>
                            <input type="number" step="0.1" name="qualifications[0][duration_years]" class="form-control">
                        </div>
                        <div class="col-md-2 mb-2">
                            <label class="form-label">Specialization</label>
                            <input type="text" name="qualifications[0][specialization]" class="form-control">
                        </div>
                        <div class="col-md-2 mb-2">
                            <label class="form-label">Passing Year</label>
                            <input type="number" min="1950" max="2030" name="qualifications[0][passing_year]" class="form-control">
                        </div>
                        <div class="col-md-2 mb-2">
                            <label class="form-label">CGPA/Grade</label>
                            <input type="text" name="qualifications[0][cgpa_grade]" class="form-control">
                        </div>
                        <div class="col-md-2 mb-2">
                            <label class="form-label">Institute/Board/University</label>
                            <input type="text" name="qualifications[0][institute_board_university]" class="form-control">
                        </div>
                        <div class="col-md-12 mb-2">
                            <label class="form-label">Country</label>
                            <input type="text" name="qualifications[0][country]" class="form-control" value="Pakistan">
                        </div>
                    </div>
                </div>
            `;

            // Reset experiences
            const expContainer = document.getElementById('experience-container');
            expContainer.innerHTML = `
                <div class="dynamic-row experience-row">
                    <div class="row">
                        <div class="col-md-3 mb-2">
                            <label class="form-label">Institution/Organization</label>
                            <input type="text" name="experiences[0][institution_organization]" class="form-control">
                        </div>
                        <div class="col-md-3 mb-2">
                            <label class="form-label">Position/Job Title</label>
                            <input type="text" name="experiences[0][position_job_title]" class="form-control">
                        </div>
                        <div class="col-md-2 mb-2">
                            <label class="form-label">From Date</label>
                            <input type="date" name="experiences[0][from_date]" class="form-control">
                        </div>
                        <div class="col-md-2 mb-2">
                            <label class="form-label">To Date</label>
                            <input type="date" name="experiences[0][to_date]" class="form-control">
                        </div>
                        <div class="col-md-2 mb-2">
                            <label class="form-label">Total Period (Months)</label>
                            <input type="number" name="experiences[0][total_period_months]" class="form-control">
                        </div>
                    </div>
                </div>
            `;

            // Reset references
            const refContainer = document.getElementById('references-container');
            refContainer.innerHTML = `
                <div class="dynamic-row reference-row">
                    <div class="row">
                        <div class="col-md-4 mb-2">
                            <label class="form-label">Name</label>
                            <input type="text" name="references[0][name]" class="form-control">
                        </div>
                        <div class="col-md-4 mb-2">
                            <label class="form-label">Designation</label>
                            <input type="text" name="references[0][designation]" class="form-control">
                        </div>
                        <div class="col-md-4 mb-2">
                            <label class="form-label">Contact No.</label>
                            <input type="text" name="references[0][contact_no]" class="form-control">
                        </div>
                    </div>
                </div>
            `;

            // Reset counters
            qualificationIndex = 1;
            experienceIndex = 1;
            referenceIndex = 1;
        }

        // CNIC formatting
        document.getElementById('cnic').addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length >= 5) {
                value = value.substring(0, 5) + '-' + value.substring(5);
            }
            if (value.length >= 13) {
                value = value.substring(0, 13) + '-' + value.substring(13);
            }
            e.target.value = value.substring(0, 15);
        });

        // Phone number formatting
        document.getElementById('phone').addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            e.target.value = value.substring(0, 11);
        });

        // Emergency contact formatting
        document.getElementById('emergency_contact').addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            e.target.value = value.substring(0, 11);
        });
    </script>
@endsection
