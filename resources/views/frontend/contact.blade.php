@extends('layouts.app')
@section('content')
    <!--================Breadcrumb Area =================-->
 <section class="breadcrumb_area">
    <div class="overlay bg-parallax"></div>
    <div class="container">
        <div class="page-cover text-center">
            <h2 class="page-cover-tittle">Contact Us</h2>
            <ol class="breadcrumb">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li class="active">Contact Us</li>
            </ol>
        </div>
    </div>
</section>

    <!--================Breadcrumb Area =================-->

    <!--================Contact Info Header =================-->
    <section class="contact_header section_gap_top">
        <div class="container">
            <div class="section_title text-center mt-5">
                <h2 class="title_color">Get in Touch with Us</h2>
                <p>Ready to start your Japanese learning journey? We're here to help you every step of the way.</p>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="contact_info_card">
                        <div class="info_icon">
                            <i class="lnr lnr-map-marker"></i>
                        </div>
                        <div class="info_content">
                            <h5>Visit Our Campus</h5>
                            <p>Tokyo Japanese School<br>
                                Main Campus: Ghori Garden Street # 18,19<br>
                                Rawalpindi, Punjab, Pakistan</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="contact_info_card">
                        <div class="info_icon">
                            <i class="lnr lnr-phone-handset"></i>
                        </div>
                        <div class="info_content">
                            <h5>Call Us Now</h5>
                            <p><a href="tel:+92511234567">+92 51 123-4567</a><br>
                                <a href="tel:+923001234567">+92 300 123-4567</a><br>
                                <small>Mon to Sat: 9:00 AM - 6:00 PM</small>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="contact_info_card">
                        <div class="info_icon">
                            <i class="lnr lnr-envelope"></i>
                        </div>
                        <div class="info_content">
                            <h5>Email Us</h5>
                            <p><a href="mailto:info@tokyojapanese.pk">info@tokyojapanese.pk</a><br>
                                <a href="mailto:admissions@tokyojapanese.pk">admissions@tokyojapanese.pk</a><br>
                                <small>Quick response guaranteed!</small>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================Contact Info Header =================-->

    <!--================Contact Form Area =================-->
    <section class="contact_area section_gap">
        <div class="container">
            <div class="row">
                <!-- Contact Form -->
                <div class="col-lg-8">
                    <div class="contact_form_container">
                        <h3 class="form_title">Send Us a Message</h3>
                        <p class="form_subtitle">Fill out the form below and we'll get back to you within 24 hours.</p>

                        <form class="contact_form" action="" method="post" id="contactForm">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Full Name *</label>
                                        <input type="text" class="form-control" id="name" name="name"
                                            placeholder="Enter your full name" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email Address *</label>
                                        <input type="email" class="form-control" id="email" name="email"
                                            placeholder="Enter your email address" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phone">Phone Number *</label>
                                        <input type="tel" class="form-control" id="phone" name="phone"
                                            placeholder="+92 300 1234567" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="city">City</label>
                                        <input type="text" class="form-control" id="city" name="city"
                                            placeholder="Your city">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="interest">I'm Interested In</label>
                                        <select class="form-control" id="interest" name="interest">
                                            <option value="">Select your interest</option>
                                            <option value="beginner-course">Beginner Japanese Course (N5-N4)</option>
                                            <option value="intermediate-course">Intermediate Course (N3-N2)</option>
                                            <option value="advanced-course">Advanced Course (N1)</option>
                                            <option value="jlpt-preparation">JLPT Exam Preparation</option>
                                            <option value="business-japanese">Business Japanese</option>
                                            <option value="conversation-class">Conversation Classes</option>
                                            <option value="hostel-facility">Hostel Accommodation</option>
                                            <option value="job-assistance">Job Placement Assistance</option>
                                            <option value="other">Other</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="experience">Japanese Learning Experience</label>
                                        <select class="form-control" id="experience" name="experience">
                                            <option value="">Select your level</option>
                                            <option value="complete-beginner">Complete Beginner</option>
                                            <option value="some-knowledge">Some Basic Knowledge</option>
                                            <option value="intermediate">Intermediate Level</option>
                                            <option value="advanced">Advanced Level</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="message">Message</label>
                                        <textarea class="form-control" name="message" id="message" rows="5"
                                            placeholder="Tell us more about your Japanese learning goals, preferred schedule, or any questions you have..."></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="checkbox" id="newsletter"
                                            name="newsletter" value="1">
                                        <label class="form-check-label" for="newsletter">
                                            Subscribe to our newsletter for Japanese learning tips and updates
                                        </label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn theme_btn button_hover">
                                        <i class="fa fa-paper-plane mr-2"></i>Send Message
                                    </button>
                                    <button type="button" class="btn btn-outline-secondary ml-3"
                                        onclick="requestCallback()">
                                        <i class="fa fa-phone mr-2"></i>Request Callback
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Additional Contact Information -->
                <div class="col-lg-4">
                    <div class="contact_sidebar">

                        <!-- Quick Contact -->
                        <div class="contact_widget">
                            <h4>Quick Contact</h4>
                            <div class="quick_contact_info">
                                <div class="contact_item">
                                    <i class="fa fa-whatsapp"></i>
                                    <div class="contact_details">
                                        <h6>WhatsApp</h6>
                                        <a href="https://wa.me/923001234567">+92 300 123-4567</a>
                                    </div>
                                </div>
                                <div class="contact_item">
                                    <i class="fa fa-facebook"></i>
                                    <div class="contact_details">
                                        <h6>Facebook</h6>
                                        <a href="#">Tokyo Japanese School</a>
                                    </div>
                                </div>
                                <div class="contact_item">
                                    <i class="fa fa-instagram"></i>
                                    <div class="contact_details">
                                        <h6>Instagram</h6>
                                        <a href="#">@tokyojapanese_pk</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Office Hours -->
                        <div class="contact_widget">
                            <h4>Office Hours</h4>
                            <div class="office_hours">
                                <div class="hour_item">
                                    <span class="day">Monday - Friday</span>
                                    <div class="times">
                                        <span class="time">10:00 AM - 01:00 PM</span>
                                        <span class="time">09:00 PM - 11:00 PM</span>
                                    </div>
                                </div>
                                <div class="hour_item">
                                    <span class="day">Saturday</span>
                                    <div class="times">
                                        <span class="time">09:00 PM - 11:00 PM</span>
                                    </div>
                                </div>
                                <div class="hour_item">
                                    <span class="day">Sunday</span>
                                    <div class="times">
                                        <span class="time">Closed</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================Contact Form Area =================-->

    <!--================Map Area =================-->
    <section class="map_area mb-5">
        <div class="container-fluid p-0">
            <div class="map_container">
                <div id="mapBox" class="mapBox" data-lat="33.5951" data-lon="73.0169" data-zoom="15"
                    data-info="Tokyo Japanese School, Ghori Garden, Street No. 18-19, Rawalpindi, Punjab, Pakistan"
                    data-mlat="33.5951" data-mlon="73.0169">
                </div>
            </div>
        </div>
    </section>

    <!--================Directions & Transportation =================-->

    <style>
        .contact_header {
            background-color: #f8f9fa;
        }

        .contact_info_card {
            background: white;
            padding: 30px 25px;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            height: 100%;
        }

        .contact_info_card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        }

        .info_icon {
            background: linear-gradient(135deg, #f3c300, #f3c300);
            color: white;
            width: 80px;
            height: 80px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 2rem;
        }

        .info_content h5 {
            color: #333;
            margin-bottom: 15px;
            font-weight: 600;
        }

        .info_content p {
            color: #666;
            line-height: 1.6;
            margin-bottom: 0;
        }

        .info_content a {
            color: #f3c300;
            text-decoration: none;
            font-weight: 500;
        }

        .info_content a:hover {
            text-decoration: underline;
        }

        .contact_form_container {
            background: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        }

        .form_title {
            color: #333;
            margin-bottom: 10px;
            font-weight: 600;
        }

        .form_subtitle {
            color: #666;
            margin-bottom: 30px;
        }

        .form-group label {
            color: #333;
            font-weight: 500;
            margin-bottom: 8px;
        }

        .form-control {
            border: 2px solid #e9ecef;
            border-radius: 8px;
            padding: 12px 15px;
            transition: border-color 0.3s ease;
        }

        .form-control:focus {
            border-color: #f3c300;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        }

        .contact_sidebar {
            padding-left: 20px;
        }

        .contact_widget {
            background: white;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            margin-bottom: 25px;
        }

        .contact_widget h4 {
            color: #333;
            margin-bottom: 20px;
            font-weight: 600;
            border-bottom: 2px solid #f3c300;
            padding-bottom: 10px;
        }

        .contact_item {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
            padding: 10px 0;
        }

        .contact_item:last-child {
            margin-bottom: 0;
        }

        .contact_item i {
            width: 40px;
            height: 40px;
            background: #f3c300;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            font-size: 1.1rem;
        }

        .contact_details h6 {
            margin-bottom: 5px;
            color: #333;
            font-weight: 500;
        }

        .contact_details a {
            color: #666;
            text-decoration: none;
            font-size: 14px;
        }

        .contact_details a:hover {
            color: #007bff;
        }

        .hour_item {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            padding: 8px 0;
            border-bottom: 1px solid #eee;
        }

        .hour_item:last-child {
            border-bottom: none;
        }

        .hour_item .day {
            color: #333;
            font-weight: 500;
            flex: 1;
            font-weight: 600;
        }

        .hour_item .time {
            color: #666;
            font-size: 14px;
            flex: 1.5;
            text-align: right;
        }

        .hour_item .times .time {
            display: block;
            /* ek ke neeche ek */
        }

        .faq_link {
            display: block;
            padding: 10px 0;
            color: #666;
            text-decoration: none;
            border-bottom: 1px solid #eee;
            transition: color 0.3s ease;
        }

        .faq_link:hover {
            color: #f3c300;
            text-decoration: none;
        }

        .faq_link:last-child {
            border-bottom: none;
        }

        .download_widget {
            background: linear-gradient(135deg, #f3c300, #f3c300) !important;
            color: white;
        }

        .download_widget h4 {
            color: white;
            border-bottom-color: rgba(255, 255, 255, 0.3);
        }

        .download_widget p {
            color: rgba(255, 255, 255, 0.9);
            margin-bottom: 20px;
        }

        .map_container {
            height: 400px;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        }

        #mapBox {
            height: 100%;
            width: 100%;
        }

        .directions_content,
        .nearby_landmarks {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            height: 100%;
        }

        .direction_item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 25px;
            padding: 15px;
            background: #f8f9fa;
            border-radius: 10px;
        }

        .direction_item:last-child {
            margin-bottom: 0;
        }

        .direction_item i {
            width: 50px;
            height: 50px;
            background: #f3c300;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            flex-shrink: 0;
            font-size: 1.2rem;
        }

        .direction_details h5 {
            color: #333;
            margin-bottom: 8px;
            font-weight: 600;
        }

        .direction_details p {
            color: #666;
            line-height: 1.6;
            margin-bottom: 0;
        }

        .landmark_item {
            display: flex;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px solid #eee;
        }

        .landmark_item:last-child {
            border-bottom: none;
        }

        .landmark_item i {
            margin-right: 12px;
            font-size: 1.1rem;
        }

        .landmark_item span {
            color: #333;
            font-weight: 500;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .contact_sidebar {
                padding-left: 0;
                margin-top: 30px;
            }

            .contact_form_container {
                padding: 25px;
            }

            .directions_content,
            .nearby_landmarks {
                margin-bottom: 20px;
            }
        }
    </style>

    <script>
        // Form validation and submission
        document.getElementById('contactForm').addEventListener('submit', function(e) {
            e.preventDefault();

            // Basic validation
            const name = document.getElementById('name').value.trim();
            const email = document.getElementById('email').value.trim();
            const phone = document.getElementById('phone').value.trim();

            if (!name || !email || !phone) {
                alert('Please fill in all required fields (Name, Email, Phone).');
                return;
            }

            // Email validation
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                alert('Please enter a valid email address.');
                return;
            }

            // Phone validation (basic)
            const phoneRegex = /^[\+]?[\s\-\(\)]*([0-9][\s\-\(\)]*){10,}$/;
            if (!phoneRegex.test(phone)) {
                alert('Please enter a valid phone number.');
                return;
            }

            // If validation passes, submit the form
            alert('Thank you for your message! We will get back to you within 24 hours.');

            // Here you would normally submit the form data to the server
            // For demo purposes, we'll just reset the form
            this.reset();
        });

        // Request callback function
        function requestCallback() {
            const phone = document.getElementById('phone').value.trim();
            const name = document.getElementById('name').value.trim();

            if (!phone || !name) {
                alert('Please enter your name and phone number for callback request.');
                return;
            }

            alert(`Thank you ${name}! We will call you back at ${phone} within 2 hours during office hours.`);
        }

        // Initialize Google Maps (Ghori Garden, Rawalpindi location)
        function initMap() {
            const schoolLocation = {
                lat: 33.6151,
                lng: 73.0724
            };
            const map = new google.maps.Map(document.getElementById('mapBox'), {
                zoom: 16,
                center: schoolLocation,
                mapTypeId: 'roadmap'
            });

            const marker = new google.maps.Marker({
                position: schoolLocation,
                map: map,
                title: 'Tokyo Japanese School - Ghori Garden',
                animation: google.maps.Animation.BOUNCE
            });

            // Stop animation after 3 seconds
            setTimeout(() => {
                marker.setAnimation(null);
            }, 3000);

            const infoWindow = new google.maps.InfoWindow({
                content: `
                <div style="padding: 10px;">
                    <h4 style="color: #007bff; margin-bottom: 8px;">Tokyo Japanese School</h4>
                    <p style="margin-bottom: 5px;"><strong>Address:</strong> Street No. 18-19, Ghori Garden</p>
                    <p style="margin-bottom: 5px;"><strong>City:</strong> Rawalpindi, Punjab, Pakistan</p>
                    <p style="margin-bottom: 5px;"><strong>Phone:</strong> +92 51 123-4567</p>
                    <p style="margin-bottom: 0;"><strong>Email:</strong> info@tokyojapanese.pk</p>
                </div>
            `,
            });

            // Show info window by default
            infoWindow.open(map, marker);

            marker.addListener('click', function() {
                infoWindow.open(map, marker);
            });
        }
    </script>

    <!--Google Maps API-->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjCGmQ0Uq4exrzdcL6rvxywDDOvfAu6eE&callback=initMap"
        defer></script>
@endsection
