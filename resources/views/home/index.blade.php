@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<section class="hero">
    <div class="hero-background">
        <div class="hero-overlay"></div>
    </div>
    <div class="container hero-content">
        <div class="hero-text">
            <h1 class="hero-title">Welcome to ELCK Southern Lake Diocese</h1>
            <p class="hero-subtitle">Serving Christ, Transforming Communities, Spreading Hope</p>
            <div class="hero-buttons">
                <a href="{{ url('/about') }}" class="btn btn-primary">Learn More</a>
                <a href="{{ url('/events') }}" class="btn btn-secondary">Upcoming Events</a>
            </div>
        </div>
        <div class="hero-image">
            <img src="https://plus.unsplash.com/premium_photo-1702058277920-8b895cdd7bbc?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8OXx8Y2h1cmNoJTIwYWN0aXZpdGllc3xlbnwwfHwwfHx8MA%3D%3D&auto=format&fit=crop&q=60&w=600" alt="ELCK Southern Lake Diocese Church" class="hero-img">
        </div>
    </div>
</section>

<!-- Quick Stats -->
<section class="stats-section">
    <div class="container">
        <div class="stats-grid">
            <div class="stat-item">
                <div class="stat-number" data-count="50">0</div>
                <div class="stat-label">Churches</div>
            </div>
            <div class="stat-item">
                <div class="stat-number" data-count="25">0</div>
                <div class="stat-label">Ministries</div>
            </div>
            <div class="stat-item">
                <div class="stat-number" data-count="350000">0</div>
                <div class="stat-label">Members</div>
            </div>
            <div class="stat-item">
                <div class="stat-number" data-count="75">0</div>
                <div class="stat-label">Years Serving</div>
            </div>
        </div>
    </div>
</section>
<script>
document.addEventListener("DOMContentLoaded", () => {
    const counters = document.querySelectorAll(".stat-number");

    const options = {
        root: null,
        threshold: 0.5 // triggers when 50% of the element is visible
    };

    const startCounter = (counter) => {
        const target = +counter.getAttribute("data-count");
        let count = 0;
        const duration = 2000;
        const increment = target / (duration / 20);

        const updateCounter = () => {
            count += increment;
            if (count < target) {
                counter.innerText = Math.ceil(count);
                requestAnimationFrame(updateCounter);
            } else {
                counter.innerText = target;
            }
        };

        requestAnimationFrame(updateCounter);
    };

    const observer = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                startCounter(entry.target);
                observer.unobserve(entry.target); // stop observing once counted
            }
        });
    }, options);

    counters.forEach(counter => observer.observe(counter));
});
</script>


<!-- Welcome Section -->
<section class="welcome-section">
    <div class="container">
        <div class="section-header">
            <h2>Welcome to Our Diocese</h2>
            <p>Join us in our mission to spread the Gospel and serve our communities</p>
        </div>
        <div class="welcome-content">
            <div class="welcome-text">
                <p>The Evangelical Lutheran Church in Kenya - Southern Lake Diocese is committed to serving God and our communities through worship, ministry, and outreach programs. We believe in transforming lives through the power of the Gospel and the love of Jesus Christ.</p>
                <div class="welcome-features">
                    <div class="feature-item">
                        <i class="fas fa-cross"></i>
                        <span>Christ-Centered Worship</span>
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-hands-helping"></i>
                        <span>Community Outreach</span>
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-users"></i>
                        <span>Family Ministry</span>
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-heart"></i>
                        <span>Compassionate Service</span>
                    </div>
                </div>
                <a href="{{ url('/about') }}" class="btn btn-outline">Our Story</a>
            </div>
            <div class="welcome-image">
                <img src="https://images.unsplash.com/photo-1529070538774-1843cb3265df?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NHx8Y2h1cmNoJTIwY29tbXVuaXR5fGVufDB8fDB8fHww&auto=format&fit=crop&q=60&w=600" alt="Our Church Community" class="welcome-img">
            </div>
        </div>
    </div>
</section>

<!-- Upcoming Events -->
<section class="events-section">
    <div class="container">
        <div class="section-header">
            <h2>Upcoming Events</h2>
            <p>Join us for worship, fellowship, and community events</p>
        </div>
        <div class="events-grid">
            @if(isset($events) && count($events) > 0)
                @foreach($events->take(3) as $event)
                <div class="event-card">
                    <div class="event-date">
                        <span class="event-day">{{ $event->date->format('d') }}</span>
                        <span class="event-month">{{ $event->date->format('M') }}</span>
                    </div>
                    <div class="event-content">
                        <h3 class="event-title">{{ $event->title }}</h3>
                        <p class="event-time">
                            <i class="fas fa-clock"></i>
                            {{ $event->time ?? 'All Day' }}
                        </p>
                        <p class="event-location">
                            <i class="fas fa-map-marker-alt"></i>
                            {{ $event->location }}
                        </p>
                        <p class="event-description">{{ Str::limit($event->description, 100) }}</p>
                        <a href="{{ route('events.show', $event->id) }}" class="event-link">Learn More</a>
                    </div>
                </div>
                @endforeach
            @else
                <div class="no-events">
                    <i class="fas fa-calendar-alt"></i>
                    <p>No upcoming events at the moment. Check back soon!</p>
                </div>
            @endif
        </div>
        <div class="section-footer">
            <a href="{{ route('events.index') }}" class="btn btn-outline">View All Events</a>
        </div>
    </div>
</section>

<!-- Ministries Section -->
<section class="ministries-section">
    <div class="container">
        <div class="section-header">
            <h2>Our Ministries</h2>
            <p>Get involved in our various ministries and serve the community</p>
        </div>
        <div class="ministries-grid">
            @if(isset($ministries) && count($ministries) > 0)
                @foreach($ministries->take(4) as $ministry)
                <div class="ministry-card">
                    <div class="ministry-icon">
                        <i class="fas {{ $ministry->icon ?? 'fa-hands-praying' }}"></i>
                    </div>
                    <h3 class="ministry-title">{{ $ministry->name }}</h3>
                    <p class="ministry-description">{{ Str::limit($ministry->description, 120) }}</p>
                    <a href="{{ route('ministries.show', $ministry->id) }}" class="ministry-link">Learn More</a>
                </div>
                @endforeach
            @else
                <div class="ministry-card">
                    <div class="ministry-icon">
                        <i class="fas fa-hands-praying"></i>
                    </div>
                    <h3 class="ministry-title">Youth Ministry</h3>
                    <p class="ministry-description">Empowering the next generation of believers through discipleship and fellowship.</p>
                    <a href="{{ route('ministries.index') }}" class="ministry-link">Learn More</a>
                </div>
                <div class="ministry-card">
                    <div class="ministry-icon">
                        <i class="fas fa-music"></i>
                    </div>
                    <h3 class="ministry-title">Worship & Music</h3>
                    <p class="ministry-description">Leading the congregation in heartfelt worship through music and praise.</p>
                    <a href="{{ route('ministries.index') }}" class="ministry-link">Learn More</a>
                </div>
                <div class="ministry-card">
                    <div class="ministry-icon">
                        <i class="fas fa-hands-holding"></i>
                    </div>
                    <h3 class="ministry-title">Outreach</h3>
                    <p class="ministry-description">Serving our community through various outreach programs and missions.</p>
                    <a href="{{ route('ministries.index') }}" class="ministry-link">Learn More</a>
                </div>
                <div class="ministry-card">
                    <div class="ministry-icon">
                        <i class="fas fa-child"></i>
                    </div>
                    <h3 class="ministry-title">Children's Ministry</h3>
                    <p class="ministry-description">Nurturing young hearts in the love and knowledge of Jesus Christ.</p>
                    <a href="{{ route('ministries.index') }}" class="ministry-link">Learn More</a>
                </div>
            @endif
        </div>
        <div class="section-footer">
            <a href="{{ route('ministries.index') }}" class="btn btn-outline">Explore All Ministries</a>
        </div>
    </div>
</section>

<!-- Latest Sermons -->
<section class="sermons-section">
    <div class="container">
        <div class="section-header">
            <h2>Latest Sermons</h2>
            <p>Be inspired by God's word through our recent messages</p>
        </div>
        <div class="sermons-grid">
            @if(isset($sermons) && count($sermons) > 0)
                @foreach($sermons->take(3) as $sermon)
                <div class="sermon-card">
                    <div class="sermon-image">
                        <img src="{{ asset($sermon->image ?? 'images/sermon-default.jpg') }}" alt="{{ $sermon->title }}">
                        <div class="sermon-overlay">
                            <button class="play-button">
                                <i class="fas fa-play"></i>
                            </button>
                        </div>
                    </div>
                    <div class="sermon-content">
                        <h3 class="sermon-title">{{ $sermon->title }}</h3>
                        <p class="sermon-preacher">By {{ $sermon->preacher }}</p>
                        <p class="sermon-date">{{ $sermon->date->format('F j, Y') }}</p>
                        <p class="sermon-description">{{ Str::limit($sermon->description, 100) }}</p>
                        <div class="sermon-actions">
                            <a href="{{ route('sermons.show', $sermon->id) }}" class="btn btn-sm">Listen Now</a>
                            <a href="{{ route('sermons.download', $sermon->id) }}" class="btn btn-sm btn-outline">
                                <i class="fas fa-download"></i>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            @else
                <div class="no-sermons">
                    <i class="fas fa-book-bible"></i>
                    <p>No sermons available at the moment. Check back soon!</p>
                </div>
            @endif
        </div>
        <div class="section-footer">
            <a href="{{ route('sermons.index') }}" class="btn btn-outline">Browse All Sermons</a>
        </div>
    </div>
</section>

<!-- Gallery Preview -->
<section class="gallery-section">
    <div class="container">
        <div class="section-header">
            <h2>Church Life</h2>
            <p>Experience our community through photos</p>
        </div>
        <div class="gallery-grid">
            @for($i = 1; $i <= 6; $i++)
            <div class="gallery-item">
                <img src="{{ asset('images/gallery/gallery-' . $i . '.jpg') }}" alt="Church Activity {{ $i }}" class="gallery-img">
                <div class="gallery-overlay">
                    <i class="fas fa-search-plus"></i>
                </div>
            </div>
            @endfor
        </div>
        <div class="section-footer">
            <a href="{{ route('gallery') }}" class="btn btn-outline">View Full Gallery</a>
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="cta-section">
    <div class="container">
        <div class="cta-content">
            <h2>Join Us This Sunday</h2>
            <p>Experience the love of Christ in our welcoming community. Whether you're new to faith or have been walking with God for years, there's a place for you here.</p>
            <div class="cta-buttons">
                <a href="{{ route('contact') }}" class="btn btn-primary">Visit Us</a>
                <a href="{{ route('donations.give') }}" class="btn btn-secondary">Support Our Mission</a>
            </div>
        </div>
    </div>
</section>

<!-- Newsletter Signup -->
<section class="newsletter-section">
    <div class="container">
        <div class="newsletter-content">
            <div class="newsletter-text">
                <h3>Stay Connected</h3>
                <p>Subscribe to our newsletter for updates on events, sermons, and church news.</p>
            </div>
            <form class="newsletter-form" action="{{ route('newsletter.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <input type="email" name="email" placeholder="Enter your email address" required class="form-input">
                    <button type="submit" class="btn btn-primary">Subscribe</button>
                </div>
            </form>
            @if (session('success'))
    <div class="alert alert-success mt-3">
        {{ session('success') }}
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger mt-3">
        {{ $errors->first('email') }}
    </div>
@endif
        </div>
    </div>
</section>

<style>
    /* ===== Homepage Specific Styles ===== */

/* Hero Section */
.hero {
    position: relative;
    min-height: 100vh;
    display: flex;
    align-items: center;
    background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
    color: var(--text-white);
    overflow: hidden;
}

.hero-background {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: url("{{ asset('images/hero-bg.jpg') }}") center/cover no-repeat;
}

.hero-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(26, 75, 122, 0.85);
}

.hero-content {
    position: relative;
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 4rem;
    align-items: center;
    z-index: 2;
}

.hero-title {
    font-size: 3.5rem;
    font-weight: 700;
    margin-bottom: 1.5rem;
    font-family: var(--font-heading);
    line-height: 1.2;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
}

.hero-subtitle {
    font-size: 1.4rem;
    margin-bottom: 2.5rem;
    opacity: 0.95;
    line-height: 1.6;
}

.hero-buttons {
    display: flex;
    gap: 1.5rem;
    flex-wrap: wrap;
}

.hero-image {
    text-align: center;
    position: relative;
}

.hero-img {
    max-width: 100%;
    border-radius: 15px;
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
    border: 3px solid rgba(255, 255, 255, 0.1);
    transition: var(--transition);
}

.hero-img:hover {
    transform: translateY(-5px);
    box-shadow: 0 25px 50px rgba(0, 0, 0, 0.4);
}

/* Stats Section */
.stats-section {
    padding: 5rem 0;
    background: linear-gradient(135deg, var(--bg-light) 0%, #f8fafc 100%);
    position: relative;
}

.stats-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, var(--primary-color), var(--secondary-color), var(--accent-color));
}

.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 2rem;
    text-align: center;
}

.stat-item {
    padding: 2.5rem 1rem;
    background: var(--bg-white);
    border-radius: 15px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
    transition: var(--transition);
    border: 1px solid rgba(255, 255, 255, 0.8);
}

.stat-item:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
}

.stat-number {
    font-size: 3.5rem;
    font-weight: 800;
    color: var(--primary-color);
    margin-bottom: 0.75rem;
    background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.stat-label {
    font-size: 1.1rem;
    color: var(--text-dark);
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1px;
}

/* Section Headers */
.section-header {
    text-align: center;
    margin-bottom: 4rem;
}

.section-header h2 {
    font-size: 2.8rem;
    color: var(--primary-color);
    margin-bottom: 1.2rem;
    font-family: var(--font-heading);
    position: relative;
    display: inline-block;
}

.section-header h2::after {
    content: '';
    position: absolute;
    bottom: -10px;
    left: 50%;
    transform: translateX(-50%);
    width: 80px;
    height: 4px;
    background: linear-gradient(90deg, var(--secondary-color), var(--accent-color));
    border-radius: 2px;
}

.section-header p {
    font-size: 1.2rem;
    color: var(--text-light);
    max-width: 600px;
    margin: 0 auto;
    line-height: 1.6;
}

.section-footer {
    text-align: center;
    margin-top: 4rem;
}

/* Welcome Section */
.welcome-section {
    padding: 6rem 0;
    background: var(--bg-white);
    position: relative;
}

.welcome-content {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 5rem;
    align-items: center;
}

.welcome-text p {
    font-size: 1.15rem;
    line-height: 1.8;
    margin-bottom: 2.5rem;
    color: var(--text-dark);
}

.welcome-features {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1.5rem;
    margin: 2.5rem 0;
}

.feature-item {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1rem;
    background: var(--bg-light);
    border-radius: 10px;
    transition: var(--transition);
}

.feature-item:hover {
    background: var(--primary-color);
    transform: translateX(5px);
}

.feature-item:hover i,
.feature-item:hover span {
    color: white;
}

.feature-item i {
    color: var(--secondary-color);
    font-size: 1.4rem;
    width: 30px;
    transition: var(--transition);
}

.feature-item span {
    color: var(--text-dark);
    font-weight: 500;
    transition: var(--transition);
}

.welcome-image {
    text-align: center;
    position: relative;
}

.welcome-img {
    max-width: 100%;
    border-radius: 15px;
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
    transition: var(--transition);
}

.welcome-img:hover {
    transform: scale(1.02);
    box-shadow: 0 20px 45px rgba(0, 0, 0, 0.15);
}

/* Events Section */
.events-section {
    padding: 6rem 0;
    background: linear-gradient(135deg, #f8fafc 0%, var(--bg-light) 100%);
}

.events-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(380px, 1fr));
    gap: 2.5rem;
}

.event-card {
    background: var(--bg-white);
    border-radius: 15px;
    padding: 2rem;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
    display: flex;
    gap: 1.5rem;
    transition: var(--transition);
    border: 1px solid rgba(255, 255, 255, 0.8);
}

.event-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
}

.event-date {
    background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
    color: white;
    padding: 1.2rem;
    border-radius: 12px;
    text-align: center;
    min-width: 90px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    box-shadow: 0 5px 15px rgba(26, 75, 122, 0.3);
}

.event-day {
    font-size: 2.2rem;
    font-weight: 800;
    line-height: 1;
}

.event-month {
    font-size: 1.1rem;
    font-weight: 600;
    opacity: 0.9;
}

.event-content {
    flex: 1;
}

.event-title {
    font-size: 1.3rem;
    font-weight: 700;
    margin-bottom: 0.75rem;
    color: var(--primary-color);
    line-height: 1.4;
}

.event-time,
.event-location {
    display: flex;
    align-items: center;
    gap: 0.6rem;
    margin-bottom: 0.5rem;
    color: var(--text-light);
    font-size: 0.95rem;
}

.event-time i,
.event-location i {
    color: var(--secondary-color);
    width: 16px;
}

.event-description {
    margin: 1.2rem 0;
    color: var(--text-dark);
    line-height: 1.6;
    font-size: 0.95rem;
}

.event-link {
    color: var(--primary-color);
    text-decoration: none;
    font-weight: 600;
    transition: var(--transition);
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
}

.event-link:hover {
    color: var(--primary-dark);
    gap: 0.75rem;
}

.no-events {
    text-align: center;
    padding: 4rem 2rem;
    color: var(--text-light);
    grid-column: 1 / -1;
}

.no-events i {
    font-size: 4rem;
    margin-bottom: 1.5rem;
    color: var(--border-color);
    opacity: 0.5;
}

.no-events p {
    font-size: 1.1rem;
}

/* Ministries Section */
.ministries-section {
    padding: 6rem 0;
    background: var(--bg-white);
}

.ministries-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 2.5rem;
}

.ministry-card {
    background: var(--bg-white);
    padding: 2.5rem 2rem;
    border-radius: 20px;
    text-align: center;
    box-shadow: 0 10px 35px rgba(0, 0, 0, 0.08);
    transition: var(--transition);
    border-top: 5px solid var(--secondary-color);
    position: relative;
    overflow: hidden;
}

.ministry-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
    transition: var(--transition);
}

.ministry-card:hover::before {
    left: 100%;
}

.ministry-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 50px rgba(0, 0, 0, 0.15);
}

.ministry-icon {
    width: 90px;
    height: 90px;
    background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 2rem;
    box-shadow: 0 10px 25px rgba(26, 75, 122, 0.3);
    transition: var(--transition);
}

.ministry-card:hover .ministry-icon {
    transform: scale(1.1) rotate(5deg);
}

.ministry-icon i {
    font-size: 2.2rem;
    color: white;
}

.ministry-title {
    font-size: 1.5rem;
    font-weight: 700;
    margin-bottom: 1.2rem;
    color: var(--primary-color);
}

.ministry-description {
    color: var(--text-light);
    line-height: 1.7;
    margin-bottom: 2rem;
    font-size: 0.98rem;
}

.ministry-link {
    color: var(--primary-color);
    text-decoration: none;
    font-weight: 600;
    transition: var(--transition);
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
}

.ministry-link:hover {
    color: var(--primary-dark);
    gap: 0.75rem;
}

/* Sermons Section */
.sermons-section {
    padding: 6rem 0;
    background: linear-gradient(135deg, #f8fafc 0%, var(--bg-light) 100%);
}

.sermons-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(380px, 1fr));
    gap: 2.5rem;
}

.sermon-card {
    background: var(--bg-white);
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 10px 35px rgba(0, 0, 0, 0.08);
    transition: var(--transition);
    position: relative;
}

.sermon-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 45px rgba(0, 0, 0, 0.15);
}

.sermon-image {
    position: relative;
    height: 220px;
    overflow: hidden;
}

.sermon-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: var(--transition);
}

.sermon-card:hover .sermon-image img {
    transform: scale(1.1);
}

.sermon-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, rgba(26, 75, 122, 0.8), rgba(13, 58, 107, 0.9));
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: var(--transition);
}

.sermon-card:hover .sermon-overlay {
    opacity: 1;
}

.play-button {
    width: 70px;
    height: 70px;
    background: var(--secondary-color);
    border: none;
    border-radius: 50%;
    color: white;
    font-size: 1.6rem;
    cursor: pointer;
    transition: var(--transition);
    box-shadow: 0 10px 25px rgba(212, 175, 55, 0.4);
}

.play-button:hover {
    background: #c19b2a;
    transform: scale(1.1);
    box-shadow: 0 15px 30px rgba(212, 175, 55, 0.6);
}

.sermon-content {
    padding: 2rem;
}

.sermon-title {
    font-size: 1.3rem;
    font-weight: 700;
    margin-bottom: 0.75rem;
    color: var(--primary-color);
    line-height: 1.4;
}

.sermon-preacher {
    color: var(--text-light);
    font-weight: 600;
    margin-bottom: 0.5rem;
    font-size: 0.95rem;
}

.sermon-date {
    color: var(--text-light);
    font-size: 0.9rem;
    margin-bottom: 1.2rem;
}

.sermon-description {
    color: var(--text-dark);
    line-height: 1.6;
    margin-bottom: 1.8rem;
    font-size: 0.95rem;
}

.sermon-actions {
    display: flex;
    gap: 1rem;
    align-items: center;
}

.no-sermons {
    text-align: center;
    padding: 4rem 2rem;
    color: var(--text-light);
    grid-column: 1 / -1;
}

.no-sermons i {
    font-size: 4rem;
    margin-bottom: 1.5rem;
    color: var(--border-color);
    opacity: 0.5;
}

.no-sermons p {
    font-size: 1.1rem;
}

/* Gallery Section */
.gallery-section {
    padding: 6rem 0;
    background: var(--bg-white);
}

.gallery-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 1.5rem;
}

.gallery-item {
    position: relative;
    border-radius: 15px;
    overflow: hidden;
    aspect-ratio: 1;
    cursor: pointer;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
    transition: var(--transition);
}

.gallery-item:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
}

.gallery-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: var(--transition);
}

.gallery-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, rgba(26, 75, 122, 0.8), rgba(212, 175, 55, 0.8));
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: var(--transition);
}

.gallery-item:hover .gallery-overlay {
    opacity: 1;
}

.gallery-item:hover .gallery-img {
    transform: scale(1.1);
}

.gallery-overlay i {
    color: white;
    font-size: 2.5rem;
    transform: scale(0.8);
    transition: var(--transition);
}

.gallery-item:hover .gallery-overlay i {
    transform: scale(1);
}

/* CTA Section */
.cta-section {
    background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
    color: var(--text-white);
    padding: 6rem 0;
    text-align: center;
    position: relative;
    overflow: hidden;
}

.cta-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='%23ffffff' fill-opacity='0.03' fill-rule='evenodd'/%3E%3C/svg%3E");
}

.cta-content {
    position: relative;
    z-index: 2;
}

.cta-content h2 {
    font-size: 3rem;
    margin-bottom: 1.5rem;
    font-family: var(--font-heading);
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
}

.cta-content p {
    font-size: 1.3rem;
    max-width: 700px;
    margin: 0 auto 3rem;
    opacity: 0.95;
    line-height: 1.6;
}

.cta-buttons {
    display: flex;
    gap: 1.5rem;
    justify-content: center;
    flex-wrap: wrap;
}

/* Newsletter Section */
.newsletter-section {
    background: linear-gradient(135deg, var(--bg-light) 0%, #f1f5f9 100%);
    padding: 5rem 0;
    border-top: 1px solid rgba(0, 0, 0, 0.05);
    border-bottom: 1px solid rgba(0, 0, 0, 0.05);
}

.newsletter-content {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 4rem;
    align-items: center;
    max-width: 1100px;
    margin: 0 auto;
}

.newsletter-text h3 {
    font-size: 2.2rem;
    color: var(--primary-color);
    margin-bottom: 1rem;
    font-family: var(--font-heading);
}

.newsletter-text p {
    font-size: 1.15rem;
    color: var(--text-light);
    line-height: 1.6;
}

.newsletter-form {
    display: flex;
    gap: 0;
    background: white;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    border: 1px solid rgba(0, 0, 0, 0.05);
}

.form-group {
    display: flex;
    flex: 1;
}

.form-input {
    flex: 1;
    padding: 1.2rem 1.5rem;
    border: none;
    outline: none;
    font-size: 1rem;
    background: white;
}

.form-input::placeholder {
    color: var(--text-light);
}

.form-input:focus {
    background: #fafbfc;
}

/* Buttons */
.btn {
    display: inline-flex;
    align-items: center;
    gap: 0.75rem;
    padding: 1rem 2rem;
    border: none;
    border-radius: 12px;
    font-weight: 600;
    text-decoration: none;
    cursor: pointer;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    font-size: 1rem;
    text-align: center;
    justify-content: center;
    position: relative;
    overflow: hidden;
}

.btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    transition: left 0.5s;
}

.btn:hover::before {
    left: 100%;
}

.btn-primary {
    background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
    color: white;
    box-shadow: 0 8px 25px rgba(26, 75, 122, 0.3);
}

.btn-primary:hover {
    transform: translateY(-3px);
    box-shadow: 0 15px 35px rgba(26, 75, 122, 0.4);
}

.btn-secondary {
    background: linear-gradient(135deg, var(--secondary-color), #c19b2a);
    color: var(--text-dark);
    box-shadow: 0 8px 25px rgba(212, 175, 55, 0.3);
}

.btn-secondary:hover {
    transform: translateY(-3px);
    box-shadow: 0 15px 35px rgba(212, 175, 55, 0.4);
}

.btn-outline {
    background: transparent;
    color: var(--primary-color);
    border: 2px solid var(--primary-color);
    box-shadow: 0 4px 15px rgba(26, 75, 122, 0.1);
}

.btn-outline:hover {
    background: var(--primary-color);
    color: white;
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(26, 75, 122, 0.3);
}

.btn-sm {
    padding: 0.75rem 1.5rem;
    font-size: 0.9rem;
}

/* Responsive Design */
@media (max-width: 1200px) {
    .hero-title {
        font-size: 3rem;
    }
    
    .section-header h2 {
        font-size: 2.5rem;
    }
}

@media (max-width: 768px) {
    .hero-content {
        grid-template-columns: 1fr;
        gap: 3rem;
        text-align: center;
    }

    .hero-title {
        font-size: 2.5rem;
    }

    .hero-subtitle {
        font-size: 1.2rem;
    }

    .welcome-content {
        grid-template-columns: 1fr;
        gap: 3rem;
    }

    .welcome-features {
        grid-template-columns: 1fr;
    }

    .events-grid,
    .sermons-grid {
        grid-template-columns: 1fr;
    }

    .ministries-grid {
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    }

    .gallery-grid {
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    }

    .newsletter-content {
        grid-template-columns: 1fr;
        gap: 2.5rem;
        text-align: center;
    }

    .newsletter-form {
        flex-direction: column;
        border-radius: 12px;
    }

    .form-group {
        flex-direction: column;
    }

    .section-header h2 {
        font-size: 2.2rem;
    }

    .cta-content h2 {
        font-size: 2.5rem;
    }

    .hero-buttons,
    .cta-buttons {
        flex-direction: column;
        align-items: center;
    }

    .btn {
        width: 100%;
        max-width: 280px;
    }

    .event-card {
        flex-direction: column;
        text-align: center;
    }

    .event-date {
        flex-direction: row;
        justify-content: center;
        gap: 1rem;
        min-width: auto;
        padding: 1rem 2rem;
    }

    .event-day,
    .event-month {
        font-size: 1.5rem;
    }
}

@media (max-width: 480px) {
    .hero-title {
        font-size: 2rem;
    }

    .stats-grid {
        grid-template-columns: repeat(2, 1fr);
    }

    .stat-number {
        font-size: 2.5rem;
    }

    .section-header h2 {
        font-size: 2rem;
    }

    .cta-content h2 {
        font-size: 2rem;
    }

    .newsletter-text h3 {
        font-size: 1.8rem;
    }

    .gallery-grid {
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
    }
}

/* Animation Classes */
.fade-in {
    animation: fadeIn 1s ease-in;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.slide-in-left {
    animation: slideInLeft 1s ease-out;
}

@keyframes slideInLeft {
    from {
        opacity: 0;
        transform: translateX(-50px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

.slide-in-right {
    animation: slideInRight 1s ease-out;
}

@keyframes slideInRight {
    from {
        opacity: 0;
        transform: translateX(50px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}
    </style>

@push('scripts')
<script>
    // Enhanced animated counter for stats
    document.addEventListener('DOMContentLoaded', function() {
        const counters = document.querySelectorAll('.stat-number');
        let animationStarted = false;

        function animateCounter(counter, target, duration = 2000) {
            let start = 0;
            const increment = target / (duration / 16); // 60fps
            
            const timer = setInterval(() => {
                start += increment;
                if (start >= target) {
                    counter.textContent = target;
                    clearInterval(timer);
                } else {
                    counter.textContent = Math.floor(start);
                }
            }, 16);
        }

        function startCounters() {
            if (animationStarted) return;
            animationStarted = true;
            
            counters.forEach(counter => {
                const target = parseInt(counter.getAttribute('data-count'));
                // Reset to 0 first
                counter.textContent = '0';
                animateCounter(counter, target);
            });
        }

        // Start when stats section is in view
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting && !animationStarted) {
                    startCounters();
                }
            });
        }, {
            threshold: 0.3, // Start when 30% of section is visible
            rootMargin: '0px 0px -50px 0px' // Start 50px before element enters viewport
        });

        const statsSection = document.querySelector('.stats-section');
        if (statsSection) {
            observer.observe(statsSection);
        }

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    });
    
</script>
@endpush
@endsection