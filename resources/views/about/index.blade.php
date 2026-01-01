@extends('layouts.app')

@section('content')
<style>
    :root {
        --primary-green: #197b3b;
        --green-dark: #13662f;
        --green-light: #2a9d5f;
        --green-lighter: #e8f5ee;
        --accent-gold: #d4af37;
        --accent-blue: #2a5298;
        --text-dark: #2c3e50;
        --text-light: #7f8c8d;
        --bg-light: #f8fafc;
        --border-radius: 15px;
        --shadow-sm: 0 4px 12px rgba(0, 0, 0, 0.08);
        --shadow-md: 0 8px 24px rgba(0, 0, 0, 0.12);
        --shadow-lg: 0 12px 32px rgba(0, 0, 0, 0.15);
        --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .about-container {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        color: var(--text-dark);
        line-height: 1.7;
    }
    
    /* Hero Banner with Overlay */
    .hero-banner {
        position: relative;
        min-height: 70vh;
        display: flex;
        align-items: center;
        background: linear-gradient(rgba(25, 123, 59, 0.85), rgba(19, 102, 47, 0.9)), 
                    url('https://images.unsplash.com/photo-1511895426328-dc8714191300?auto=format&fit=crop&w=1200&q=80');
        background-size: cover;
        background-position: center;
        color: white;
        padding: 6rem 0;
        overflow: hidden;
    }
    
    .hero-banner .container {
        position: relative;
        z-index: 2;
    }
    
    .hero-title {
        font-size: 3.5rem;
        font-weight: 700;
        margin-bottom: 1.5rem;
        font-family: 'Georgia', serif;
        line-height: 1.2;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
    }
    
    .hero-subtitle {
        font-size: 1.3rem;
        max-width: 700px;
        margin: 0 auto;
        line-height: 1.6;
        opacity: 0.95;
    }
    
    /* Side by Side Mission & Vision */
    .mission-vision-section {
        padding: 6rem 0;
        background: var(--bg-light);
    }
    
    .mission-vision-container {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 4rem;
        align-items: start;
        max-width: 1200px;
        margin: 0 auto;
    }
    
    .mission-vision-card {
        position: relative;
        background: white;
        border-radius: var(--border-radius);
        padding: 3.5rem 3rem;
        height: 100%;
        transition: var(--transition);
        border: 2px solid transparent;
        box-shadow: var(--shadow-sm);
    }
    
    .mission-vision-card:hover {
        transform: translateY(-10px);
        box-shadow: var(--shadow-lg);
        border-color: var(--primary-green);
    }
    
    .mission-vision-card h3 {
        font-size: 2.2rem;
        color: var(--primary-green);
        margin-bottom: 1.5rem;
        font-family: 'Georgia', serif;
        position: relative;
        padding-bottom: 1rem;
    }
    
    .mission-vision-card h3::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 60px;
        height: 4px;
        background: linear-gradient(90deg, var(--primary-green), var(--accent-gold));
        border-radius: 2px;
    }
    
    .mission-vision-card p {
        font-size: 1.15rem;
        line-height: 1.8;
        color: var(--text-dark);
        margin-bottom: 0;
    }
    
    .card-icon {
        position: absolute;
        top: -30px;
        right: 30px;
        width: 70px;
        height: 70px;
        background: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: var(--shadow-md);
        border: 4px solid var(--primary-green);
        color: var(--primary-green);
        font-size: 1.8rem;
        z-index: 1;
    }
    
    /* Core Values */
    .core-values-section {
        padding: 6rem 0;
        background: white;
    }
    
    .values-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 2rem;
        margin-top: 3rem;
    }
    
    /* Dynamic Timeline Styles */
    .timeline-section {
        padding: 6rem 0;
        background: var(--bg-light);
        position: relative;
        overflow: hidden;
    }
    
    .timeline-container {
        position: relative;
        max-width: 1200px;
        margin: 0 auto;
        padding: 4rem 0;
    }
    
    .timeline-line {
        position: absolute;
        left: 50%;
        transform: translateX(-50%);
        width: 4px;
        height: 100%;
        background: linear-gradient(to bottom, var(--primary-green), var(--accent-gold));
        border-radius: 2px;
        z-index: 1;
    }
    
    .timeline-dots {
        position: absolute;
        left: 50%;
        transform: translateX(-50%);
        width: 100%;
        height: 100%;
        z-index: 2;
    }
    
    .timeline-dot {
        position: absolute;
        left: 50%;
        transform: translateX(-50%);
        width: 24px;
        height: 24px;
        background: white;
        border: 4px solid var(--primary-green);
        border-radius: 50%;
        cursor: pointer;
        transition: var(--transition);
        z-index: 3;
        box-shadow: 0 0 0 3px rgba(25, 123, 59, 0.1);
    }
    
    .timeline-dot:hover {
        transform: translateX(-50%) scale(1.2);
        background: var(--primary-green);
        box-shadow: 0 0 0 6px rgba(25, 123, 59, 0.2);
    }
    
    .timeline-dot.active {
        background: var(--primary-green);
        transform: translateX(-50%) scale(1.2);
        box-shadow: 0 0 0 8px rgba(25, 123, 59, 0.3);
    }
    
    .timeline-items {
        display: flex;
        flex-direction: column;
        gap: 6rem;
        position: relative;
        z-index: 4;
    }
    
    .timeline-item {
        display: flex;
        align-items: center;
        opacity: 0;
        transform: translateY(30px);
        transition: all 0.6s ease;
    }
    
    .timeline-item.visible {
        opacity: 1;
        transform: translateY(0);
    }
    
    .timeline-item:nth-child(odd) {
        flex-direction: row;
    }
    
    .timeline-item:nth-child(even) {
        flex-direction: row-reverse;
    }
    
    .timeline-content {
        flex: 1;
        background: white;
        padding: 2.5rem;
        border-radius: var(--border-radius);
        box-shadow: var(--shadow-md);
        border: 2px solid transparent;
        transition: var(--transition);
        position: relative;
        max-width: 500px;
    }
    
    .timeline-item:nth-child(odd) .timeline-content {
        margin-right: 4rem;
        border-left: 4px solid var(--primary-green);
    }
    
    .timeline-item:nth-child(even) .timeline-content {
        margin-left: 4rem;
        border-right: 4px solid var(--primary-green);
    }
    
    .timeline-content:hover {
        transform: translateY(-5px);
        box-shadow: var(--shadow-lg);
        border-color: var(--primary-green);
    }
    
    .timeline-year {
        font-size: 2.5rem;
        font-weight: 800;
        color: var(--primary-green);
        margin-bottom: 1rem;
        font-family: 'Georgia', serif;
        position: relative;
        display: inline-block;
    }
    
    .timeline-year::after {
        content: '';
        position: absolute;
        bottom: -5px;
        left: 0;
        width: 60px;
        height: 4px;
        background: linear-gradient(90deg, var(--primary-green), var(--accent-gold));
        border-radius: 2px;
    }
    
    .timeline-text {
        font-size: 1.1rem;
        line-height: 1.7;
        color: var(--text-dark);
    }
    
    .timeline-image {
        width: 200px;
        height: 200px;
        border-radius: 50%;
        overflow: hidden;
        box-shadow: var(--shadow-md);
        border: 6px solid white;
        flex-shrink: 0;
        transition: var(--transition);
    }
    
    .timeline-image:hover {
        transform: scale(1.1);
        box-shadow: var(--shadow-lg);
    }
    
    .timeline-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    /* Leadership Section */
    .leadership-section {
        padding: 6rem 0;
        background: var(--bg-light);
    }
    
    .leadership-header {
        text-align: center;
        margin-bottom: 4rem;
        position: relative;
    }
    
    .leadership-header h2 {
        font-size: 2.8rem;
        color: var(--primary-green);
        margin-bottom: 1rem;
        font-family: 'Georgia', serif;
        position: relative;
        display: inline-block;
    }
    
    .leadership-header h2::after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 50%;
        transform: translateX(-50%);
        width: 80px;
        height: 4px;
        background: linear-gradient(90deg, var(--primary-green), var(--accent-gold));
        border-radius: 2px;
    }
    
    .leadership-subtitle {
        font-size: 1.2rem;
        color: var(--text-light);
        max-width: 600px;
        margin: 0 auto;
        line-height: 1.6;
        font-style: italic;
    }
    
    /* Main Bishop Card */
    .bishop-card {
        background: white;
        border-radius: var(--border-radius);
        padding: 4rem;
        box-shadow: var(--shadow-md);
        margin-bottom: 4rem;
        border: 2px solid rgba(25, 123, 59, 0.1);
        position: relative;
        overflow: hidden;
        max-width: 1000px;
        margin-left: auto;
        margin-right: auto;
    }
    
    .bishop-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 8px;
        height: 100%;
        background: linear-gradient(to bottom, var(--primary-green), var(--accent-gold));
    }
    
    .bishop-content {
        display: flex;
        gap: 4rem;
        align-items: flex-start;
    }
    
    .bishop-image {
        position: relative;
        border-radius: var(--border-radius);
        overflow: hidden;
        box-shadow: var(--shadow-md);
        width: 300px;
        height: 380px;
        flex-shrink: 0;
    }
    
    .bishop-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: var(--transition);
    }
    
    .bishop-info {
        flex: 1;
    }
    
    .bishop-title {
        margin-bottom: 2rem;
        border-bottom: 2px solid var(--green-lighter);
        padding-bottom: 1.5rem;
    }
    
    .bishop-title .title {
        font-size: 1.1rem;
        color: var(--accent-gold);
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 0.5rem;
        display: block;
    }
    
    .bishop-title h3 {
        font-size: 2rem;
        color: var(--primary-green);
        margin-bottom: 0.75rem;
        font-weight: 700;
        line-height: 1.2;
    }
    
    .bishop-title .subtitle {
        font-size: 1.1rem;
        color: var(--text-light);
        font-style: italic;
    }
    
    .bishop-description p {
        font-size: 1.1rem;
        line-height: 1.8;
        color: var(--text-dark);
        margin-bottom: 1.5rem;
    }
    
    .bishop-quote {
        background: rgba(25, 123, 59, 0.05);
        padding: 2rem;
        border-radius: 10px;
        margin-top: 2rem;
        border-left: 4px solid var(--primary-green);
        font-style: italic;
        font-size: 1.15rem;
        color: var(--text-dark);
        line-height: 1.7;
    }
    
    .bishop-credentials {
        background: var(--green-lighter);
        padding: 1.5rem;
        border-radius: 10px;
        margin-top: 2rem;
    }
    
    .bishop-credentials h4 {
        font-size: 1.2rem;
        color: var(--primary-green);
        margin-bottom: 0.75rem;
        font-weight: 600;
    }
    
    .bishop-credentials p {
        font-size: 1rem;
        color: var(--text-light);
        margin-bottom: 0;
        line-height: 1.6;
    }
    
    /* Statistics Section */
    .stats-section {
        padding: 6rem 0;
        background: linear-gradient(135deg, var(--primary-green) 0%, var(--green-dark) 100%);
        color: white;
    }
    
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 2rem;
        text-align: center;
    }
    
    .stat-number {
        font-size: 3.5rem;
        font-weight: 800;
        margin-bottom: 0.5rem;
        font-family: 'Georgia', serif;
    }
    
    .stat-label {
        font-size: 1.1rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        opacity: 0.9;
    }
    
    /* Call to Action */
    .cta-section {
        padding: 6rem 0;
        background: linear-gradient(rgba(25, 123, 59, 0.9), rgba(19, 102, 47, 0.95)), 
                    url('https://images.unsplash.com/photo-1511895426328-dc8714191300?auto=format&fit=crop&w=1200&q=60');
        background-size: cover;
        background-position: center;
        color: white;
        text-align: center;
    }
    
    /* Section Headers */
    .section-header {
        text-align: center;
        margin-bottom: 4rem;
    }
    
    .section-header h2 {
        font-size: 2.8rem;
        color: var(--primary-green);
        margin-bottom: 1.2rem;
        font-family: 'Georgia', serif;
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
        background: linear-gradient(90deg, var(--primary-green), var(--accent-gold));
        border-radius: 2px;
    }
    
    .section-header p {
        font-size: 1.2rem;
        color: var(--text-light);
        max-width: 600px;
        margin: 0 auto;
        line-height: 1.6;
    }
    
    /* Buttons */
    .btn-primary-green {
        background: linear-gradient(135deg, var(--primary-green), var(--green-dark));
        color: white;
        padding: 1rem 2rem;
        border-radius: 50px;
        text-decoration: none;
        display: inline-block;
        transition: var(--transition);
        border: none;
        font-weight: 600;
        font-size: 1.1rem;
        box-shadow: 0 5px 15px rgba(25, 123, 59, 0.3);
    }
    
    .btn-primary-green:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(25, 123, 59, 0.4);
        color: white;
    }
    
    /* ========== RESPONSIVE DESIGN ========== */
    @media (max-width: 1200px) {
        .bishop-card {
            margin: 0 2rem 4rem;
        }
    }
    
    @media (max-width: 992px) {
        /* Mission & Vision */
        .mission-vision-container {
            grid-template-columns: 1fr;
            gap: 3rem;
            padding: 0 2rem;
        }
        
        /* Timeline */
        .timeline-line {
            left: 60px;
        }
        
        .timeline-dot {
            left: 60px;
        }
        
        .timeline-item {
            flex-direction: row !important;
            align-items: flex-start;
        }
        
        .timeline-item:nth-child(odd) .timeline-content,
        .timeline-item:nth-child(even) .timeline-content {
            margin-left: 8rem;
            margin-right: 0;
            border-left: 4px solid var(--primary-green);
            border-right: none;
        }
        
        .timeline-image {
            position: absolute;
            left: 0;
            width: 100px;
            height: 100px;
        }
        
        /* Bishop Cards */
        .bishop-content {
            flex-direction: column;
            gap: 3rem;
        }
        
        .bishop-image {
            width: 100%;
            max-width: 400px;
            margin: 0 auto;
            height: 350px;
        }
    }
    
    @media (max-width: 768px) {
        /* General */
        .hero-banner {
            min-height: 60vh;
            padding: 4rem 1rem;
        }
        
        .hero-title {
            font-size: 2.5rem;
        }
        
        .hero-subtitle {
            font-size: 1.1rem;
            padding: 0 1rem;
        }
        
        .section-header h2 {
            font-size: 2.2rem;
        }
        
        /* Mission & Vision */
        .mission-vision-card {
            padding: 2.5rem 2rem;
            margin: 0 1rem;
        }
        
        .mission-vision-card h3 {
            font-size: 1.8rem;
        }
        
        .card-icon {
            top: -25px;
            right: 25px;
            width: 60px;
            height: 60px;
            font-size: 1.5rem;
        }
        
        /* Timeline */
        .timeline-section {
            padding: 4rem 1rem;
        }
        
        .timeline-line {
            left: 40px;
        }
        
        .timeline-dot {
            left: 40px;
            width: 20px;
            height: 20px;
        }
        
        .timeline-item:nth-child(odd) .timeline-content,
        .timeline-item:nth-child(even) .timeline-content {
            margin-left: 6rem;
            padding: 2rem 1.5rem;
        }
        
        .timeline-year {
            font-size: 2rem;
        }
        
        .timeline-image {
            width: 80px;
            height: 80px;
        }
        
        /* Leadership */
        .leadership-header h2 {
            font-size: 2.2rem;
        }
        
        .leadership-subtitle {
            padding: 0 1rem;
        }
        
        .bishop-card {
            padding: 2.5rem 1.5rem;
            margin: 0 1rem 3rem;
        }
        
        .bishop-title h3 {
            font-size: 1.7rem;
        }
        
        .bishop-description p,
        .bishop-quote {
            font-size: 1rem;
        }
        
        /* Statistics */
        .stats-section {
            padding: 4rem 1rem;
        }
        
        .stat-number {
            font-size: 2.8rem;
        }
        
        .stat-label {
            font-size: 1rem;
        }
        
        /* CTA */
        .cta-section {
            padding: 4rem 1rem;
        }
        
        .cta-section h2 {
            font-size: 2.2rem;
        }
        
        /* Values Grid */
        .values-grid {
            grid-template-columns: 1fr;
            gap: 1.5rem;
            padding: 0 1rem;
        }
    }
    
    @media (max-width: 576px) {
        /* Timeline for very small screens */
        .timeline-line {
            left: 30px;
        }
        
        .timeline-dot {
            left: 30px;
        }
        
        .timeline-item:nth-child(odd) .timeline-content,
        .timeline-item:nth-child(even) .timeline-content {
            margin-left: 5rem;
            padding: 1.5rem;
        }
        
        .timeline-image {
            display: none;
        }
        
        /* Mission & Vision */
        .mission-vision-card p {
            font-size: 1rem;
        }
        
        /* Statistics Grid */
        .stats-grid {
            grid-template-columns: 1fr 1fr;
            gap: 1.5rem;
        }
        
        /* Buttons */
        .btn-primary-green,
        .btn-outline-green {
            padding: 0.8rem 1.5rem;
            font-size: 1rem;
            width: 100%;
            max-width: 280px;
            margin: 0.5rem 0;
        }
    }
    
    @media (max-width: 480px) {
        .hero-title {
            font-size: 2rem;
        }
        
        .section-header h2 {
            font-size: 1.8rem;
        }
        
        .timeline-year {
            font-size: 1.8rem;
        }
        
        .timeline-text {
            font-size: 1rem;
        }
        
        .stats-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="about-container">
    <!-- Hero Banner -->
    <section class="hero-banner">
        <div class="container">
            <h1 class="hero-title">About ELCK Southern Lake Diocese</h1>
            <p class="hero-subtitle">A vibrant community of faith committed to serving God and humanity through worship, evangelism, and holistic ministry.</p>
        </div>
    </section>

    <!-- Side by Side Mission & Vision -->
    <section class="mission-vision-section">
        <div class="container">
            <div class="section-header">
                <h2>Our Purpose</h2>
                <p>Guided by faith and driven by purpose, we serve our communities with love and dedication</p>
            </div>
            
            <div class="mission-vision-container">
                <!-- Mission Card -->
                <div class="mission-vision-card">
                    <div class="card-icon">
                        <i class="fas fa-bullseye"></i>
                    </div>
                    <h3>Our Mission</h3>
                    <p>To make disciples of Jesus Christ by teaching and preaching the word of God, both Law and the Gospel, to all people, according to the command of Our Lord Jesus Christ in Matthew 28:18-20.</p>
                </div>
                
                <!-- Vision Card -->
                <div class="mission-vision-card">
                    <div class="card-icon">
                        <i class="fas fa-eye"></i>
                    </div>
                    <h3>Our Vision</h3>
                    <p>To proclaim the Good News of the crucified and resurrected Christ, the only way to salvation.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Dynamic Timeline -->
    <section class="timeline-section">
        <div class="container">
            <div class="section-header">
                <h2>Our Journey</h2>
                <p>A timeline of our faith journey and milestones</p>
            </div>
            
            <div class="timeline-container">
                <div class="timeline-line"></div>
                <div class="timeline-dots" id="timelineDots"></div>
                
                <div class="timeline-items">
                    <!-- Timeline Item 1 -->
                    <div class="timeline-item">
                        <div class="timeline-content">
                            <div class="timeline-year">1948</div>
                            <p class="timeline-text">The Swedish Lutheran Mission begins work at Itierio, Kisii County, planting the seeds of Lutheranism in Kenya. This marked the beginning of organized Lutheran ministry in the region.</p>
                        </div>
                    </div>
                    
                    <!-- Timeline Item 2 -->
                    <div class="timeline-item">
                        <div class="timeline-content">
                            <div class="timeline-year">1963</div>
                            <p class="timeline-text">Formally registered as the Lutheran Church of Kenya (LCK) as Kenya gains independence. This was a significant milestone in establishing our national identity.</p>
                        </div>
                    </div>
                    
                    <!-- Timeline Item 3 -->
                    <div class="timeline-item">
                        <div class="timeline-content">
                            <div class="timeline-year">1996</div>
                            <p class="timeline-text">Adopted Episcopal polity and elected first bishop, establishing the episcopal structure that guides our church governance to this day.</p>
                        </div>
                    </div>
                    
                    <!-- Timeline Item 4 -->
                    <div class="timeline-item">
                        <div class="timeline-content">
                            <div class="timeline-year">2002-2003</div>
                            <p class="timeline-text">Major restructuring occurred, converting deaneries into Dioceses. The church now has nine dioceses and an Archdiocese, expanding our reach and impact.</p>
                        </div>
                    </div>
                    
                    <!-- Timeline Item 5 -->
                    <div class="timeline-item">
                        <div class="timeline-content">
                            <div class="timeline-year">2020</div>
                            <p class="timeline-text">The Most Reverend Dr. Joseph Ochola Omolo installed as Archbishop of the ELCK, bringing visionary leadership to our national church.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Statistics -->
    <section class="stats-section">
        <div class="container">
            <div class="section-header">
                <h2 style="color: white;">Our Impact</h2>
                <p style="color: rgba(255, 255, 255, 0.9);">Reaching lives and transforming communities</p>
            </div>
            
            <div class="stats-grid">
                <div class="stat-item">
                    <div class="stat-number" data-count="50">0</div>
                    <div class="stat-label">Churches</div>
                </div>
                
                <div class="stat-item">
                    <div class="stat-number" data-count="25">0</div>
                    <div class="stat-label">Active Ministries</div>
                </div>
                
                <div class="stat-item">
                    <div class="stat-number" data-count="350">350K+</div>
                    <div class="stat-label">Members</div>
                </div>
                
                <div class="stat-item">
                    <div class="stat-number" data-count="75">0</div>
                    <div class="stat-label">Years Serving</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Diocese Leadership -->
    <section class="leadership-section">
        <div class="container">
            <div class="leadership-header">
                <h2>Diocesan Leadership</h2>
                <p class="leadership-subtitle">Meet the dedicated servants leading our community</p>
            </div>

            <!-- Archbishop Card -->
            <div class="bishop-card">
                <div class="bishop-content">
                    <div class="bishop-image">
                        <img src="https://international.lcms.org/wp-content/uploads/2020/03/ELCK-Archbishop-2.jpg" alt="Archbishop Joseph Ochola Omolo">
                    </div>
                    
                    <div class="bishop-info">
                        <div class="bishop-title">
                            <span class="title">Archbishop</span>
                            <h3>Rev. Dr. Joseph Ochola Omolo</h3>
                            <span class="subtitle">Archbishop of Evangelical Lutheran Church in Kenya</span>
                        </div>
                        
                        <div class="bishop-description">
                            <p>Archbishop Omolo serves as the head of the entire national church and provides spiritual guidance to all nine dioceses of the ELCK. His seat is the Uhuru Highway Cathedral Diocese in Nairobi, where he oversees the church's national operations and ecumenical relationships.</p>
                            
                            <p>Before becoming Archbishop, he served as Bishop of the Lake Diocese, demonstrating his extensive experience in church leadership. He was installed as Archbishop in January 2020 and continues to provide visionary leadership to the Lutheran community in Kenya.</p>
                        </div>
                        
                        <div class="bishop-quote">
                            "It is a privilege to serve the people of the Evangelical Lutheran Church in Kenya. Our collective vision is to maintain and build a living, breathing community of faith that extends Christ's love to every corner of our society."
                        </div>
                        
                        <div class="bishop-credentials">
                            <h4>Education & Background</h4>
                            <p>Doctor of Divinity, University of Oxford. Served in North Point for 15 years before becoming Archbishop. Previously served as Bishop of the Lake Diocese.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Diocesan Bishop -->
            <div class="bishop-card">
                <div class="bishop-content">
                    <div class="bishop-image">
                        <img src="data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wCEAAkGBxITEhUSEhIVFRUVFRUVFRUVFhUVFRUVFRUWFhUVFRUYHSggGBolHRUVITEhJSkrLi4uFx8zODMtNygtLisBCgoKDg0OGxAQGzUlICUtLS0vLy0uLS0vLi0tLS0tLS0vLSstKy0tKy0tLy0tLS0tLS0tKy0tLS0tLS0tLS0tLf/AABEIALoBDwMBIgACEQEDEQH/xAAbAAACAwEBAQAAAAAAAAAAAAADBAIFBgEAB//EAEIQAAIBAgQCCAMECQIGAwEAAAECAAMRBBIhMQVBBhMiUWFxgaEykbFScsHRFCMzQoKSsuHwYsIVNFNzovEkQ5MH/8QAGQEAAwEBAQAAAAAAAAAAAAAAAQIDAAQF/8QALhEAAgIBAwIFAwIHAAAAAAAAAAECEQMSITEEQRMyUXHwImGBBVIUI0KRobHB/9oADAMBAAIRAxEAPwC1RYZVnUWFVZzHQeVYVVnlWFVYQHlWTCSSrCKsJiKrMx0yfO1LDD99gz/cXtH6AfxTW5ZieGVRiOK1SLlaVMICe/O2a3rTt6TUY2eDoZUVe4a+fOMhZ1VhAkIAeWdywuSeCzGBZZ0JC5J0LMYFlnssMFgcTXVd9+QgbSVsyTeyIVLAEk2A1JOgHmYrhsfRqHKlRGI5BgT6DnM90xqO6Lc9klhlGxNha/fzmPwxym6aG1wRpYgi22vfGhU0mu51Q6a4Nt7o+uZZ4pEcLxHbNqDYhhvY7XEshqLjUHYxIzUuDnlBx5AFZwrGCsjlhFAFZArGCsgVmCLFZErGCsgVgML5Yi66mWmWIVBrEmNEWZYNljBWQKyY4qywbLGmWCZZgCjrAskcZYF1goxcIkKqzyrCqsuIeVYVEnVWGVIQEUSGCSSpCqkJgLiwJ7heZjoDwwLTNY3z1alW9/sgUmX3qOfWanHC1Koe5GPsZW9DsGyYakGNzkLEnXVmt9EErHyv8CvkukSECyWQ6W9YQJEMCyzwSHyTwWajWC6ueyQ2WcewBJ0AFyfAbw0YQ4hiRTXvY/CPxPhKMMSbk6neTr1jVcsfIDuHIToSeRlzvJLbg9LFh0R35KjpOP1SHuqgfNXP4CYqibFfUH+Uj6zbcdr03p9WHBbMGHdoCD9eUydTAlWB6xNXvY5hpe+5Ftp6vTQl4cbXcvij5tjZcLN6NP7gH8ot+EtOH4nIcp+E+3iJVcC/Yqulxm0uNixIOnKPuLCeblk8eWVdmyLgpRpmgKSOWD4TUzU7HddPTl/nhGis9CElKKaPOktLoXKyJWHKyBWEwuVkCsYKyJWYwtliFRdTLXLK+qup85OY0RUrIFYwRBsJMYXZYNljDLBssJhVlgmWNMIF1mAXCrDKs4ghlEsIdRYdFnFEKkJjqrCqs8ohAIUYrOO4lFpOhYBmQhV5m+g0HiY9hsIKWVOQpqoJO5DVGa1+YzCZ3jGGWtjKKEH9og8CBqwl9xbKpw62N+uzAffsSxPgWt6yqX0Cdx8CSAnVWStEsJyeE8RPLNYD1ojxtGNB8m9gfMAgt7Ax+RvBKOqLXqGLppmB/wCIimuZ/Tl/6HjKDE8Zq4hsqGyDc7D0/wAvttHenXDyKvVLojDMvgC23ob+iiVQQKoUaKPfxPfOfDhjghb3l8+M9lZI6dXd8HFxFND2UNQ8yTYfQ3+XrJNjyfiorb5H3BjmCpg7AHxjj4a3KOp5HvZGWVt22IYKoL3plkYa5Tsfun/PSXvDuL9acjaMvv8A30lS1MHS1u7lK/FVDTqZx8SWD20urfC3zBHmBDOCzR0y59R8eTxHT57H0nhlTK33rL+X+eMtyJmOjWI68qw2WzN3aar8yBp4GagxMEZRi4yODqK1kCJAiGIkSJYgByyLCFIkGEAQREraw1PnLUrK6supiT4HiLEQbCMFYJhJjACJBhDESDCYwsywTCMNBsJgNFuoh0WQRYdBLiElWEVJ5RDoIaNZHJCKsmohFWagWVDs9KurCmjF37JZyu6qCNFPcD6QVJMRVxKtUphFpOVYBg6XFNcuRrAkXtyBlu9ENVp6Xyhz5XQi8jwtrio32q1U/Jyo+kr/AEijirJET0lFoFgTOFZ0rJCBILYMiRYQjrtr5+MhUhMZrp5hb4V6oF3oqzDvykEMPcH+GfOuLUSFVApewAsNM1hqSe715zadPXqmrQQO60mV8wUkB2NlyvbcActu1KCrRzFgCb30tIZWdmFNx5KfD/qlputPq89j2SRoTbto2o+se4tjWKrlLamxC2U3sdcx0AMniKCrrUdbA6k6AcrC5ux5XjOehdV61Cx2UnLcW3UHciI5NyKxhUSl4ZiQAGyVUDNlGd84zW1Guo3tfa+3gTiCMcUqqCetoOthzZWGT1u/vLzCYE8vg3OpK+gOxiWOqPSqUsRSI6xGK6jNdGILKB45d+Uop1KxEmqrk+g9F+Efo1Baf7x7TnftNqQD3DYf3lzaCQwt5Q45Scm2zk4ROzs1ABESJWFIkSJjAyJXVxqZZ2ldXGpiTWw0WLkQbiGaDaSHAMIFow4gGmMDIg2EKYNpqBZdIIwogkEMsuIEUQ6CCQQyxkAIghBILJ3hFJYdL1b8gv1vEeB60Qe9qh+dRjK/il+ubtMAKY0DEDcnkdd5Z8FFqKeR/qMVZE3pGcKjY7aStOTscQhadnp2YxEiCeGME8Biq6Q4A1aNlGZlZXUc9Drb+EmfNsVXKVAB/gmt6TcdLM1Cix7IGdlNrsxAVARy1ue/yvfIceXKxB3FrHwOo95Cck5aTrxJxVsqMZjDiWamgpqEa3WMudv9WQDbuveco4I0CaiilUC2z03pZeyNbltcr3ub2tLA03qU/wBQ4RxrqoKnwI7vEQuBXFg3xFSllt8NNTcnzJOkdJJDSbbOU+OF7VKeiOASDpYkG4+nzmk6MYQVKuZhcJ2rEaZzbL8u0fMCZHNeq17BVJa3Lvm96HY1amHFhYhmv43N1b1FvlEpagScnE06GGUxSm0YQy5zMKJ604slMKeIkGEJImYyIWlbiPiMtLStxI7Rk8nA8eRZoJoZhBvJUOBeBaGMEwmRgRg2EI0GYwC9SGWBSGWUFDJCqYBTCqY4oYGTEEDCCYBR8S/aVT3Bfost+D/saf3QfnrKniH/AN58VHsPylxw1bUqY/0L/SJDH5387lp+RfOw1eenJ286CBEzxM40gzAC52AuSeQ5mYxImUHSTj9OjTZVqKapITKCCy579ogajS/raZnjvTKurFqRAUsy01Ki5CaFmLA792kxON4gXqmqV7bHVid9TfViAupOx57RJS7Lk9Xo/wBPlNqclsargWCLYgm3ZUJryJygA+ljK7pM2etVQfEopst/3kemrAjvF8y/wzSdFqLCo97WVKYGoN9ai308jLPD4GhWpqGpqxRclyO0LbgMNVFx3ys+nSTa5ZzZMyWR3wfKMPjWXRlYHwv9QD9I3+mFv/ZJPpl/GfRH6IYQnWmw8mJB+d41g+jWDTUUsx/1szD+Um3tFWN9ybzLsfP+DcFqYjMoDLnVlzWvlDKQWY7C3cZddF+Iii6UqlgW/VkjYuNtfG1x/FNhxKvkplUAFxlAAsLnQWnz3pfw8h64W9706y2vcG4QWsN9GlFgTi/Up07WTJofD2PpqGHQzA9GulVYKoxa6EhFcCzXtpnF7Em3K3rN3h6oZQym6sAQe8GREz4J4ZaZDSwggkMIsJznZwz04ZgHpW4n4jLGZ2jxPPUZHABzMBbnlJFjfnpEnwUhFu2MtBPCtBNJjgKrgAkmwAuSZSU+PI9UKvwbZiCDf8BylZ0r46CDTpnRSMxAvmJ2A8PHviPR/As1VVI7GtRje+ikWU+ZI9AYt70i8YLS3I2jQZhGgmjHOXqQqxdDDKZUQ7+koGyllzWva4vbygsLxei5sGsTtmFgfIzGdIcS3WuyDVTZqZNi1tmBOxIHlKEYltOqa97Zqbba6nXdPpFc6Z0rAqtn2RTCrPm/COkNWkQrNa+1J9b/AHCDr6TW4PpLRY2qXpnT4tVueWYfjaGM0yU8Ekc4i/Yrf9y3/i35S9wwsijuVfpMxxWt/wDHqup3qsbjUWGYXHzgejPSF3qJSNnVgcrXuwIF/UESWJ/W/ndjTg3C12NiJ6RBkXedJzAsfXKIzhSxAuFGhY8heYXivSl6zpQC9XqTUAOYtYEgXAtYecuumXGko0ihNi+53yr4DcsTpbzOkwHC0fFVSlGkwBGrkguV2PguoYekSUlH6m9j0ujwxcXOS9vt9yt4xUDJTAOqggixDXdVIIU2JHZbX+0r8PxBkBpE9l97aFWPPb5iWHGuC1kNOy9mnTDErYEBj4HawErcPg1qEr1qIRsKpIUnuvqL+cbLGpuj3+kvwVR9K6H1FNbQgmpRRgBfZSe//uCavgqBVYkfvMPDRmG8+bYTEVKTU0pkE9RbTYqop5jdSNBcbeUPSxmZvgQsuuiHfzze5nZKuGzw5fp2XM3OPFs+mt1f2lHhnA/GCOIoDerTH8a38t5hKTPawS27DUc9NNZGu1YaIpuDcXyi3fl03gUY+oq/SsvqjU8Wx1BnpqKtOwcMxzryNwu++nt4zL9JsVSz1KnXhVCUlzoVbUOzHTW5sBaUL4rE2LdUSAxscqGx5ggD3iKY4VKVbPYFHXQqLW1AulxzMNxSpMvi/TZ4Zqcmqtce5HFcZpVCiKzUkRg4d9czhh8Qv3X3P5TU8B6TspX9YppAtdWIXTMfhzajXb5GfM3rMxJJ3PkPlLnBYUVKJZSc6sQAo1bQFB4nNOdbp37nb1eJNa37cep9ywPEKVUZqbqw8CLjzHKPKRPgOHfEUXDJnuCcpymxFrjMttrEajlebPAcZFVA2qNsyG4KtzHiO4ySknwzxcvSOPDN3xrHPTS9JVZr7OxUW56gGI8E4tXq1MtWnTUZb3RyxvpYG4HKZc4w33LaHS8uuAVh11r6lTp3WA/OGk97JSx6Y8GoYzB4lurxbEnQVidzs5v5bNNw7TBcdpEYuqDswRx/Ll+qmTyukHplcmvsaPF4tKYu7BRyudT5DnMzxTjJqgrTJVT/ADNfke4eESYa8reUTqrr5Eel95zykzrhhUXvuK8QS6lW0OgDKbXB2GXvBG4POX/Q6i2R3axuwRT3hL3PzJ+Uqq2DarUFKmRdx2j/ANNRu3vp4zYYfDrTRaaCyqAAPKNCPclnlX0ok0G0mxgmMocpcKYVWmNxHTMLVFJMLiHJOUnqyuUg9oWO9hrcaaiaunWB/KUA00JdJ8GlSiWKkstrOvxKOZ03HhMLilAqKW0Ci4qrpa/IkbD2n09GlFxfo1n7VAqpJuyH4W8iPhPtFlG+C2LIkqZS8NAK5i4fXsNYDT0+shjGJZb7a38gRrC4WnkL02Tq2vcqbW+8Lcj3weNQjKbciD6m8izq7GpyWwiDl2/YD85S9EsLkr0UA+FCSbfuhMv1Ilximtg08qn0EF0JpXz1eWVUB92/2xcG8vwiM3UH+TXXlX0g4umGotVbW2ir9pj8K/54yxvPm3HlbHYx0JK0MOclwbXqCxbLpoQdzyCjv065zUFbI9PiWSdPgyWNxNXEV89QlmYMMoBJUsNLKt7AEgC/2TczY9DsAUDNVUgFuyqsSbDvNu60fwWHp0gFoUhbvPYQXNzYasdzytrvGDQUCzZVXQhQMo00FlBueWhNtBpOKeVzVPZHpzzJR0ooOLYW9TLQQqy1DqDnbKxucyjYW77DW8JiujFWs13NIKR8LoHdT4NTI/qmmwtK+irYfL/xGg9ZZLhwF7QBJ5chOuM8mXyrb1ZJdfLDDRExicHBFNEL1TRVkZlARSCRopbQ2C20b5na1ocFqAaUqgB7VrUN+49vWaCjRAG0sQ4nYnpVcnG+uzcJ0jJNwaub9ltufVD59r3gH4dXJylG25MLX0sN5s6qk7QJv3esbWxf4zN+5mP/AOD4hdEFr9rVl1PPnF6XAnUkvSDqc2cXBYhrFtb30Kgi32Ra02oUlj4AD5kwNQamZvUqYH1mb9zMPxLoVQqfC9SnYWFsjKPQi5+cQwfRbE0M3VvTqDskGwV7oSdQQe/kZvKtPS/MaedtvaKM9t9J585ZcMr5R1x6yeSLjJiCYAqtyVvrYaZgpOYA91r2t4RDFYAMcyqM+23xC5NvmTL5rHex94CphhupIPt8p52lxlqiOsnZmSaoo+Ei5FtDLzopWvXU31Kt9B+UrOkeDYVM6qQrC5tqqsN9eQPj4w3Qqreqt+QYe07FNtoE0njb+x9AJmP6XjK6Vj8I7DeGaxU/O49Zqy0yPToE01HLrVv/ACtaXyK4nDidTRWMofUHbl+MFiKiU1LNsBEP0hqWtrjnb8BC8AwhxT9fUuKVNuwh/fYbk+A7u+cyVs9CU1GNmh6PYUrTzsLPU7RHNV/dX5a+Zlm5kC05mljgk7dnGMExk2MExmFMHxvH/ozNXUMGzP1eZ3ZVL6M2UEDY/MDkJLoxxtqKIuQVM75mqmoTcOX6tGA+F7rbXQHeV/TLiJXq6a69W61HfLcIRcAaixOvjtGeFVmApKKIfrFzVKh3qWZiMuW40OU3t+/fQ6ScXph92duaEY5fCTtbfPwfV1xYy3OkbSsJj6GPuBrsOfIy4wVe/OVjkT4OOcHF0yy4pw5K62OjDVXG6n8R4TGY96tI9XWWxJsrbq/K6n8N5t6VSUnTeswoIFF718OD5GqgJ9xGlDUNiyuDrsG4wbYQfcf/AD2nuh4NPDUz9oBiD/q1HlpaR4zT6yitO9s6Mp77MTf2jyaIANtIvRxu37L/AADPLZI7X4y92XKEtzJuQO/uHvKenWQWCAv93Y95LnfxNyZZcRwS1AuYag6Ei4vYnUbHbnFcPmF+zrsbXbblfSDPiyX6oOOca9AlOk5+Jso7k39WP4WkqFNc2VRruW3PzO5ksDeoCXVkANrG1z46E2EbRr6ILAafn9Y2HpN7n/YE83aI5h1sLbD6+cMwg8POYipsJ3HOGrnTTuE6o03i2KqWy+LAfMwtQQAJitYyYqE87RUQ67TAJUOevOCZpKk2l/OAZoUgkX1uPC/yP94ljKRYafEL2/v3iHNTtp43HtCulwSNxr8oWk1TAnXBSAMovbzHL07p39JzA5dxuDuPMRlTqQds34AwNfBKxuNDyI0IPmJwZej7wOqGftIimIB0PZbu5Hy74tQwaUqvWooU63A0Vri237p8vlJVcI2zguPtAWYedtD8vSLvSrIQFPWKTazaOvjfY+tvOcmicXwXUk1szQU8cjDQ6/ZO/wDeVPHaDVaFQDVviXxZSCB62t6xjDYYAX3PM/gO6MldLienCD0/VyccpJS+k+W8QxPYuDa+9+U1/RsAYWiFNwUDX783a/GYX/8AoGAdKzIuiVe0ul9z21Hr7ETc9H8IaWGpITcooQ+mkkumlCLkzoyydRfZlkTOFpG8gzSZImzQTGeLyLGAx8dHSGrUCUqgQhczADMqt2Sf1lj2rMA2u5US24bjurZadGllq51RwGzLmGctfdRuouuvZPhfOcPwhqZqjZmC2YhSCbX1OUg6WzG+lt5c9RVpVagVirq40bMQ/aTI4tYhluNx7xZ6U6QdcpTt7/7N5g77FctiQBcEEDZh4GX+AmM6M4XEJdarBlsCvazEG5uL72m04aIuJK3Q+SWrcu8PF+LKGWx71PyOb8ozT0ESxD3v6zsitm/sQ7oHiT+z8vzMbQXVfOVuIftIO5fwj9CpoPCJ0Xkfv/xB6jzIni6u3g3+0+H5fhK7DPkIP2zc68zoD7AeohsUdQfBvwEgwvlU7FWB9bWO/wCHrO5EBx6tgfnG6K5UXvtc+Z1lVQqF1A53ynzvaW9TSBhQRG0gFe7X+U5WqWFpzDjUQBOY5+1SB/6l/krfmJYVWlbjP29Ffvn5Zf7x0G5JmfYBwNrDlrRInWTrVND5QGCK3ZHl9YKodJNtrekBWbSMjA01KnuIMZDdl/X6RTBnU+RhGf44WATxTWZf9X4A/wBodG1v3WPuBEeN1svVseT2PkRb8oTrhY2PKbsYexbCw7ztaASjcFrDNYgeA5C9ie7lFsbXIIPco943h6t1BGxHv/gi0MDSrdQbEXF9QQdeRBAI9RDUvhiGHXKpXkHYDSwsWuLAKotryvtuTeOo2kzMym6QcJWsaLka0qofzXmPnlPpGMGOxbv/ABjp1uO8RNTl09JrtUZyewuxtpIM0LihzipacU46XRVO0eYyJeRYwbGIE+b4XhT06tOlTc/rGXIzXORd2BWwve3lNjT4AFxLVxYFlAsBZc2zEDkLASv4Sl8dQB3VXufuhh+M0HShT1LBCQzFQts175hp2ddrxYw8RpPuCUqV+g3gsEe6XuEoZZmeg6utKotVyzdYWAYsSEsALZuVwZoxXlnjWN6UxVPWrG69Sy+ekUfYyNSrcjwH1nnaVarE39mZeZC+If8AWgdyj3jVIytzfrCY/RaT6Bfy37sPUeY5Xa7EfZXfxbX/AGjw18IDrdQfA/hO0qgylvtEne+mw2JGwG0SrOfled5EsuDG5/iY++ktqrym4I9gPu/nG6tXMfCK1uZBesubxiidYosPSMzCgavmxJP2KYHqxJPtaWKGVGAqLnqEblzf+Hsj+mPGpFlyY5n1ksS2w7yB8zAJvJVDdl+fyEwBio8XqtoZ6u8Cz6RkjHsK+p8jOYmtYn0i9GqM2h8IHFV+0Ra9t7Rq3AK9KcYiomdsodwgJ2DFWIv3aic4biMyeNrHz5yt6aEPhiGHiB5A/nEuDsaOTUlGsNTfKeXpOd51GehlVi1Q1I1zm+U96iFwVSy27j7RXDvdV8Lj5aTyPYnzlmTQUP23Hgp9rX2/09525Q61JXYqrlK1NLDstf7JO9ywCgGxOhJjAqQUFjGbWK4k6wmfWBxBuDbflAYg9XTWJMZBX113nGac+flD4zzNBs04xgmac5Qr+HpbiIP7pGIC7fEH/K8tuMVV61A1rbi9hzINrnwEpV/5vCffxX9VWR6cftU+7+JnR0ePXNR+cHN1WTRCy94ZjlNRUUi5zXAN+RMfqVDmmL6Kf8yn3X/pmxf4pTq8eidL0E6TI5wt+o6abNYrb1Nr+0DUNQHtLYWOu4v5iPYTaD4sf1Y+/T/rWRcnKOn1OlbOyoq1gr676j6Rv9I00Op/wnce0z9eozVCWJOr7kn7MdoGV6fH4S0cgnLX9RaVasRrnsseZ0Hfqbc9ecm23y+shX3T7w+hnSTF8fxU0adMqMzsyoFva+va9gfaWeB4n1lPrEBZbldRYhlNivnfumQvfFgHUCmCL62JY3I7th8ppOj+mHp251cRf/8AWpOXxm8rj2Rbw0oJl1Txije9+6HXF2/dPyi+QZb2H+CRwbG255fSWjLUSaoBguzUfuYlh/EbkehJ9paCsB4mQxQHY+8JKpDJ2ZIGK5vOtVJIyi51i7HWSQ7+kyASqBidTA1dBvFqrm+5gxvKAJ5yNV2gauOSmLu1iT47x4j9UPMym4kPj+59LGTc206Ckr3EOOYo1kY2soUgd/iTD0KQaiAe6K4j9i3lHeG/s18p4s5uW7PRSUdkH6P4wkNSY9pCD5qdj7R+o1mvy2P4Ha5/vM/QNsUttOXsZd4gX0OoO4756fTZHPHv2OPNFRnsFaqIBcTl03A2328b84u50HlKviVQhdCR5G0vJ0iaVl0/ElEHUxxOwI8/ymY4dULOMxJ8zfnL4zl8fVwijx0EG973MizyEi0k23uxkqOs0C7TzQLxQn//2Q==" alt="Bishop Moses Okoyo Keya">
                    </div>
                    
                    <div class="bishop-info">
                        <div class="bishop-title">
                            <span class="title">Diocesan Bishop</span>
                            <h3>Rev. Dr. Moses Okoyo Keya</h3>
                            <span class="subtitle">Bishop of Southern Lake Diocese</span>
                        </div>
                        
                        <div class="bishop-description">
                            <p>Bishop Keya provides spiritual leadership, pastoral care, and guidance to congregations within the Southern Lake Diocese, ensuring that church teachings and sacraments are faithfully observed. He oversees administrative duties, clergy supervision, and community programs, promoting growth, service, and governance within the diocese.</p>
                            
                            <p>Under his leadership, the diocese has seen significant growth in membership and expansion of community outreach programs. He is committed to nurturing spiritual growth and fostering unity among the congregations.</p>
                        </div>
                        
                        <div class="bishop-credentials">
                            <h4>Responsibilities</h4>
                            <p>Provides spiritual leadership, pastoral care, clergy supervision, administrative oversight, and promotes growth and service within the Southern Lake Diocese.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="cta-section">
        <div class="container">
            <h2 class="display-4 mb-4">Join Our Family of Faith</h2>
            <p class="lead mb-5 fs-4">Experience God's love in our welcoming community. Whether you're exploring faith or looking to grow spiritually, there's a place for you here.</p>
            <div class="d-flex gap-3 justify-content-center flex-wrap">
                <a href="{{ route('contact') }}" class="btn-primary-green">
                    <i class="fas fa-church me-2"></i> Visit Us
                </a>
                <a href="{{ route('ministries.index') }}" class="btn btn-light btn-lg">
                    <i class="fas fa-hands-helping me-2"></i> Get Involved
                </a>
            </div>
        </div>
    </section>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Animated counters for statistics
    const counters = document.querySelectorAll('.stat-number');
    const options = {
        threshold: 0.5
    };

    const statsObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                startCounter(entry.target);
                observer.unobserve(entry.target);
            }
        });
    }, options);

    counters.forEach(counter => statsObserver.observe(counter));

    function startCounter(counter) {
        const text = counter.textContent;
        let target;
        
        if (text.includes('K+')) {
            target = parseInt(counter.getAttribute('data-count')) * 1000;
        } else {
            target = parseInt(counter.getAttribute('data-count'));
        }
        
        let count = 0;
        const duration = 2000;
        const increment = target / (duration / 20);

        const updateCounter = () => {
            count += increment;
            if (count < target) {
                if (counter.textContent.includes('K')) {
                    counter.textContent = Math.ceil(count/1000) + 'K+';
                } else {
                    counter.textContent = Math.ceil(count);
                }
                requestAnimationFrame(updateCounter);
            } else {
                if (counter.getAttribute('data-count') == '350') {
                    counter.textContent = '350K+';
                } else {
                    counter.textContent = counter.getAttribute('data-count');
                }
            }
        };

        requestAnimationFrame(updateCounter);
    }

    // Dynamic Timeline Functionality
    function initTimeline() {
        const timelineItems = document.querySelectorAll('.timeline-item');
        const timelineDotsContainer = document.getElementById('timelineDots');
        
        // Create timeline dots
        timelineItems.forEach((item, index) => {
            const dot = document.createElement('div');
            dot.className = 'timeline-dot';
            dot.dataset.index = index;
            
            // Calculate vertical position for dot
            const itemRect = item.getBoundingClientRect();
            const containerRect = document.querySelector('.timeline-container').getBoundingClientRect();
            const relativeTop = itemRect.top - containerRect.top + (itemRect.height / 2);
            
            dot.style.top = `${relativeTop}px`;
            timelineDotsContainer.appendChild(dot);
            
            // Add click event to dots
            dot.addEventListener('click', () => {
                scrollToTimelineItem(index);
            });
        });
        
        // Intersection Observer for timeline items
        const timelineObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    
                    // Highlight corresponding dot
                    const index = Array.from(timelineItems).indexOf(entry.target);
                    const dots = document.querySelectorAll('.timeline-dot');
                    if (dots[index]) {
                        dots.forEach(d => d.classList.remove('active'));
                        dots[index].classList.add('active');
                    }
                }
            });
        }, {
            threshold: 0.3,
            rootMargin: '0px 0px -50px 0px'
        });
        
        timelineItems.forEach(item => {
            timelineObserver.observe(item);
        });
        
        // Function to scroll to specific timeline item
        function scrollToTimelineItem(index) {
            if (timelineItems[index]) {
                timelineItems[index].scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });
                
                // Highlight clicked dot
                const dots = document.querySelectorAll('.timeline-dot');
                dots.forEach(d => d.classList.remove('active'));
                dots[index].classList.add('active');
            }
        }
        
        // Add keyboard navigation
        document.addEventListener('keydown', (e) => {
            const activeDot = document.querySelector('.timeline-dot.active');
            if (!activeDot) return;
            
            const currentIndex = parseInt(activeDot.dataset.index);
            let newIndex;
            
            if (e.key === 'ArrowDown' || e.key === 'ArrowRight') {
                newIndex = Math.min(currentIndex + 1, timelineItems.length - 1);
            } else if (e.key === 'ArrowUp' || e.key === 'ArrowLeft') {
                newIndex = Math.max(currentIndex - 1, 0);
            }
            
            if (newIndex !== undefined && newIndex !== currentIndex) {
                scrollToTimelineItem(newIndex);
            }
        });
    }
    
    // Initialize timeline
    initTimeline();
    
    // Fade in animations for cards
    const animateOnScroll = function() {
        const cards = document.querySelectorAll('.mission-vision-card, .bishop-card, .timeline-item');
        
        cards.forEach(card => {
            const cardTop = card.getBoundingClientRect().top;
            const cardVisible = 150;
            
            if (cardTop < window.innerHeight - cardVisible) {
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }
        });
    };
    
    // Initialize animations
    document.querySelectorAll('.mission-vision-card, .bishop-card, .timeline-item').forEach(card => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        card.style.transition = 'all 0.6s ease';
    });
    
    // Run on load and scroll
    animateOnScroll();
    window.addEventListener('scroll', animateOnScroll);
    
    // Handle window resize for timeline dots
    let resizeTimeout;
    window.addEventListener('resize', () => {
        clearTimeout(resizeTimeout);
        resizeTimeout = setTimeout(() => {
            // Reinitialize timeline dots position
            const dots = document.querySelectorAll('.timeline-dot');
            const timelineItems = document.querySelectorAll('.timeline-item');
            const containerRect = document.querySelector('.timeline-container').getBoundingClientRect();
            
            dots.forEach((dot, index) => {
                if (timelineItems[index]) {
                    const itemRect = timelineItems[index].getBoundingClientRect();
                    const relativeTop = itemRect.top - containerRect.top + (itemRect.height / 2);
                    dot.style.top = `${relativeTop}px`;
                }
            });
        }, 250);
    });
    
    // Parallax effect for hero banner
    window.addEventListener('scroll', () => {
        const scrolled = window.pageYOffset;
        const hero = document.querySelector('.hero-banner');
        if (hero) {
            const rate = scrolled * -0.5;
            hero.style.backgroundPosition = `center ${rate}px`;
        }
    });
});
</script>
@endsection