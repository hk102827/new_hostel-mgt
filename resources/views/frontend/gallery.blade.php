@extends('layouts.app')
@section('content')

    <!--================Breadcrumb Area =================-->
    <section class="breadcrumb_area">
        <div class="overlay bg-parallax" data-stellar-ratio="0.8" data-stellar-vertical-offset="0" data-background=""></div>
        <div class="container">
            <div class="page-cover text-center">
                <h2 class="page-cover-tittle">Photo Gallery</h2>
                <ol class="breadcrumb">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li class="active">Gallery</li>
                </ol>
            </div>
        </div>
    </section>
    <!--================Breadcrumb Area =================-->

    <!--================Gallery Filter Area =================-->
    <section class="gallery_area section_gap">
        <div class="container">
            <div class="section_title text-center">
                <h2 class="title_color">Our School & Hostel Life</h2>
                <p>Take a visual tour of our modern facilities, classroom environment, and comfortable hostel accommodation</p>
            </div>
            
            <!-- Filter Buttons -->
            <div class="gallery_filter">
                <ul class="list-unstyled d-flex justify-content-center flex-wrap">
                    <li class="filter-btn active" data-filter="all">All Photos</li>
                    <li class="filter-btn" data-filter="classroom">Classrooms</li>
                    <li class="filter-btn" data-filter="hostel">Hostel Facilities</li>
                    <li class="filter-btn" data-filter="activities">Student Activities</li>
                    <li class="filter-btn" data-filter="events">Events & Ceremonies</li>
                    <li class="filter-btn" data-filter="facilities">School Facilities</li>
                </ul>
            </div>

            <!-- Gallery Grid -->
            <div class="gallery_grid row">
                
                <!-- Classroom Images -->
                <div class="col-lg-4 col-md-6 mb-4 gallery_item classroom">
                    <div class="gallery_card">
                        <img src="{{ asset('assets/gallery/classroom-1.jpg') }}" alt="Modern Japanese Classroom" class="img-fluid">
                        <div class="gallery_overlay">
                            <div class="gallery_content">
                                <h4>Modern Classroom</h4>
                                <p>State-of-the-art Japanese language classroom with smart board</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 mb-4 gallery_item classroom">
                    <div class="gallery_card">
                        <img src="{{ asset('assets/gallery/classroom-2.jpg') }}" alt="Interactive Learning" class="img-fluid">
                        <div class="gallery_overlay">
                            <div class="gallery_content">
                                <h4>Interactive Learning</h4>
                                <p>Students practicing conversation with native Japanese teachers</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 mb-4 gallery_item classroom">
                    <div class="gallery_card">
                        <img src="{{ asset('assets/gallery/classroom-3.jpg') }}" alt="Group Study Session" class="img-fluid">
                        <div class="gallery_overlay">
                            <div class="gallery_content">
                                <h4>Group Study Session</h4>
                                <p>Collaborative learning environment for JLPT preparation</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Hostel Images -->
                <div class="col-lg-4 col-md-6 mb-4 gallery_item hostel">
                    <div class="gallery_card">
                        <img src="{{ asset('assets/gallery/hostel-room.jpg') }}" alt="Hostel Room" class="img-fluid">
                        <div class="gallery_overlay">
                            <div class="gallery_content">
                                <h4>Comfortable Hostel Rooms</h4>
                                <p>Clean and modern accommodation for out-of-city students</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 mb-4 gallery_item hostel">
                    <div class="gallery_card">
                        <img src="{{ asset('assets/gallery/hostel-dining.jpg') }}" alt="Dining Area" class="img-fluid">
                        <div class="gallery_overlay">
                            <div class="gallery_content">
                                <h4>Dining Hall</h4>
                                <p>Spacious dining area with healthy meals for students</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 mb-4 gallery_item hostel">
                    <div class="gallery_card">
                        <img src="{{ asset('assets/gallery/hostel-common.jpg') }}" alt="Common Area" class="img-fluid">
                        <div class="gallery_overlay">
                            <div class="gallery_content">
                                <h4>Common Area</h4>
                                <p>Relaxation and study space for hostel residents</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Student Activities -->
                <div class="col-lg-4 col-md-6 mb-4 gallery_item activities">
                    <div class="gallery_card">
                        <img src="{{ asset('assets/gallery/cultural-activity.jpg') }}" alt="Cultural Activity" class="img-fluid">
                        <div class="gallery_overlay">
                            <div class="gallery_content">
                                <h4>Japanese Cultural Workshop</h4>
                                <p>Students learning traditional Japanese arts and culture</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 mb-4 gallery_item activities">
                    <div class="gallery_card">
                        <img src="{{ asset('assets/gallery/speaking-practice.jpg') }}" alt="Speaking Practice" class="img-fluid">
                        <div class="gallery_overlay">
                            <div class="gallery_content">
                                <h4>Speaking Practice Session</h4>
                                <p>Interactive conversation practice with fellow students</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 mb-4 gallery_item activities">
                    <div class="gallery_card">
                        <img src="{{ asset('assets/gallery/study-group.jpg') }}" alt="Study Group" class="img-fluid">
                        <div class="gallery_overlay">
                            <div class="gallery_content">
                                <h4>Evening Study Groups</h4>
                                <p>Collaborative learning and exam preparation sessions</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Events & Ceremonies -->
                <div class="col-lg-4 col-md-6 mb-4 gallery_item events">
                    <div class="gallery_card">
                        <img src="{{ asset('assets/gallery/graduation.jpg') }}" alt="Graduation Ceremony" class="img-fluid">
                        <div class="gallery_overlay">
                            <div class="gallery_content">
                                <h4>Graduation Ceremony</h4>
                                <p>Celebrating successful completion of Japanese language program</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 mb-4 gallery_item events">
                    <div class="gallery_card">
                        <img src="{{ asset('assets/gallery/jlpt-result.jpg') }}" alt="JLPT Success" class="img-fluid">
                        <div class="gallery_overlay">
                            <div class="gallery_content">
                                <h4>JLPT Success Celebration</h4>
                                <p>Students celebrating their JLPT exam achievements</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 mb-4 gallery_item events">
                    <div class="gallery_card">
                        <img src="{{ asset('assets/gallery/farewell-party.jpg') }}" alt="Farewell Party" class="img-fluid">
                        <div class="gallery_overlay">
                            <div class="gallery_content">
                                <h4>Farewell Party</h4>
                                <p>Sending off students to Japan with warm wishes</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- School Facilities -->
                <div class="col-lg-4 col-md-6 mb-4 gallery_item facilities">
                    <div class="gallery_card">
                        <img src="{{ asset('assets/gallery/library.jpg') }}" alt="Library" class="img-fluid">
                        <div class="gallery_overlay">
                            <div class="gallery_content">
                                <h4>Japanese Language Library</h4>
                                <p>Extensive collection of Japanese books and study materials</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 mb-4 gallery_item facilities">
                    <div class="gallery_card">
                        <img src="{{ asset('assets/gallery/computer-lab.jpg') }}" alt="Computer Lab" class="img-fluid">
                        <div class="gallery_overlay">
                            <div class="gallery_content">
                                <h4>Computer Lab</h4>
                                <p>Digital learning resources and online practice sessions</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 mb-4 gallery_item facilities">
                    <div class="gallery_card">
                        <img src="{{ asset('assets/gallery/reception.jpg') }}" alt="Reception Area" class="img-fluid">
                        <div class="gallery_overlay">
                            <div class="gallery_content">
                                <h4>Reception & Welcome Area</h4>
                                <p>Modern reception area with friendly staff assistance</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!--================Gallery Filter Area =================-->

    <!--================Hostel Information Area =================-->
    <section class="hostel_info_area section_gap" style="background-color: #f8f9fa;">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="hostel_content">
                        <h2 class="title_color">Comfortable Hostel Accommodation</h2>
                        <p>
                            We understand that learning Japanese requires dedication and focus. That's why we provide 
                            comfortable hostel facilities for out-of-city students, creating a home-away-from-home 
                            environment that supports your learning journey.
                        </p>
                        <div class="hostel_features mt-4">
                            <div class="feature_item d-flex align-items-center mb-3">
                                <i class="fa fa-bed text-primary mr-3"></i>
                                <span>Clean and furnished rooms with modern amenities</span>
                            </div>
                            <div class="feature_item d-flex align-items-center mb-3">
                                <i class="fa fa-wifi text-primary mr-3"></i>
                                <span>Free Wi-Fi for online study and research</span>
                            </div>
                            <div class="feature_item d-flex align-items-center mb-3">
                                <i class="fa fa-utensils text-primary mr-3"></i>
                                <span>Healthy meals and dining facilities</span>
                            </div>
                            <div class="feature_item d-flex align-items-center mb-3">
                                <i class="fa fa-book text-primary mr-3"></i>
                                <span>Quiet study areas and common rooms</span>
                            </div>
                            <div class="feature_item d-flex align-items-center mb-3">
                                <i class="fa fa-shield-alt text-primary mr-3"></i>
                                <span>24/7 security and safe environment</span>
                            </div>
                        </div>
                        <a href="{{ url('/contact') }}" class="button_hover theme_btn_two mt-4">Inquire About Hostel</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="hostel_image_grid">
                        <div class="row">
                            <div class="col-6 mb-3">
                                <img src="{{ asset('assets/gallery/hostel-exterior.jpg') }}" alt="Hostel Building" class="img-fluid rounded shadow">
                            </div>
                            <div class="col-6 mb-3">
                                <img src="{{ asset('assets/gallery/hostel-kitchen.jpg') }}" alt="Kitchen Area" class="img-fluid rounded shadow">
                            </div>
                            <div class="col-6 mb-3">
                                <img src="{{ asset('assets/gallery/hostel-study.jpg') }}" alt="Study Area" class="img-fluid rounded shadow">
                            </div>
                            <div class="col-6 mb-3">
                                <img src="{{ asset('assets/gallery/hostel-security.jpg') }}" alt="Security" class="img-fluid rounded shadow">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================Hostel Information Area =================-->

    <style>
    .gallery_filter ul {
        margin-bottom: 50px;
    }
    
    .filter-btn {
        background: #f8f9fa;
        border: 2px solid #dee2e6;
        padding: 10px 20px;
        margin: 5px;
        cursor: pointer;
        border-radius: 25px;
        transition: all 0.3s ease;
        font-weight: 500;
    }
    
    .filter-btn:hover,
    .filter-btn.active {
        background: #007bff;
        color: white;
        border-color: #007bff;
    }
    
    .gallery_card {
        position: relative;
        overflow: hidden;
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        transition: transform 0.3s ease;
    }
    
    .gallery_card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.2);
    }
    
    .gallery_card img {
        width: 100%;
        height: 250px;
        object-fit: cover;
        transition: transform 0.3s ease;
    }
    
    .gallery_overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(45deg, rgba(0,123,255,0.9), rgba(0,86,179,0.9));
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    
    .gallery_card:hover .gallery_overlay {
        opacity: 1;
    }
    
    .gallery_card:hover img {
        transform: scale(1.1);
    }
    
    .gallery_content {
        text-align: center;
        color: white;
        padding: 20px;
    }
    
    .gallery_content h4 {
        margin-bottom: 10px;
        font-size: 1.2rem;
        font-weight: bold;
    }
    
    .gallery_content p {
        font-size: 0.9rem;
        opacity: 0.9;
    }
    
    .gallery_item {
        transition: all 0.5s ease;
    }
    
    .gallery_item.hide {
        opacity: 0;
        transform: scale(0.8);
        pointer-events: none;
        margin: 0;
        width: 0;
        height: 0;
        overflow: hidden;
    }
    
    .hostel_features .feature_item i {
        font-size: 1.2rem;
        width: 30px;
    }
    
    .hostel_image_grid img {
        height: 120px;
        object-fit: cover;
        width: 100%;
    }
    </style>

    <script>
    // Gallery Filter Functionality
    document.addEventListener('DOMContentLoaded', function() {
        const filterBtns = document.querySelectorAll('.filter-btn');
        const galleryItems = document.querySelectorAll('.gallery_item');
        
        filterBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                // Remove active class from all buttons
                filterBtns.forEach(b => b.classList.remove('active'));
                // Add active class to clicked button
                this.classList.add('active');
                
                const filterValue = this.getAttribute('data-filter');
                
                galleryItems.forEach(item => {
                    if (filterValue === 'all') {
                        item.classList.remove('hide');
                    } else {
                        if (item.classList.contains(filterValue)) {
                            item.classList.remove('hide');
                        } else {
                            item.classList.add('hide');
                        }
                    }
                });
            });
        });
    });
    </script>

@endsection