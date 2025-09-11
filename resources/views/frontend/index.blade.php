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
                        <h4 class="sec_h4 mb-3 text-center"><i class="fa fa-user-plus"></i> Admission Process</h4>
                        <div class="row">
                            <div class="col-md-3 text-center mb-3">
                                <div class="p-3">
                                    <i class="fa fa-file-text fa-2x text-primary mb-2"></i>
                                    <h6>Step 1</h6>
                                    <p>Fill Application Form</p>
                                </div>
                            </div>
                            <div class="col-md-3 text-center mb-3">
                                <div class="p-3">
                                    <i class="fa fa-comments fa-2x text-primary mb-2"></i>
                                    <h6>Step 2</h6>
                                    <p>Counseling Session</p>
                                </div>
                            </div>
                            <div class="col-md-3 text-center mb-3">
                                <div class="p-3">
                                    <i class="fa fa-clipboard fa-2x text-primary mb-2"></i>
                                    <h6>Step 3</h6>
                                    <p>Level Assessment Test</p>
                                </div>
                            </div>
                            <div class="col-md-3 text-center mb-3">
                                <div class="p-3">
                                    <i class="fa fa-users fa-2x text-primary mb-2"></i>
                                    <h6>Step 4</h6>
                                    <p>Batch Allocation</p>
                                </div>
                            </div>
                        </div>
                        <div class="text-center mt-3">
                            <a href="{{ route('contact') }}" class="btn theme_btn button_hover">Apply Now</a>
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
                    <img class="img-fluid" src="{{ asset('assets/image/about_bg.jpg') }}" alt="Tokyo Japanese School">
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
    <!--================ Student Testimonials =================-->

    <!-- Floating Social Buttons -->
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
@endsection
