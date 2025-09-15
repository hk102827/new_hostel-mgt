@extends('layouts.app')
@section('content')

    <!--================Breadcrumb Area =================-->
    <section class="breadcrumb_area">
        <div class="overlay bg-parallax" data-stellar-ratio="0.8" data-stellar-vertical-offset="0" data-background=""></div>
        <div class="container">
            <div class="page-cover text-center">
                <h2 class="page-cover-tittle">Japanese Learning Blog</h2>
                <ol class="breadcrumb">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li class="active">Blog</li>
                </ol>
            </div>
        </div>
    </section>
    <!--================Breadcrumb Area =================-->

    <!--================Blog Categories Area =================-->
    <section class="blog_categories section_gap_top">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="blog_category_filter mb-4 mt-4">
                        <h4>Browse by Category:</h4>
                        <div class="category_buttons">
                            <button class="category_btn active" data-category="all">All Posts</button>
                            <button class="category_btn" data-category="tips">Learning Tips</button>
                            <button class="category_btn" data-category="culture">Japanese Culture</button>
                            <button class="category_btn" data-category="jlpt">JLPT Preparation</button>
                            <button class="category_btn" data-category="grammar">Grammar Guide</button>
                            <button class="category_btn" data-category="vocabulary">Vocabulary</button>
                        </div>
                    </div>
                </div>
         
            </div>
        </div>
    </section>
    <!--================Blog Categories Area =================-->

    <!--================Blog Posts Area =================-->
    <section class="blog_area section_gap">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="blog_posts">
                        
                        <!-- Blog Post 1 -->
                        <article class="blog_post tips" data-date="2024-03-15">
                            <div class="blog_post_img">
                                <img src="{{ asset('assets/blog/japanese-study-tips.jpg') }}" alt="Japanese Study Tips" class="img-fluid">
                                <div class="blog_date">
                                    <span class="day">15</span>
                                    <span class="month">Mar</span>
                                </div>
                            </div>
                            <div class="blog_post_content">
                                <div class="blog_meta">
                                    <span class="category tips">Learning Tips</span>
                                    <span class="author">By Sensei Yamada</span>
                                    <span class="read_time">5 min read</span>
                                </div>
                                <h3><a href="{{ url('/blog/effective-japanese-study-methods') }}">10 Effective Japanese Study Methods That Actually Work</a></h3>
                                <p>
                                    Learning Japanese can be challenging, but with the right study methods, you can make significant progress. 
                                    Here are 10 proven techniques that our successful students use to master the Japanese language faster...
                                </p>
                                <div class="blog_tags">
                                    <span class="tag">#StudyTips</span>
                                    <span class="tag">#Japanese</span>
                                    <span class="tag">#Learning</span>
                                </div>
                                <a href="{{ url('/blog/effective-japanese-study-methods') }}" class="read_more_btn">Read More <i class="fa fa-arrow-right"></i></a>
                            </div>
                        </article>

                        <!-- Blog Post 2 -->
                        <article class="blog_post culture" data-date="2024-03-12">
                            <div class="blog_post_img">
                                <img src="{{ asset('assets/blog/japanese-culture.jpg') }}" alt="Japanese Culture" class="img-fluid">
                                <div class="blog_date">
                                    <span class="day">12</span>
                                    <span class="month">Mar</span>
                                </div>
                            </div>
                            <div class="blog_post_content">
                                <div class="blog_meta">
                                    <span class="category culture">Japanese Culture</span>
                                    <span class="author">By Tanaka Sensei</span>
                                    <span class="read_time">7 min read</span>
                                </div>
                                <h3><a href="{{ url('/blog/understanding-japanese-business-culture') }}">Understanding Japanese Business Culture for Career Success</a></h3>
                                <p>
                                    Working in Japan requires more than just language skills. Understanding Japanese business culture, 
                                    etiquette, and workplace norms is crucial for career success. Learn the essential cultural aspects...
                                </p>
                                <div class="blog_tags">
                                    <span class="tag">#BusinessCulture</span>
                                    <span class="tag">#WorkInJapan</span>
                                    <span class="tag">#Cultural Tips</span>
                                </div>
                                <a href="{{ url('/blog/understanding-japanese-business-culture') }}" class="read_more_btn">Read More <i class="fa fa-arrow-right"></i></a>
                            </div>
                        </article>

                        <!-- Blog Post 3 -->
                        <article class="blog_post jlpt" data-date="2024-03-10">
                            <div class="blog_post_img">
                                <img src="{{ asset('assets/blog/jlpt-preparation.jpg') }}" alt="JLPT Preparation" class="img-fluid">
                                <div class="blog_date">
                                    <span class="day">10</span>
                                    <span class="month">Mar</span>
                                </div>
                            </div>
                            <div class="blog_post_content">
                                <div class="blog_meta">
                                    <span class="category jlpt">JLPT Preparation</span>
                                    <span class="author">By Ahmad Ali</span>
                                    <span class="read_time">8 min read</span>
                                </div>
                                <h3><a href="{{ url('/blog/jlpt-n2-preparation-guide') }}">Complete JLPT N2 Preparation Guide: Tips from Successful Students</a></h3>
                                <p>
                                    JLPT N2 is a crucial milestone for anyone serious about working in Japan. Our alumni share their 
                                    proven strategies, study schedules, and resources that helped them pass N2 on their first attempt...
                                </p>
                                <div class="blog_tags">
                                    <span class="tag">#JLPT</span>
                                    <span class="tag">#N2</span>
                                    <span class="tag">#ExamPrep</span>
                                </div>
                                <a href="{{ url('/blog/jlpt-n2-preparation-guide') }}" class="read_more_btn">Read More <i class="fa fa-arrow-right"></i></a>
                            </div>
                        </article>

                        <!-- Blog Post 4 -->
                        <article class="blog_post grammar" data-date="2024-03-08">
                            <div class="blog_post_img">
                                <img src="{{ asset('assets/blog/japanese-grammar.jpg') }}" alt="Japanese Grammar" class="img-fluid">
                                <div class="blog_date">
                                    <span class="day">08</span>
                                    <span class="month">Mar</span>
                                </div>
                            </div>
                            <div class="blog_post_content">
                                <div class="blog_meta">
                                    <span class="category grammar">Grammar Guide</span>
                                    <span class="author">By Sato Sensei</span>
                                    <span class="read_time">6 min read</span>
                                </div>
                                <h3><a href="{{ url('/blog/mastering-japanese-particles') }}">Mastering Japanese Particles: は, が, を, に, で, と</a></h3>
                                <p>
                                    Japanese particles are often the most challenging aspect for beginners. This comprehensive guide 
                                    breaks down the usage of essential particles with clear examples and practice exercises...
                                </p>
                                <div class="blog_tags">
                                    <span class="tag">#Grammar</span>
                                    <span class="tag">#Particles</span>
                                    <span class="tag">#Beginner</span>
                                </div>
                                <a href="{{ url('/blog/mastering-japanese-particles') }}" class="read_more_btn">Read More <i class="fa fa-arrow-right"></i></a>
                            </div>
                        </article>

                        <!-- Blog Post 5 -->
                        <article class="blog_post vocabulary" data-date="2024-03-05">
                            <div class="blog_post_img">
                                <img src="{{ asset('assets/blog/kanji-learning.jpg') }}" alt="Kanji Learning" class="img-fluid">
                                <div class="blog_date">
                                    <span class="day">05</span>
                                    <span class="month">Mar</span>
                                </div>
                            </div>
                            <div class="blog_post_content">
                                <div class="blog_meta">
                                    <span class="category vocabulary">Vocabulary</span>
                                    <span class="author">By Ayesha Khan</span>
                                    <span class="read_time">10 min read</span>
                                </div>
                                <h3><a href="{{ url('/blog/kanji-learning-techniques') }}">Smart Kanji Learning Techniques: From Beginner to Advanced</a></h3>
                                <p>
                                    Learning Kanji doesn't have to be overwhelming. Discover effective memory techniques, stroke order 
                                    importance, and digital tools that make Kanji learning enjoyable and efficient...
                                </p>
                                <div class="blog_tags">
                                    <span class="tag">#Kanji</span>
                                    <span class="tag">#Vocabulary</span>
                                    <span class="tag">#Memory</span>
                                </div>
                                <a href="{{ url('/blog/kanji-learning-techniques') }}" class="read_more_btn">Read More <i class="fa fa-arrow-right"></i></a>
                            </div>
                        </article>

                        <!-- Blog Post 6 -->
                        <article class="blog_post tips" data-date="2024-03-02">
                            <div class="blog_post_img">
                                <img src="{{ asset('assets/blog/hostel-life.jpg') }}" alt="Student Life" class="img-fluid">
                                <div class="blog_date">
                                    <span class="day">02</span>
                                    <span class="month">Mar</span>
                                </div>
                            </div>
                            <div class="blog_post_content">
                                <div class="blog_meta">
                                    <span class="category tips">Learning Tips</span>
                                    <span class="author">By Maria Khan</span>
                                    <span class="read_time">5 min read</span>
                                </div>
                                <h3><a href="{{ url('/blog/hostel-life-japanese-learning') }}">How Our Hostel Environment Enhances Japanese Learning</a></h3>
                                <p>
                                    Living in our hostel facility provides unique advantages for Japanese language learners. 
                                    From study groups to cultural immersion activities, discover how communal living accelerates 
                                    your Japanese learning journey...
                                </p>
                                <div class="blog_tags">
                                    <span class="tag">#HostelLife</span>
                                    <span class="tag">#StudentLife</span>
                                    <span class="tag">#CommunityLearning</span>
                                </div>
                                <a href="{{ url('/blog/hostel-life-japanese-learning') }}" class="read_more_btn">Read More <i class="fa fa-arrow-right"></i></a>
                            </div>
                        </article>

                    </div>

                    <!-- Pagination -->
                    <nav aria-label="Blog pagination" class="mt-5">
                        <ul class="pagination justify-content-center">
                            <li class="page-item disabled">
                                <a class="page-link" href="#" tabindex="-1">Previous</a>
                            </li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#">Next</a>
                            </li>
                        </ul>
                    </nav>

                </div>

                <!-- Sidebar -->
                <div class="col-lg-4">
                    <div class="blog_sidebar">
                        
                        <!-- Recent Posts Widget -->
                        <div class="sidebar_widget">
                            <h4 class="widget_title">Recent Posts</h4>
                            <div class="recent_posts">
                                <div class="recent_post_item d-flex">
                                    <div class="recent_post_img">
                                        <img src="{{ asset('assets/blog/recent-1.jpg') }}" alt="Recent Post" class="img-fluid">
                                    </div>
                                    <div class="recent_post_content">
                                        <h6><a href="#">Japanese Honorific Language: Keigo Mastery</a></h6>
                                        <span class="post_date">March 18, 2024</span>
                                    </div>
                                </div>
                                <div class="recent_post_item d-flex">
                                    <div class="recent_post_img">
                                        <img src="{{ asset('assets/blog/recent-2.jpg') }}" alt="Recent Post" class="img-fluid">
                                    </div>
                                    <div class="recent_post_content">
                                        <h6><a href="#">Student Success: From N5 to N1 in 18 Months</a></h6>
                                        <span class="post_date">March 16, 2024</span>
                                    </div>
                                </div>
                                <div class="recent_post_item d-flex">
                                    <div class="recent_post_img">
                                        <img src="{{ asset('assets/blog/recent-3.jpg') }}" alt="Recent Post" class="img-fluid">
                                    </div>
                                    <div class="recent_post_content">
                                        <h6><a href="#">Top 5 Japanese Language Apps We Recommend</a></h6>
                                        <span class="post_date">March 14, 2024</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Categories Widget -->
                        <div class="sidebar_widget">
                            <h4 class="widget_title">Categories</h4>
                            <div class="categories_list">
                                <a href="#" class="category_link" data-category="tips">
                                    <span>Learning Tips</span>
                                    <span class="post_count">(12)</span>
                                </a>
                                <a href="#" class="category_link" data-category="culture">
                                    <span>Japanese Culture</span>
                                    <span class="post_count">(8)</span>
                                </a>
                                <a href="#" class="category_link" data-category="jlpt">
                                    <span>JLPT Preparation</span>
                                    <span class="post_count">(15)</span>
                                </a>
                                <a href="#" class="category_link" data-category="grammar">
                                    <span>Grammar Guide</span>
                                    <span class="post_count">(10)</span>
                                </a>
                                <a href="#" class="category_link" data-category="vocabulary">
                                    <span>Vocabulary</span>
                                    <span class="post_count">(7)</span>
                                </a>
                            </div>
                        </div>

                        <!-- Popular Tags Widget -->
                        <div class="sidebar_widget">
                            <h4 class="widget_title">Popular Tags</h4>
                            <div class="tags_cloud">
                                <a href="#" class="tag_item">#Japanese</a>
                                <a href="#" class="tag_item">#JLPT</a>
                                <a href="#" class="tag_item">#Grammar</a>
                                <a href="#" class="tag_item">#Kanji</a>
                                <a href="#" class="tag_item">#StudyTips</a>
                                <a href="#" class="tag_item">#Culture</a>
                                <a href="#" class="tag_item">#BusinessJapanese</a>
                                <a href="#" class="tag_item">#N2</a>
                                <a href="#" class="tag_item">#N1</a>
                                <a href="#" class="tag_item">#Vocabulary</a>
                                <a href="#" class="tag_item">#Speaking</a>
                                <a href="#" class="tag_item">#Listening</a>
                            </div>
                        </div>

                        <!-- Newsletter Widget -->
                        <div class="sidebar_widget newsletter_widget">
                            <h4 class="widget_title">Get Learning Tips</h4>
                            <p>Subscribe to receive weekly Japanese learning tips and updates from our blog.</p>
                            <form class="newsletter_form">
                                <div class="form-group">
                                    <input type="email" class="form-control" placeholder="Your email address" required>
                                </div>
                                <button type="submit" class="btn btn-primary btn-block">Subscribe</button>
                            </form>
                        </div>

                        <!-- Study Resources Widget -->
                        <div class="sidebar_widget resources_widget">
                            <h4 class="widget_title">Free Study Resources</h4>
                            <div class="resource_links">
                                <a href="{{ asset('downloads/hiragana-chart.pdf') }}" class="resource_link">
                                    <i class="fa fa-download"></i>
                                    <span>Hiragana & Katakana Chart</span>
                                </a>
                                <a href="{{ asset('downloads/jlpt-n5-vocabulary.pdf') }}" class="resource_link">
                                    <i class="fa fa-download"></i>
                                    <span>JLPT N5 Vocabulary List</span>
                                </a>
                                <a href="{{ asset('downloads/basic-grammar-guide.pdf') }}" class="resource_link">
                                    <i class="fa fa-download"></i>
                                    <span>Basic Grammar Guide</span>
                                </a>
                                <a href="{{ asset('downloads/daily-conversation.pdf') }}" class="resource_link">
                                    <i class="fa fa-download"></i>
                                    <span>Daily Conversation Phrases</span>
                                </a>
                            </div>
                        </div>

                        <!-- Contact Widget -->
                        <div class="sidebar_widget contact_widget">
                            <h4 class="widget_title">Need Help?</h4>
                            <p>Have questions about Japanese learning? Our experienced teachers are here to help!</p>
                            <div class="contact_info">
                                <div class="contact_item">
                                    <i class="fa fa-phone"></i>
                                    <span>+92 51 123-4567</span>
                                </div>
                                <div class="contact_item">
                                    <i class="fa fa-envelope"></i>
                                    <span>info@tokyojapanese.pk</span>
                                </div>
                                <div class="contact_item">
                                    <i class="fa fa-map-marker-alt"></i>
                                    <span>Saddar, Rawalpindi</span>
                                </div>
                            </div>
                            <a href="{{ url('/contact') }}" class="btn btn-outline-primary btn-sm mt-3">Get in Touch</a>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>
    <!--================Blog Posts Area =================-->

    <style>
    .category_buttons {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: 15px;
    }
    
    .category_btn {
        background: #f8f9fa;
        border: 2px solid #dee2e6;
        padding: 8px 16px;
        border-radius: 20px;
        cursor: pointer;
        transition: all 0.3s ease;
        font-size: 14px;
        font-weight: 500;
    }
    
    .category_btn:hover,
    .category_btn.active {
        background: #007bff;
        color: white;
        border-color: #007bff;
    }
    
    .blog_search .input-group {
        border-radius: 25px;
        overflow: hidden;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
    
    .blog_search .form-control {
        border: none;
        padding: 12px 20px;
    }
    
    .blog_search .btn {
        border: none;
        padding: 12px 20px;
    }
    
    .blog_post {
        background: white;
        border-radius: 15px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        margin-bottom: 40px;
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .blog_post:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0,0,0,0.15);
    }
    
    .blog_post_img {
        position: relative;
        overflow: hidden;
    }
    
    .blog_post_img img {
        width: 100%;
        height: 250px;
        object-fit: cover;
        transition: transform 0.3s ease;
    }
    
    .blog_post:hover .blog_post_img img {
        transform: scale(1.05);
    }
    
    .blog_date {
        position: absolute;
        top: 20px;
        left: 20px;
        background: #007bff;
        color: white;
        text-align: center;
        border-radius: 10px;
        padding: 10px;
        min-width: 60px;
        box-shadow: 0 3px 10px rgba(0,0,0,0.3);
    }
    
    .blog_date .day {
        font-size: 1.5rem;
        font-weight: bold;
        display: block;
        line-height: 1;
    }
    
    .blog_date .month {
        font-size: 0.8rem;
        text-transform: uppercase;
    }
    
    .blog_post_content {
        padding: 30px;
    }
    
    .blog_meta {
        display: flex;
        align-items: center;
        margin-bottom: 15px;
        font-size: 14px;
    }
    
    .blog_meta .category {
        background: #007bff;
        color: white;
        padding: 4px 12px;
        border-radius: 15px;
        font-size: 12px;
        font-weight: 500;
        margin-right: 15px;
    }
    
    .blog_meta .category.culture { background: #28a745; }
    .blog_meta .category.jlpt { background: #fd7e14; }
    .blog_meta .category.grammar { background: #6f42c1; }
    .blog_meta .category.vocabulary { background: #e83e8c; }
    
    .blog_meta .author,
    .blog_meta .read_time {
        color: #6c757d;
        margin-right: 15px;
    }
    
    .blog_post_content h3 {
        margin-bottom: 15px;
        line-height: 1.4;
    }
    
    .blog_post_content h3 a {
        color: #333;
        text-decoration: none;
        transition: color 0.3s ease;
    }
    
    .blog_post_content h3 a:hover {
        color: #007bff;
    }
    
    .blog_post_content p {
        color: #6c757d;
        line-height: 1.6;
        margin-bottom: 20px;
    }
    
    .blog_tags {
        margin-bottom: 20px;
    }
    
    .blog_tags .tag {
        background: #f8f9fa;
        color: #495057;
        padding: 4px 10px;
        border-radius: 12px;
        font-size: 12px;
        margin-right: 8px;
        margin-bottom: 5px;
        display: inline-block;
    }
    
    .read_more_btn {
        color: #007bff;
        text-decoration: none;
        font-weight: 500;
        transition: all 0.3s ease;
    }
    
    .read_more_btn:hover {
        color: #0056b3;
        text-decoration: none;
    }
    
    /* Sidebar Styles */
    .blog_sidebar {
        padding-left: 30px;
    }
    
    .sidebar_widget {
        background: white;
        padding: 25px;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        margin-bottom: 30px;
    }
    
    .widget_title {
        color: #333;
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 2px solid #007bff;
        font-size: 1.2rem;
    }
    
    .recent_post_item {
        margin-bottom: 20px;
        padding-bottom: 15px;
        border-bottom: 1px solid #eee;
    }
    
    .recent_post_item:last-child {
        border-bottom: none;
        margin-bottom: 0;
    }
    
    .recent_post_img {
        width: 80px;
        height: 60px;
        margin-right: 15px;
        border-radius: 8px;
        overflow: hidden;
    }
    
    .recent_post_img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .recent_post_content h6 {
        margin-bottom: 5px;
        font-size: 14px;
        line-height: 1.3;
    }
    
    .recent_post_content h6 a {
        color: #333;
        text-decoration: none;
        transition: color 0.3s ease;
    }
    
    .recent_post_content h6 a:hover {
        color: #007bff;
    }
    
    .post_date {
        color: #999;
        font-size: 12px;
    }
    
    .category_link {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px 0;
        border-bottom: 1px solid #eee;
        color: #333;
        text-decoration: none;
        transition: color 0.3s ease;
    }
    
    .category_link:hover {
        color: #007bff;
        text-decoration: none;
    }
    
    .category_link:last-child {
        border-bottom: none;
    }
    
    .post_count {
        color: #999;
        font-size: 14px;
    }
    
    .tags_cloud {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
    }
    
    .tag_item {
        background: #f8f9fa;
        color: #495057;
        padding: 6px 12px;
        border-radius: 15px;
        font-size: 12px;
        text-decoration: none;
        transition: all 0.3s ease;
    }
    
    .tag_item:hover {
        background: #007bff;
        color: white;
        text-decoration: none;
    }
    
    .newsletter_widget {
        background: linear-gradient(135deg, #007bff, #0056b3) !important;
        color: white;
    }
    
    .newsletter_widget .widget_title {
        color: white;
        border-bottom-color: rgba(255,255,255,0.3);
    }
    
    .newsletter_form .form-control {
        border-radius: 20px;
        border: none;
        padding: 12px 20px;
        margin-bottom: 15px;
    }
    
    .newsletter_form .btn {
        border-radius: 20px;
        background: white;
        color: #007bff;
        border: none;
        font-weight: 500;
    }
    
    .resource_link {
        display: flex;
        align-items: center;
        padding: 12px 0;
        border-bottom: 1px solid #eee;
        color: #333;
        text-decoration: none;
        transition: color 0.3s ease;
    }
    
    .resource_link:hover {
        color: #007bff;
        text-decoration: none;
    }
    
    .resource_link:last-child {
        border-bottom: none;
    }
    
    .resource_link i {
        margin-right: 12px;
        color: #007bff;
        font-size: 16px;
    }
    
    .contact_item {
        display: flex;
        align-items: center;
        margin-bottom: 10px;
    }
    
    .contact_item i {
        margin-right: 12px;
        color: #007bff;
        font-size: 14px;
        width: 20px;
    }
    
    .contact_item span {
        font-size: 14px;
        color: #666;
    }
    
    /* Filter Animation */
    .blog_post.hide {
        display: none;
    }
    
    /* Pagination */
    .pagination .page-link {
        border-radius: 50px;
        margin: 0 5px;
        border: 2px solid #007bff;
        color: #007bff;
    }
    
    .pagination .page-item.active .page-link {
        background: #007bff;
        border-color: #007bff;
    }
    
    /* Responsive */
    @media (max-width: 768px) {
        .blog_sidebar {
            padding-left: 0;
            margin-top: 40px;
        }
        
        .category_buttons {
            justify-content: center;
        }
        
        .blog_meta {
            flex-wrap: wrap;
        }
        
        .blog_meta .category,
        .blog_meta .author,
        .blog_meta .read_time {
            margin-bottom: 5px;
        }
    }
    </style>

    <script>
    // Category Filter Functionality
    document.addEventListener('DOMContentLoaded', function() {
        const categoryBtns = document.querySelectorAll('.category_btn');
        const blogPosts = document.querySelectorAll('.blog_post');
        const categoryLinks = document.querySelectorAll('.category_link');
        
        // Category buttons filter
        categoryBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                // Remove active class from all buttons
                categoryBtns.forEach(b => b.classList.remove('active'));
                // Add active class to clicked button
                this.classList.add('active');
                
                const filterValue = this.getAttribute('data-category');
                filterPosts(filterValue);
            });
        });
        
        // Sidebar category links filter
        categoryLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const filterValue = this.getAttribute('data-category');
                
                // Update active button
                categoryBtns.forEach(b => b.classList.remove('active'));
                document.querySelector(`[data-category="${filterValue}"]`).classList.add('active');
                
                filterPosts(filterValue);
            });
        });
        
        function filterPosts(category) {
            blogPosts.forEach(post => {
                if (category === 'all') {
                    post.classList.remove('hide');
                } else {
                    if (post.classList.contains(category)) {
                        post.classList.remove('hide');
                    } else {
                        post.classList.add('hide');
                    }
                }
            });
        }
        
        // Search functionality
        const searchInput = document.querySelector('.blog_search input');
        const searchBtn = document.querySelector('.blog_search button');
        
        function searchPosts() {
            const searchTerm = searchInput.value.toLowerCase();
            
            blogPosts.forEach(post => {
                const title = post.querySelector('h3').textContent.toLowerCase();
                const content = post.querySelector('p').textContent.toLowerCase();
                const tags = Array.from(post.querySelectorAll('.tag')).map(tag => tag.textContent.toLowerCase()).join(' ');
                
                if (title.includes(searchTerm) || content.includes(searchTerm) || tags.includes(searchTerm)) {
                    post.classList.remove('hide');
                } else {
                    post.classList.add('hide');
                }
            });
        }
        
        searchBtn.addEventListener('click', searchPosts);
        searchInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                searchPosts();
            }
        });
        
        // Newsletter form submission
        const newsletterForm = document.querySelector('.newsletter_form');
        newsletterForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const email = this.querySelector('input[type="email"]').value;
            alert('Thank you for subscribing! You will receive our weekly Japanese learning tips at: ' + email);
            this.reset();
        });
    });
    </script>

@endsection