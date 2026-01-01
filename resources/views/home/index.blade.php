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

    const options = { root: null, threshold: 0.5 };

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
                observer.unobserve(entry.target);
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

<!-- Upcoming Events Section -->
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
                <!-- Default Ministries -->
                <div class="ministry-card">
                    <div class="ministry-icon"><i class="fas fa-hands-praying"></i></div>
                    <h3 class="ministry-title">Youth Ministry</h3>
                    <p class="ministry-description">Empowering the next generation of believers through discipleship and fellowship.</p>
                    <a href="{{ route('ministries.index') }}" class="ministry-link">Learn More</a>
                </div>
                <div class="ministry-card">
                    <div class="ministry-icon"><i class="fas fa-music"></i></div>
                    <h3 class="ministry-title">Worship & Music</h3>
                    <p class="ministry-description">Leading the congregation in heartfelt worship through music and praise.</p>
                    <a href="{{ route('ministries.index') }}" class="ministry-link">Learn More</a>
                </div>
                <div class="ministry-card">
                    <div class="ministry-icon"><i class="fas fa-hands-holding"></i></div>
                    <h3 class="ministry-title">Outreach</h3>
                    <p class="ministry-description">Serving our community through various outreach programs and missions.</p>
                    <a href="{{ route('ministries.index') }}" class="ministry-link">Learn More</a>
                </div>
                <div class="ministry-card">
                    <div class="ministry-icon"><i class="fas fa-child"></i></div>
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

<!-- CTA Section -->
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

<!-- Newsletter Section -->
<!-- Newsletter CTA Section -->
<section class="newsletter-cta-section">
    <div class="container">
        <div class="newsletter-cta-wrapper">
            <!-- Left: Icon & Text -->
            <div class="newsletter-cta-content">
                <div class="newsletter-icon-wrapper">
                    <svg class="newsletter-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" 
                              d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H5.436z"/>
                    </svg>
                </div>
                <div class="newsletter-text">
                    <h3 class="newsletter-title">Stay Connected with Our Diocese</h3>
                    <p class="newsletter-description">
                        Join our newsletter community for weekly sermons, event updates, spiritual encouragement, 
                        and the latest news from our diocese. Be part of our growing family!
                    </p>
                    <div class="newsletter-benefits">
                        <span class="benefit-item">
                            <svg class="w-5 h-5 text-emerald-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            Weekly Sermon Summaries
                        </span>
                        <span class="benefit-item">
                            <svg class="w-5 h-5 text-emerald-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            Event Announcements
                        </span>
                        <span class="benefit-item">
                            <svg class="w-5 h-5 text-emerald-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            Spiritual Encouragement
                        </span>
                    </div>
                </div>
            </div>
            
            <!-- Right: CTA Button -->
            <div class="newsletter-cta-action">
                <a href="{{ route('newsletter.index') }}" class="newsletter-cta-button">
                    <span class="button-text">Subscribe to Newsletter</span>
                    <svg class="button-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                    </svg>
                </a>
                <p class="newsletter-cta-note">
                    One click away from staying connected with your church family
                </p>
            </div>
        </div>
    </div>
</section>

<style>
/* ===== Variables ===== */
:root {
    --primary-color: #197b3b;
    --primary-dark: #14572c;
    --secondary-color: #f2c94c;
    --accent-color: #1e7d44;
    --bg-white: #ffffff;
    --bg-light: #f8fafc;
    --text-white: #ffffff;
    --text-dark: #333333;
    --text-light: #666666;
    --border-color: rgba(0, 0, 0, 0.1);
    --transition: all 0.3s ease;
    --font-heading: 'Poppins', sans-serif;
}
/* ===== Newsletter CTA Section ===== */
.newsletter-cta-section {
    background: linear-gradient(135deg, rgba(25, 123, 59, 0.05), rgba(25, 123, 59, 0.1));
    padding: 4rem 2rem;
    border-top: 4px solid var(--primary-color);
    border-bottom: 4px solid var(--primary-color);
}

.newsletter-cta-wrapper {
    max-width: 1200px;
    margin: 0 auto;
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 3rem;
    align-items: center;
    background: var(--bg-white);
    border-radius: 20px;
    padding: 3rem;
    box-shadow: 0 15px 35px rgba(25, 123, 59, 0.15);
    border: 1px solid rgba(25, 123, 59, 0.2);
}

.newsletter-cta-content {
    display: flex;
    gap: 2rem;
    align-items: flex-start;
}

.newsletter-icon-wrapper {
    flex-shrink: 0;
    width: 70px;
    height: 70px;
    background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 10px 20px rgba(25, 123, 59, 0.3);
}

.newsletter-icon {
    width: 35px;
    height: 35px;
    color: var(--text-white);
}

.newsletter-text {
    flex: 1;
}

.newsletter-title {
    font-size: 2.2rem;
    font-weight: 700;
    color: var(--primary-dark);
    margin-bottom: 1rem;
    line-height: 1.3;
}

.newsletter-description {
    font-size: 1.1rem;
    line-height: 1.6;
    color: var(--text-dark);
    margin-bottom: 1.5rem;
}

.newsletter-benefits {
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
}

.benefit-item {
    display: flex;
    align-items: center;
    font-size: 1rem;
    font-weight: 500;
    color: var(--text-dark);
}

/* Right CTA Action */
.newsletter-cta-action {
    text-align: center;
    padding-left: 2rem;
    border-left: 2px solid rgba(25, 123, 59, 0.2);
}

.newsletter-cta-button {
    display: inline-flex;
    align-items: center;
    gap: 1rem;
    background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
    color: var(--text-white);
    padding: 1.25rem 2.5rem;
    border-radius: 50px;
    font-size: 1.2rem;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s ease;
    box-shadow: 0 10px 25px rgba(25, 123, 59, 0.3);
    margin-bottom: 1rem;
}

.newsletter-cta-button:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 40px rgba(25, 123, 59, 0.4);
    gap: 1.5rem;
}

.button-text {
    white-space: nowrap;
}

.button-icon {
    width: 24px;
    height: 24px;
    transition: transform 0.3s ease;
}

.newsletter-cta-button:hover .button-icon {
    transform: translateX(5px);
}

.newsletter-cta-note {
    font-size: 0.9rem;
    color: var(--text-light);
    font-style: italic;
    margin: 0;
}

/* Responsive Design */
@media (max-width: 1024px) {
    .newsletter-cta-wrapper {
        grid-template-columns: 1fr;
        gap: 2rem;
        text-align: center;
        padding: 2rem;
    }
    
    .newsletter-cta-content {
        flex-direction: column;
        align-items: center;
        gap: 1.5rem;
    }
    
    .newsletter-cta-action {
        padding-left: 0;
        border-left: none;
        border-top: 2px solid rgba(25, 123, 59, 0.2);
        padding-top: 2rem;
    }
    
    .newsletter-benefits {
        align-items: center;
    }
}

@media (max-width: 768px) {
    .newsletter-cta-section {
        padding: 3rem 1rem;
    }
    
    .newsletter-title {
        font-size: 1.8rem;
    }
    
    .newsletter-cta-button {
        padding: 1rem 2rem;
        font-size: 1.1rem;
    }
}
/* ===== Global Styles ===== */
body { font-family: 'Poppins', sans-serif; color: var(--text-dark); margin: 0; padding: 0; background: var(--bg-white); }
a { text-decoration: none; transition: var(--transition); }
h1, h2, h3, h4, h5, h6 { margin: 0; font-family: var(--font-heading); }

/* ===== Hero Section ===== */
.hero {
    position: relative;
    min-height: 100vh;
    display: flex;
    align-items: center;
    background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
    color: var(--text-white);
    overflow: hidden;
}
.hero-background {
    position: absolute;
    top: 0; left: 0;
    width: 100%; height: 100%;
    background: url("{{ asset('images/hero-bg.jpg') }}") center/cover no-repeat;
}
.hero-overlay { position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(25,123,59,0.7); }
.hero-content {
    position: relative;
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 4rem;
    align-items: center;
    padding: 4rem 2rem;
    z-index: 2;
}
.hero-title { font-size: 3.5rem; font-weight: 700; margin-bottom: 1.5rem; line-height: 1.2; text-shadow: 2px 2px 4px rgba(0,0,0,0.3); }
.hero-subtitle { font-size: 1.4rem; margin-bottom: 2.5rem; opacity: 0.95; line-height: 1.6; }
.hero-buttons { display: flex; gap: 1.5rem; flex-wrap: wrap; }
.hero-img { max-width: 100%; border-radius: 15px; box-shadow: 0 20px 40px rgba(0,0,0,0.3); border: 3px solid rgba(255,255,255,0.1); transition: var(--transition);}
.hero-img:hover { transform: translateY(-5px); box-shadow: 0 25px 50px rgba(0,0,0,0.4); }

/* ===== Stats Section ===== */
.stats-section { padding: 5rem 0; background: var(--bg-light); text-align: center; position: relative; }
.stats-section::before { content: ''; position: absolute; top: 0; left: 0; right: 0; height: 4px; background: linear-gradient(90deg, var(--primary-color), var(--secondary-color), var(--accent-color)); }
.stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: 2rem; max-width: 1200px; margin: 0 auto; }
.stat-number { font-size: 3.5rem; font-weight: 800; background: linear-gradient(135deg, var(--primary-color), var(--primary-dark)); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
.stat-label { font-size: 1.1rem; font-weight: 600; text-transform: uppercase; letter-spacing: 1px; color: var(--text-dark); }

/* ===== Section Headers ===== */
.section-header { text-align: center; margin-bottom: 3rem; }
.section-header h2 { font-size: 2.8rem; color: var(--primary-color); position: relative; display: inline-block; }
.section-header h2::after { content: ''; position: absolute; bottom: -10px; left: 50%; transform: translateX(-50%); width: 80px; height: 4px; background: linear-gradient(90deg, var(--secondary-color), var(--accent-color)); border-radius: 2px; }
.section-header p { color: var(--text-light); font-size: 1.2rem; max-width: 600px; margin: 0.5rem auto 0; line-height: 1.6; }

/* ===== Buttons ===== */
.btn { padding: 0.75rem 2rem; font-weight: 600; border-radius: 50px; text-align: center; display: inline-block; transition: var(--transition); }
.btn-primary { background: linear-gradient(135deg, var(--primary-color), var(--primary-dark)); color: var(--text-white); border: none; }
.btn-primary:hover { transform: translateY(-3px); box-shadow: 0 15px 35px rgba(25,123,59,0.5); }
.btn-secondary { background: linear-gradient(135deg, var(--secondary-color), var(--accent-color)); color: var(--text-dark); border: none; }
.btn-secondary:hover { transform: translateY(-3px); box-shadow: 0 15px 35px rgba(242,201,76,0.4); }
.btn-outline { background: transparent; color: var(--primary-color); border: 2px solid var(--primary-color); }
.btn-outline:hover { background: var(--primary-color); color: var(--text-white); }

/* ===== Welcome Section ===== */
.welcome-section { padding: 5rem 2rem; background: var(--bg-white); }
.welcome-content { display: grid; grid-template-columns: 1fr 1fr; gap: 3rem; align-items: center; }
.welcome-text p { font-size: 1.1rem; line-height: 1.8; margin-bottom: 2rem; color: var(--text-dark); }
.welcome-features { display: grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: 1.5rem; margin-bottom: 2rem; }
.feature-item { display: flex; align-items: center; gap: 0.75rem; font-weight: 600; color: var(--primary-color); font-size: 1.1rem; }
.feature-item i { font-size: 1.8rem; }

/* ===== Events Section ===== */
.events-section { padding: 5rem 2rem; background: var(--bg-light); }
.events-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 2rem; }
.event-card { background: var(--bg-white); border-radius: 15px; overflow: hidden; box-shadow: 0 10px 25px rgba(0,0,0,0.1); transition: var(--transition); }
.event-card:hover { transform: translateY(-5px); box-shadow: 0 20px 40px rgba(0,0,0,0.15); }
.event-date { background: var(--primary-color); color: var(--text-white); padding: 1rem; text-align: center; font-weight: 700; }
.event-date .event-day { display: block; font-size: 2rem; }
.event-date .event-month { display: block; font-size: 1rem; text-transform: uppercase; }
.event-content { padding: 1.5rem; }
.event-title { font-size: 1.5rem; margin-bottom: 0.5rem; color: var(--primary-dark); }
.event-time, .event-location { font-size: 0.95rem; color: var(--text-light); margin-bottom: 0.5rem; }
.event-description { font-size: 1rem; margin-bottom: 1rem; color: var(--text-dark); }
.event-link { font-weight: 600; color: var(--primary-color); }

/* ===== Ministries Section ===== */
.ministries-section { padding: 5rem 2rem; background: var(--bg-white); }
.ministries-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 2rem; }
.ministry-card { background: var(--bg-light); padding: 2rem 1.5rem; border-radius: 15px; text-align: center; box-shadow: 0 10px 25px rgba(0,0,0,0.05); transition: var(--transition); }
.ministry-card:hover { transform: translateY(-5px); box-shadow: 0 15px 35px rgba(0,0,0,0.1); }
.ministry-icon { font-size: 2.5rem; color: var(--text-white); background: linear-gradient(135deg, var(--primary-color), var(--primary-dark)); width: 70px; height: 70px; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem; border-radius: 50%; }
.ministry-title { font-size: 1.3rem; font-weight: 600; color: var(--primary-dark); margin-bottom: 0.5rem; }
.ministry-description { font-size: 1rem; color: var(--text-dark); margin-bottom: 1rem; }
.ministry-link { font-weight: 600; color: var(--primary-color); }

/* ===== CTA Section ===== */
.cta-section { background: linear-gradient(135deg, var(--primary-color), var(--primary-dark)); color: var(--text-white); text-align: center; padding: 6rem 2rem; }
.cta-buttons { display: flex; gap: 1.5rem; justify-content: center; margin-top: 2rem; flex-wrap: wrap; }

/* ===== Newsletter Section ===== */
.newsletter-section { background: var(--bg-light); padding: 5rem 2rem; }
.newsletter-content { max-width: 800px; margin: 0 auto; text-align: center; }
.newsletter-text h3 { font-size: 2rem; color: var(--primary-color); margin-bottom: 1rem; }
.newsletter-form { display: flex; flex-wrap: wrap; gap: 1rem; justify-content: center; margin-top: 1rem; }
.newsletter-form .form-input { padding: 0.75rem 1rem; border-radius: 50px; border: 1px solid var(--border-color); flex: 1; min-width: 200px; }
.newsletter-form button { border-radius: 50px; padding: 0.75rem 2rem; }

/* ===== Responsive ===== */
@media(max-width:1024px) { .hero-content, .welcome-content { grid-template-columns: 1fr; text-align: center; } .hero-buttons, .cta-buttons { justify-content: center; } }
</style>
@endsection