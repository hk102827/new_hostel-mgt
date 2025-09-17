@extends('layouts.app')
@section('content')
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">


    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        @media (max-width: 576px) {
            .banner_content h6 {
                font-size: 14px;       /* optional: text size thoda chhota */
                line-height: 1.2;      /* gap kam */
                margin-bottom: 5px;    /* neeche ka space kam */
            }

            .banner_content h2 {
                font-size: 22px;       /* thoda chhota text */
                line-height: 1.3;
                margin-bottom: 10px;
            }

            .banner_content p {
                font-size: 14px;
                line-height: 1.4;      /* gap kam */
                margin-bottom: 15px;
            }
            }


        .custom-list {
            list-style: none;
            padding: 0;
            margin: 0 auto;
            text-align: center;
            /* text center */
            display: inline-block;
            
            /* list ko inline block banaya */
        }
        .first{
            margin-left: 34%;
        }
        @media(max-width: 776px){
            .first{
                margin-left: 20%;
            }
        }
        .second{
            margin-left: 15%;
        }
        @media(max-width: 776px){
            .second{
                margin-left: 20%;
            }
        }

        .custom-list li {
            position: relative;
            padding-left: 25px;
            margin-bottom: 8px;
            font-size: 14px;
            line-height: 1.6;
            text-align: left;
            /* har line ka text left aligned ho */
        }

        .custom-list li::before {
            content: "\f00c";
            /* Font Awesome check icon */
            font-family: "Font Awesome 5 Free";
            font-weight: 900;
            position: absolute;
            left: 0;
            top: 0;
            color: #28a745;
            font-size: 14px;
        }

        .col-center {
            display: flex;
            flex-direction: column;
            align-items: center;
            /* poori list center me aa jayegi */
        }






    .section_gap {
    padding: 80px 0; /* top & bottom */
}

@media (max-width: 576px) {
    .section_gap {
        padding: 20px 0; /* chhota gap */
    }
}
@media (max-width: 576px) {
    .section_title h2 {
        font-size: 18px !important;
    }
    h2 {
        font-size: 18px !important;
    }
       .col-center p {
        margin-bottom: 0px !important; /* default se kam */
        padding-bottom: 0 !important;  /* agar padding lagi ho to remove */
    }
}




        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 15px;
        }

        .section_title {
            text-align: center;
            margin-bottom: 60px;
        }





        @keyframes gradient {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        .title_color {
            color: #2c3e50;
        }

        /* Swiper Container - Centered slides for active card */
        .team-swiper {
            padding: 80px 0 90px 0;
            overflow: hidden;
            /* Allow slight overflow for centered effect */
            width: 100%;
        }

        .swiper-slide {
            height: auto;
            display: flex;
            justify-content: center;
            align-items: stretch;
        }

        /* Team Item Styling */
        .team_item {
            background: white border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            transform: scale(0.9);
            padding: 30px 25px;
            text-align: center;
            position: relative;
            overflow: hidden;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            min-height: 420px;
            width: 100%;
            max-width: 280px;
            margin: 0 auto;
        }

        .team_item::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.1), transparent);
            transform: rotate(45deg);
            transition: all 0.6s;
            opacity: 0;
        }

        .team_item:hover::before {
            opacity: 1;
            animation: shimmer 1.5s ease-in-out;
        }

        @keyframes shimmer {
            0% {
                transform: translateX(-100%) translateY(-100%) rotate(45deg);
            }

            100% {
                transform: translateX(100%) translateY(100%) rotate(45deg);
            }
        }

        /* Center slide styling - Active card */
        .swiper-slide-active .team_item {
            background: linear-gradient(135deg, #8a9cea 0%, #80a8e8 100%);
            color: #fff;
            transform: scale(1.05);
            box-shadow: 0 20px 40px rgba(102, 126, 234, 0.3);
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
        }

        /* Dancing animation for center slide */
        @keyframes dance {

            0%,
            100% {
                transform: scale(1.05) rotateY(0deg);
            }

            25% {
                transform: scale(1.07) rotateY(2deg);
            }

            50% {
                transform: scale(1.05) rotateY(0deg);
            }

            75% {
                transform: scale(1.07) rotateY(-2deg);
            }
        }

        .swiper-slide-active .team_item {
            animation: dance 3s ease-in-out infinite;
        }

        .team_img {
            margin-bottom: 25px;
            position: relative;
        }

        .team_img img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid rgba(102, 126, 234, 0.3);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            transition: all 0.4s ease;
        }

        .swiper-slide-active .team_img img {
            transform: scale(1.1);
            border: 3px solid rgba(255, 255, 255, 0.3);
        }

        .team_content h5 {
            font-size: 1.4em;
            font-weight: 700;
            margin-bottom: 12px;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .team_content .text-muted {
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 15px;
            color: #666 !important;
        }

        .team_content p:last-of-type {
            font-size: 12px;
            line-height: 1.5;
            margin-bottom: 20px;
            flex-grow: 1;
            color: #555;
        }

        .swiper-slide-active .team_content p:last-of-type {
            color: rgba(255, 255, 255, 0.9);
        }

        .social_links {
            display: flex;
            justify-content: center;
            gap: 12px;
            margin-top: auto;
        }

        .social_links a {
            display: inline-block;
            width: 30px;
            height: 30px;
            line-height: 30px;
            border-radius: 50%;
            transition: all 0.3s ease;
            font-size: 14px;
            text-align: center;
            text-decoration: none;
        }

        .social_links a:hover {
            transform: translateY(-3px) scale(1.2);
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

        /* Active card ke social icons */
        .swiper-slide-active .team_item .social_links a {
            color: #fff !important;
            background-color: rgba(255, 255, 255, 0.2);
        }

        .swiper-slide-active .team_item .social_links a:hover {
            background-color: #fff !important;
            color: #764ba2 !important;
        }

        /* Custom Navigation */
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

        /* Custom Pagination */
        .swiper-pagination-bullet {
            width: 12px;
            height: 12px;
            background: rgba(102, 126, 234, 0.3);
            border-radius: 50%;
            transition: all 0.3s ease;
            opacity: 1;
        }

        .swiper-pagination-bullet-active {
            background: #667eea;
            transform: scale(1.3);
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
                opacity: 1;
                transform: translateY(0) scale(0.9);
            }
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .section_title h2 {
                font-size: 2.5em;
            }

            .team-swiper {
                padding: 30px 0 50px 0;
            }

            .swiper-slide-active .team_item {
                transform: scale(1.02);
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

            .team_item {
                min-height: 380px;
                max-width: 250px;
            }
        }

        @media (max-width: 576px) {
            .team_item {
                margin: 0 10px;
                min-height: 350px;
                max-width: 220px;
            }

            .swiper-slide-active .team_item {
                transform: scale(1.05);
            }

            .team_img img {
                width: 100px;
                height: 100px;
            }
        }
    </style>
    <style>
        /* Full Width Modal Styles */
        .modal-fullwidth {
            max-width: 95% !important;
            width: 95% !important;
            margin: 2.5% auto !important;
        }

        .modal-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-bottom: none;
        }

        .section-header {
            color: #667eea;
            border-bottom: 2px solid #eee;
            padding-bottom: 10px;
            margin-bottom: 20px;
            font-weight: 600;
        }

        .required-field::after {
            content: "*";
            color: red;
            margin-left: 3px;
        }

        .error-field {
            border-color: #dc3545 !important;
            box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25) !important;
        }

        .dynamic-row {
            position: relative;
            padding: 15px;
            margin-bottom: 15px;
            border: 1px solid #e9ecef;
            border-radius: 8px;
            background-color: #f8f9fa;
        }

        .remove-btn {
            position: absolute;
            top: 5px;
            right: 10px;
            background: #dc3545;
            color: white;
            border: none;
            width: 25px;
            height: 25px;
            border-radius: 50%;
            font-size: 14px;
            line-height: 1;
            cursor: pointer;
            z-index: 10;
        }

        .remove-btn:hover {
            background: #c82333;
        }

        .add-more-btn {
            display: inline-block;
            color: #667eea;
            text-decoration: none;
            font-weight: 500;
            padding: 8px 15px;
            border: 2px dashed #667eea;
            border-radius: 6px;
            transition: all 0.3s ease;
        }

        .add-more-btn:hover {
            background-color: #667eea;
            color: white;
            text-decoration: none;
        }

        .btn-submit {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            color: white;
            padding: 10px 30px;
            font-weight: 500;
        }

        .btn-submit:hover {
            background: linear-gradient(135deg, #5a67d8 0%, #6b46c1 100%);
            color: white;
        }

        .apply-now-btn {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            color: white;
            padding: 12px 30px;
            border-radius: 25px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
        }

        .apply-now-btn:hover {
            background: linear-gradient(135deg, #5a67d8 0%, #6b46c1 100%);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.6);
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .modal-fullwidth {
                max-width: 98% !important;
                width: 98% !important;
                margin: 1% auto !important;
            }

            .dynamic-row {
                padding: 10px;
            }

            .remove-btn {
                position: static;
                float: right;
                margin-bottom: 10px;
            }
        }
    </style>
    @if (session('success'))
        <div id="successMessage" class="alert alert-success">
            <p class="mb-0">{{ session('success') }}</p>
        </div>
    @endif

    <section class="banner_area">
        <!-- Video Background -->
        <video autoplay muted loop playsinline class="bg-video">
            <source src="{{ asset('assets/image/classvideo.mp4') }}" type="video/mp4">
        </video>

        <div class="booking_table d_flex align-items-center">
            <!-- Overlay -->
            <div class="overlay"></div>

            <div class="container">
                <div class="banner_content text-center">
                    <h6>Learn Japanese Language & Culture</h6>
                    <h2>Tokyo Japanese School</h2>
                    <p>
                        Master Japanese language with professional JLPT preparation courses<br>
                        and comfortable hostel accommodation for students.
                    </p>
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
                                <img src="{{ asset('assets/image/farids.jpg') }}" alt="School Owner"
                                    class="img-fluid rounded-circle"
                                    style="width: 120px; height: 120px; object-fit: cover;">
                            </div>
                            <div class="team_content">
                                <h5 class="title_color mb-2">Mr. Farid Kiyani</h5>
                                <p class="text-muted mb-2" style="font-size: 13px; font-weight: 600;">Founder & Owner</p>
                                <p style="font-size: 12px; line-height: 1.5;">
                                    Proud owner of the school and a successful entrepreneur in Japan, dedicated to building
                                    strong
                                    cultural and educational connections.
                                </p>
                                <div class="social_links mt-3">
                                    <a href="#" class="text-primary mx-2"><i class="fab fa-facebook-f"></i></a>
                                    <a href="#" class="text-info mx-2"><i class="fab fa-twitter"></i></a>
                                    <a href="#" class="text-primary mx-2"><i class="fab fa-linkedin-in"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- Head Teacher -->
                    <!-- Head Teacher -->
                    <div class="swiper-slide">
                        <div class="team_item text-center p-4">
                            <div class="team_img mb-3">
                                <img src="{{ asset('assets/image/yamo.jpg') }}" alt="Head Teacher"
                                    class="img-fluid rounded-circle"
                                    style="width: 120px; height: 120px; object-fit: cover;">
                            </div>
                            <div class="team_content">
                                <h5 class="title_color mb-2">Ms. Yamamoto Yuki</h5>
                                <p class="text-muted mb-2" style="font-size: 13px; font-weight: 600;">Head Teacher</p>
                                <p style="font-size: 12px; line-height: 1.5;">
                                    A native Japanese educator from Japan, teaching at our school with JLPT expertise and
                                    specialization in N1–N5 preparation.
                                </p>
                                <div class="social_links mt-3">
                                    <a href="#" class="text-primary mx-2"><i class="fab fa-facebook-f"></i></a>
                                    <a href="#" class="text-info mx-2"><i class="fab fa-twitter"></i></a>
                                    <a href="#" class="text-danger mx-2"><i class="fab fa-instagram"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- Principal & Journalist -->
                    <div class="swiper-slide">
                        <div class="team_item text-center p-4">
                            <div class="team_img mb-3">
                                <img src="{{ asset('assets/image/Waleed.jpeg') }}" alt="School Principal"
                                    class="img-fluid rounded-circle"
                                    style="width: 120px; height: 120px; object-fit: cover;">
                            </div>
                            <div class="team_content">
                                <h5 class="title_color mb-2">Mr. Waleed Yaseen</h5>
                                <p class="text-muted mb-2" style="font-size: 13px; font-weight: 600;">Principal & Journalist
                                </p>
                                <p style="font-size: 12px; line-height: 1.5;">
                                    Dedicated Principal of the school and an active journalist with 360 News,
                                    combining leadership in education with a passion for media and communication.
                                </p>
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
                                <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=300&h=300&fit=crop&crop=faces"
                                    alt="Principal" class="img-fluid rounded-circle">
                            </div>
                            <div class="team_content">
                                <h5 class="title_color mb-2">Dr. Ahmed Hassan</h5>
                                <p class="text-muted mb-2">Principal</p>
                                <p>Educational leader with PhD in Language Studies. Ensures quality
                                    education and student success through innovative teaching methodologies.</p>
                                <div class="social_links mt-3">
                                    <a href="#" class="text-primary mx-2"><i class="fab fa-facebook-f"></i></a>
                                    <a href="#" class="text-primary mx-2"><i class="fab fa-linkedin-in"></i></a>
                                    <a href="#" class="text-success mx-2"><i class="fab fa-whatsapp"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Administrator -->
                    <div class="swiper-slide">
                        <div class="team_item text-center p-4">
                            <div class="team_img mb-3">
                                <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=300&h=300&fit=crop&crop=faces"
                                    alt="Admin" class="img-fluid rounded-circle">
                            </div>
                            <div class="team_content">
                                <h5 class="title_color mb-2">Ms. Fatima Ali</h5>
                                <p class="text-muted mb-2">Administrator</p>
                                <p>Manages admissions, student records, and daily operations. Always
                                    ready to help students with their academic and administrative needs.</p>
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
              <div class="col-md-6 col-center">
                    <h5 class="title_color mb-3"><i class="fas fa-book-open"></i> Course Programs</h5>
                    <ul class="custom-list first">
                        <li>JLPT N5 – Beginner foundation course</li>
                        <li>JLPT N4 – Elementary grammar & vocabulary</li>
                        <li>JLPT N3 – Intermediate level preparation</li>
                        <li>Conversation & Listening practice sessions</li>
                        <li>Japanese culture & business etiquette</li>
                        <li>Kanji writing & reading practice</li>
                    </ul>
                </div>


                <div class="col-lg-6 mb-4">
                    <div class="shadow-sm equal-box" style="background:#ffffff;border-radius:8px">
                        <h4 class="sec_h4 mb-3"><i class="fa fa-graduation-cap"></i> Course Features</h4>
                        <ul class="custom-list second">
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
                            <button type="button" class="apply-now-btn" data-bs-toggle="modal"
                                data-bs-target="#studentAdmissionModal">
                                <i class="fa fa-paper-plane me-2"></i>Apply Now
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
                        <div>Tokyo Japanese School is dedicated to providing comprehensive Japanese language education with
                            a
                            focus on JLPT preparation and cultural understanding. We combine quality education with
                            comfortable hostel facilities to create the perfect learning environment for our students.</div>
                        <div class="mt-2">Our experienced native instructors use modern teaching methods to help students
                            master Japanese
                            language skills, from basic conversation to advanced business communication.</div>
                        <a href="{{ route('contact') }}" class="button_hover theme_btn_two mt-4">Get Information</a>
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
   <section class="motivation_area section_gap">
        <div class="container">
            <div class="section_title text-center">
                <h2 class="title_color">Begin Your Japanese Journey Today</h2>
                <p>Transform your dreams into reality with our comprehensive Japanese language programs</p>
            </div>
            
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="single_feature">
                        <div class="feature_head">
                            <span class="lnr lnr-graduation-hat"></span>
                            <h4>Master JLPT Levels</h4>
                        </div>
                        <div class="feature_content">
                            <p>From beginner N5 to advanced N1, our structured curriculum ensures your success in Japanese Language Proficiency Tests with proven teaching methods.</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <div class="single_feature">
                        <div class="feature_head">
                            <span class="lnr lnr-users"></span>
                            <h4>Expert Native Teachers</h4>
                        </div>
                        <div class="feature_content">
                            <p>Learn from qualified native Japanese instructors who bring authentic language experience and cultural insights to every lesson.</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <div class="single_feature">
                        <div class="feature_head">
                            <span class="lnr lnr-rocket"></span>
                            <h4>Career Opportunities</h4>
                        </div>
                        <div class="feature_content">
                            <p>Open doors to exciting careers in Japan, translation, tourism, and international business with our comprehensive language training.</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row mt-5">
                <div class="col-lg-6 order-lg-2">
                    <div class="about_content">
                        <h3 class="title_color">Our Success Story</h3>
                        <p>Over 500+ students have successfully completed their Japanese language journey with us. Our proven track record includes:</p>
                        <div class="counter_content d-flex justify-content-between flex-wrap mt-3">
                            <div class="single_counter text-center mb-3">
                                <h2 class="font-weight-bold">95%</h2>
                                <p class="text-muted">JLPT Pass Rate</p>
                            </div>
                            <div class="single_counter text-center mb-3">
                                <h2 class="font-weight-bold">200+</h2>
                                <p class="text-muted">Students in Japan</p>
                            </div>
                            <div class="single_counter text-center mb-3">
                                <h2 class="font-weight-bold">8</h2>
                                <p class="text-muted">Years Experience</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-6 order-lg-1">
                    <div class="about_content">
                        <h3 class="title_color">Why Choose Japanese?</h3>
                        <p>Japanese is the gateway to one of the world's most fascinating cultures and advanced economies. With over 125 million speakers globally, mastering Japanese opens doors to:</p>
                        <ul class="feature_list">
                            <li>High-paying job opportunities in Japan</li>
                            <li>Access to cutting-edge technology and innovation</li>
                            <li>Rich cultural experiences and traditions</li>
                            <li>Business partnerships with Japanese companies</li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <div class="row mt-4">
                <div class="col-12 text-center">
                    <div class="cta_content">
                        <h3 class="title_color">Ready to Start Your Japanese Adventure?</h3>
                        <p>Join thousands of successful students who chose us for their Japanese language journey</p>
                        <a href="" class="primary_btn" data-bs-toggle="modal"
                                data-bs-target="#studentAdmissionModal">Enroll Now</a>
                        <a href="" class="white_bg_btn">Free Trial Class</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================ Apply model =================-->
    <div class="modal fade" id="studentAdmissionModal" tabindex="-1" aria-labelledby="studentAdmissionModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-fullwidth">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="studentAdmissionModalLabel">
                        <i class="fa fa-user-plus me-2"></i>Student Admission Form
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body" style="max-height: 80vh; overflow-y: auto;">
                    <form id="studentAdmissionForm" method="POST" action="{{ route('frontend.apply') }}"
                        enctype="multipart/form-data">
                        @csrf
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
                                    <input type="text" class="form-control" id="father_name" name="father_name"
                                        required>
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
                                    <input type="text" class="form-control" id="cnic" name="cnic"
                                        placeholder="12345-6789012-3" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="date_of_birth" class="form-label required-field">Date of Birth</label>
                                    <input type="date" class="form-control" id="date_of_birth" name="date_of_birth"
                                        required>
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
                                    <input type="text" class="form-control" id="nationality" name="nationality"
                                        value="Pakistani" required>
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
                                    <label for="emergency_contact" class="form-label required-field">Emergency
                                        Contact</label>
                                    <input type="text" class="form-control" id="emergency_contact"
                                        name="emergency_contact" required>
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
                                    <input type="text" class="form-control" id="specialization"
                                        name="specialization">
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
                                            <input type="number" step="0.1" name="qualifications[0][duration_years]"
                                                class="form-control">
                                        </div>
                                        <div class="col-md-2 mb-2">
                                            <label class="form-label">Specialization</label>
                                            <input type="text" name="qualifications[0][specialization]"
                                                class="form-control">
                                        </div>
                                        <div class="col-md-2 mb-2">
                                            <label class="form-label">Passing Year</label>
                                            <input type="number" min="1950" max="2030"
                                                name="qualifications[0][passing_year]" class="form-control">
                                        </div>
                                        <div class="col-md-2 mb-2">
                                            <label class="form-label">CGPA/Grade</label>
                                            <input type="text" name="qualifications[0][cgpa_grade]"
                                                class="form-control">
                                        </div>
                                        <div class="col-md-2 mb-2">
                                            <label class="form-label">Institute/Board/University</label>
                                            <input type="text" name="qualifications[0][institute_board_university]"
                                                class="form-control">
                                        </div>
                                        <div class="col-md-12 mb-2">
                                            <label class="form-label">Country</label>
                                            <input type="text" name="qualifications[0][country]" class="form-control"
                                                value="Pakistan">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <a href="#" class="add-more-btn" onclick="addQualification(); return false;">
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
                                            <input type="text" name="experiences[0][institution_organization]"
                                                class="form-control">
                                        </div>
                                        <div class="col-md-3 mb-2">
                                            <label class="form-label">Position/Job Title</label>
                                            <input type="text" name="experiences[0][position_job_title]"
                                                class="form-control">
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
                                            <input type="number" name="experiences[0][total_period_months]"
                                                class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <a href="#" class="add-more-btn" onclick="addExperience(); return false;">
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
                            <a href="#" class="add-more-btn" onclick="addReference(); return false;">
                                <i class="fa fa-plus me-1"></i>Add Another Reference
                            </a>
                        </div>

                        <!-- Admission Details -->
                        <div class="mb-4">
                            <h4 class="section-header">Admission Details</h4>
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="admission_date" class="form-label required-field">Admission Date</label>
                                    <input type="date" class="form-control" id="admission_date" name="admission_date"
                                        required>
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
                                    <input type="file" class="form-control" id="photo" name="photo"
                                        accept="image/*">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-submit" onclick="submitStudentForm()">
                        <i class="fa fa-save me-2"></i>Submit Application
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
        // Initialize Swiper with proper settings to avoid half cards
        const swiper = new Swiper('.team-swiper', {
            // Basic settings - removed centeredSlides to avoid half cards
            slidesPerView: 1,
            spaceBetween: 30,
            centeredSlides: true, // This centers the active slide
            loop: true,

            // Autoplay
            autoplay: {
                delay: 3000,
                disableOnInteraction: false,
                pauseOnMouseEnter: true,
                reverseDirection: false, // Normal direction mein chalega
                waitForTransition: true, // Smooth transition ke liye

            },

            // Effects and speed
            effect: 'slide',
            speed: 900,

            // Navigation
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },

            // Pagination
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
                dynamicBullets: true,
            },

            // Responsive breakpoints - exact number of cards per view
            breakpoints: {
                480: {
                    slidesPerView: 1,
                    spaceBetween: 20,
                },
                640: {
                    slidesPerView: 2,
                    spaceBetween: 15,
                },
                768: {
                    slidesPerView: 3,
                    spaceBetween: 20,
                },
                1024: {
                    slidesPerView: 3, // Exactly 3 cards, no partial cards
                    spaceBetween: 20,
                },
                1200: {
                    slidesPerView: 3, // Keep it at 3 for larger screens too
                    spaceBetween: 25,
                }
            },

            // Keyboard control
            keyboard: {
                enabled: true,
                onlyInViewport: true,
            },

            // Grab cursor
            grabCursor: true,

            // Events
            on: {
                init: function() {
                    console.log('Swiper initialized - 3 cards per view');
                    // Add entrance animation
                    this.slides.forEach((slide, index) => {
                        slide.style.opacity = '0';
                        slide.style.transform = 'translateY(50px)';
                        setTimeout(() => {
                            slide.style.transition = 'all 0.6s ease';
                            slide.style.opacity = '1';
                            slide.style.transform = 'translateY(0)';
                        }, index * 100);
                    });
                },
                slideChange: function() {
                    // Add some animation on slide change
                    const activeSlide = this.slides[this.activeIndex];
                    if (activeSlide) {
                        const teamItem = activeSlide.querySelector('.team_item');
                        if (teamItem) {
                            teamItem.style.transform = 'scale(1.02)';
                            setTimeout(() => {
                                teamItem.style.transform = 'scale(1)';
                            }, 200);
                        }
                    }
                }
            }
        });

        // Pause autoplay on hover
        const swiperContainer = document.querySelector('.team-swiper');
        swiperContainer.addEventListener('mouseenter', () => {
            swiper.autoplay.stop();
        });

        swiperContainer.addEventListener('mouseleave', () => {
            swiper.autoplay.start();
        });

        // Add interactive effects
        document.querySelectorAll('.team_item').forEach(item => {
            item.addEventListener('mouseenter', function() {
                this.style.zIndex = '10';
            });

            item.addEventListener('mouseleave', function() {
                this.style.zIndex = '1';
            });
        });
    </script>
    {{-- Apply Script --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        let qualificationIndex = 1;
        let experienceIndex = 1;
        let referenceIndex = 1;

        // Submit Form Function
        function submitStudentForm() {
            const form = document.getElementById('studentAdmissionForm');

            // Validate form
            if (form.checkValidity()) {
                // Submit the form normally to Laravel
                form.submit();
            } else {
                // Show validation errors
                form.reportValidity();
            }
        }

        // Add Qualification Function
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
        }

        // Add Experience Function
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
        }

        // Add Reference Function
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

        // Auto-open modal if there are validation errors
        @if ($errors->any())
            document.addEventListener('DOMContentLoaded', function() {
                const modal = new bootstrap.Modal(document.getElementById('studentAdmissionModal'));
                modal.show();
            });
        @endif

        // Restore old qualification values if any
        @if (old('qualifications'))
            document.addEventListener('DOMContentLoaded', function() {
                @php
                    $oldQualifications = old('qualifications', []);
                    $count = count($oldQualifications);
                @endphp

                @if ($count > 1)
                    @for ($i = 1; $i < $count; $i++)
                        addQualification();

                        // Set values
                        @if (isset($oldQualifications[$i]))
                            const qualRow{{ $i }} = document.querySelectorAll('.qualification-row')[
                                {{ $i }}];
                            if (qualRow{{ $i }}) {
                                @foreach ($oldQualifications[$i] as $field => $value)
                                    @if ($value)
                                        const field{{ $i }}_{{ $field }} =
                                            qualRow{{ $i }}.querySelector(
                                                '[name="qualifications[{{ $i }}][{{ $field }}]"]'
                                            );
                                        if (field{{ $i }}_{{ $field }}) {
                                            field{{ $i }}_{{ $field }}.value =
                                                '{{ $value }}';
                                        }
                                    @endif
                                @endforeach
                            }
                        @endif
                    @endfor
                @endif
            });
        @endif

        // Restore old experience values if any
        @if (old('experiences'))
            document.addEventListener('DOMContentLoaded', function() {
                @php
                    $oldExperiences = old('experiences', []);
                    $count = count($oldExperiences);
                @endphp

                @if ($count > 1)
                    @for ($i = 1; $i < $count; $i++)
                        addExperience();

                        // Set values
                        @if (isset($oldExperiences[$i]))
                            const expRow{{ $i }} = document.querySelectorAll('.experience-row')[
                                {{ $i }}];
                            if (expRow{{ $i }}) {
                                @foreach ($oldExperiences[$i] as $field => $value)
                                    @if ($value)
                                        const expField{{ $i }}_{{ $field }} =
                                            expRow{{ $i }}.querySelector(
                                                '[name="experiences[{{ $i }}][{{ $field }}]"]');
                                        if (expField{{ $i }}_{{ $field }}) {
                                            expField{{ $i }}_{{ $field }}.value =
                                                '{{ $value }}';
                                        }
                                    @endif
                                @endforeach
                            }
                        @endif
                    @endfor
                @endif
            });
        @endif

        // Restore old reference values if any
        @if (old('references'))
            document.addEventListener('DOMContentLoaded', function() {
                @php
                    $oldReferences = old('references', []);
                    $count = count($oldReferences);
                @endphp

                @if ($count > 1)
                    @for ($i = 1; $i < $count; $i++)
                        addReference();

                        // Set values
                        @if (isset($oldReferences[$i]))
                            const refRow{{ $i }} = document.querySelectorAll('.reference-row')[
                                {{ $i }}];
                            if (refRow{{ $i }}) {
                                @foreach ($oldReferences[$i] as $field => $value)
                                    @if ($value)
                                        const refField{{ $i }}_{{ $field }} =
                                            refRow{{ $i }}.querySelector(
                                                '[name="references[{{ $i }}][{{ $field }}]"]');
                                        if (refField{{ $i }}_{{ $field }}) {
                                            refField{{ $i }}_{{ $field }}.value =
                                                '{{ $value }}';
                                        }
                                    @endif
                                @endforeach
                            }
                        @endif
                    @endfor
                @endif
            });
        @endif
    </script>
@endsection
