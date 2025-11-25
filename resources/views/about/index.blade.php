@extends('layouts.app')

@section('content')
<style>
    .about-container {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        color: #333;
        line-height: 1.7;
    }
    
    .hero-section {
        background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
        color: white;
        padding: 6rem 0;
        text-align: center;
        position: relative;
        overflow: hidden;
    }
    
    .hero-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 100" fill="%23ffffff" opacity="0.1"><polygon points="0,0 1000,100 1000,0"/></svg>');
        background-size: cover;
    }
    
    .section-title {
        color: #1e3c72;
        position: relative;
        padding-bottom: 20px;
        margin-bottom: 50px;
        font-size: 2.5rem;
    }
    
    .section-title:after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 100px;
        height: 4px;
        background: #2a5298;
        border-radius: 2px;
    }
    
    .mission-vision-card {
        background: white;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.08);
        padding: 40px 30px;
        transition: all 0.4s ease;
        height: 100%;
        border-top: 5px solid #2a5298;
        margin-bottom: 30px;
        opacity: 0;
        transform: translateY(30px);
    }
    
    .mission-vision-card.visible {
        opacity: 1;
        transform: translateY(0);
    }
    
    .mission-vision-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 35px rgba(0,0,0,0.15);
    }
    
    .leader-card {
        background: white;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.08);
        overflow: hidden;
        transition: all 0.4s ease;
        margin-bottom: 40px;
        opacity: 0;
        transform: translateY(30px);
    }
    
    .leader-card.visible {
        opacity: 1;
        transform: translateY(0);
    }
    
    .leader-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 35px rgba(0,0,0,0.15);
    }
   .archbishop-section {
  display: flex;
  justify-content: center;
  align-items: stretch;
  padding: 60px 5%;
  background-color: #f8f9fa;
  gap: 40px;
  flex-wrap: wrap;
}

/* IMAGE COLUMN */
.archbishop-image {
  flex: 1 1 400px;
  display: flex;
  align-items: center;
  justify-content: center;
}

.archbishop-image img {
  width: 100%;
  height: 100%;
  max-width: 500px;
  max-height: 650px; /* increase height */
  object-fit: cover;
  border-radius: 12px;
  box-shadow: 0 6px 16px rgba(0, 0, 0, 0.15);
}

/* TEXT COLUMN */
.archbishop-info {
  flex: 1 1 500px;
  display: flex;
  flex-direction: column;
  justify-content: center;
}

.archbishop-badge {
  display: inline-block;
  background-color: #007bff;
  color: #fff;
  padding: 6px 14px;
  border-radius: 25px;
  font-size: 0.9rem;
  margin-bottom: 10px;
}

/* MOBILE VIEW */
@media (max-width: 768px) {
  .archbishop-section {
    flex-direction: column;
    text-align: center;
  }

  .archbishop-image img {
    max-width: 90%;
    max-height: 400px;
  }

  .archbishop-info {
    align-items: center;
  }
}

    
  /* Founder Section */
.section-padding {
  padding: 80px 0;
}

.section-title {
  font-weight: 700;
  color: #333;
  margin-bottom: 40px;
}

/* Wrapper: makes image & text side-by-side */
.founder-wrapper {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 40px;
  flex-wrap: wrap; /* for responsive stacking */
}

/* Image styling */
.founder-image {
  flex: 1 1 45%;
}

.founder-image img {
  width: 100%;
  height: 100%;
  max-height: 550px;
  object-fit: cover;
  border-radius: 12px;
  box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
}

/* Info styling */
.founder-info {
  flex: 1 1 50%;
}

.founder-info h3 {
  color: #004aad;
  font-weight: 700;
}

.founder-info p {
  line-height: 1.7;
  color: #444;
}

/* Responsive behavior */
@media (max-width: 992px) {
  .founder-wrapper {
    flex-direction: column;
    text-align: center;
  }

  .founder-image {
    max-width: 600px;
  }

  .founder-info {
    padding-top: 20px;
  }
}


    
    .timeline {
        position: relative;
        max-width: 1000px;
        margin: 0 auto;
        padding: 40px 0;
    }
    
    .timeline:before {
        content: '';
        position: absolute;
        top: 0;
        bottom: 0;
        width: 4px;
        background: #2a5298;
        left: 50%;
        margin-left: -2px;
        border-radius: 2px;
    }
    
    .timeline-item {
        padding: 20px 50px;
        position: relative;
        width: 50%;
        box-sizing: border-box;
        margin-bottom: 40px;
        opacity: 0;
        transform: translateX(-50px);
    }
    
    .timeline-item.visible {
        opacity: 1;
        transform: translateX(0);
        transition: all 0.6s ease;
    }
    
    .timeline-item:nth-child(odd) {
        left: 0;
        transform: translateX(-50px);
    }
    
    .timeline-item:nth-child(even) {
        left: 50%;
        transform: translateX(50px);
    }
    
    .timeline-item:nth-child(even).visible {
        transform: translateX(0);
    }
    
    .timeline-content {
        padding: 30px;
        background: white;
        border-radius: 15px;
        box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
        cursor: pointer;
    }
    
    .timeline-content:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 30px rgba(0,0,0,0.15);
    }
    
    .timeline-item:after {
        content: '';
        position: absolute;
        width: 24px;
        height: 24px;
        background: #2a5298;
        border: 4px solid white;
        border-radius: 50%;
        top: 30px;
        right: -12px;
        box-shadow: 0 0 0 3px #2a5298;
        transition: all 0.3s ease;
    }
    
    .timeline-item:nth-child(even):after {
        left: -12px;
    }
    
    .timeline-item:hover:after {
        transform: scale(1.2);
        background: #1e3c72;
    }
    
    /* Ministries Section */
.section-title {
  font-weight: 700;
  color: #333;
  margin-bottom: 40px;
}

.bg-light-custom {
  background-color: #f9f9f9;
}

.ministries-wrapper {
  display: flex;
  justify-content: center;
  align-items: stretch;
  flex-wrap: wrap;
  gap: 30px;
}

/* Ministry card container */
.ministry-card {
  position: relative;
  flex: 1 1 300px;
  max-width: 350px;
  overflow: hidden;
  border-radius: 12px;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
  cursor: pointer;
  transition: transform 0.4s ease;
}

.ministry-card:hover {
  transform: translateY(-8px);
}

/* Ministry image */
.ministry-image {
  position: relative;
  width: 100%;
  height: 100%;
}

.ministry-image img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.5s ease;
}

.ministry-card:hover img {
  transform: scale(1.1);
}

/* Hover overlay */
.ministry-overlay {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 67, 150, 0.85);
  color: #fff;
  opacity: 0;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  padding: 25px;
  text-align: center;
  transition: opacity 0.4s ease;
}

.ministry-card:hover .ministry-overlay {
  opacity: 1;
}

.ministry-overlay h3 {
  font-size: 1.5rem;
  margin-bottom: 12px;
  font-weight: 600;
}

.ministry-overlay p {
  font-size: 1rem;
  line-height: 1.6;
}

/* Responsive */
@media (max-width: 992px) {
  .ministries-wrapper {
    flex-direction: column;
    align-items: center;
  }
}

    .stat-box {
        background: white;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.08);
        padding: 40px 20px;
        text-align: center;
        transition: all 0.4s ease;
        margin-bottom: 30px;
        opacity: 0;
        transform: translateY(30px);
    }
    
    .stat-box.visible {
        opacity: 1;
        transform: translateY(0);
    }
    
    .stat-box:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 35px rgba(0,0,0,0.15);
    }
    
    .stat-number {
        font-size: 3.5rem;
        font-weight: bold;
        color: #2a5298;
        margin-bottom: 15px;
        transition: all 0.5s ease;
    }
    
    .stat-box:hover .stat-number {
        transform: scale(1.1);
        color: #1e3c72;
    }
    
    .btn-primary-custom {
        background: #2a5298;
        color: white;
        padding: 15px 35px;
        border-radius: 50px;
        text-decoration: none;
        display: inline-block;
        transition: all 0.4s ease;
        border: none;
        font-weight: 600;
        font-size: 1.1rem;
        box-shadow: 0 5px 15px rgba(42, 82, 152, 0.3);
    }
    
    .btn-primary-custom:hover {
        background: #1e3c72;
        color: white;
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(42, 82, 152, 0.4);
    }
    
    .section-padding {
        padding: 100px 0;
    }
    
    .bg-light-custom {
        background-color: #f8fafc;
    }
    
    .structure-card {
        background: white;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.08);
        padding: 30px;
        transition: all 0.4s ease;
        height: 100%;
        border-left: 5px solid #2a5298;
    }
    
    .structure-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(0,0,0,0.15);
    }
    
    /* Modal Styles */
    .modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.8);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 1000;
        opacity: 0;
        visibility: hidden;
        transition: all 0.3s ease;
    }
    
    .modal-overlay.active {
        opacity: 1;
        visibility: visible;
    }
    
    .modal-content {
        background: white;
        border-radius: 15px;
        max-width: 600px;
        width: 90%;
        padding: 40px;
        position: relative;
        transform: scale(0.8);
        transition: all 0.3s ease;
        box-shadow: 0 20px 60px rgba(0,0,0,0.3);
    }
    
    .modal-overlay.active .modal-content {
        transform: scale(1);
    }
    
    .close-modal {
        position: absolute;
        top: 20px;
        right: 20px;
        background: none;
        border: none;
        font-size: 24px;
        cursor: pointer;
        color: #666;
        transition: all 0.3s ease;
    }
    
    .close-modal:hover {
        color: #1e3c72;
        transform: rotate(90deg);
    }
    
    .fade-in {
        animation: fadeIn 1s ease forwards;
    }
    
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }
    
    @media (max-width: 992px) {
        .archbishop-content {
            flex-direction: column;
        }
        
        .archbishop-image,
        .archbishop-info {
            flex: 0 0 100%;
        }
        
        .archbishop-image {
            min-height: 300px;
        }
    }
    
    @media (max-width: 768px) {
        .section-padding {
            padding: 70px 0;
        }
        
        .section-title {
            font-size: 2rem;
        }
        
        .timeline:before {
            left: 31px;
        }
        
        .timeline-item {
            width: 100%;
            padding-left: 80px;
            padding-right: 25px;
        }
        
        .timeline-item:nth-child(even) {
            left: 0;
        }
        
        .timeline-item:after {
            left: 21px;
        }
        
        .timeline-item:nth-child(even):after {
            left: 21px;
        }
        
        .hero-section {
            padding: 4rem 0;
        }
    }
</style>

<div class="about-container">
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <h1 class="display-3 fw-bold mb-4 fade-in">About ELCK Southern Lake Diocese</h1>
            <p class="lead mb-0 fs-4 fade-in">The Evangelical Lutheran Church in Kenya (ELCK) Southern Lake Diocese is a faith-based community dedicated to spreading the Gospel of Jesus Christ and serving humanity.</p>
        </div>
    </section>

    <!-- Mission & Vision -->
    <section class="section-padding">
        <div class="container">
            <h2 class="text-center section-title">Our Mission & Vision</h2>
            <div class="row g-5">
                <div class="col-md-6">
                    <div class="mission-vision-card">
                        <div class="d-flex align-items-center mb-4">
                            <div class="bg-primary bg-opacity-10 p-3 rounded-circle me-4">
                                <i class="fas fa-bullseye text-primary fa-2x"></i>
                            </div>
                            <h3 class="h2 mb-0 text-primary">Our Mission</h3>
                        </div>
                        <p class="mb-0 fs-5">To proclaim the Word of God, administer the Sacraments, and nurture the faith of believers through Christ-centered worship and service.</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mission-vision-card">
                        <div class="d-flex align-items-center mb-4">
                            <div class="bg-primary bg-opacity-10 p-3 rounded-circle me-4">
                                <i class="fas fa-eye text-primary fa-2x"></i>
                            </div>
                            <h3 class="h2 mb-0 text-primary">Our Vision</h3>
                        </div>
                        <p class="mb-0 fs-5">To be a vibrant, united, and self-sustaining diocese rooted in the love and truth of Jesus Christ.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Archbishop Section -->
    <section class="section-padding bg-light-custom">
        <div class="container">
            <h2 class="text-center section-title">Our Spiritual Leadership</h2>
            
            <!-- Archbishop -->
            <div class="archbishop-section">
                <div class="archbishop-content">
                    <div class="archbishop-image">
                        <div>
                            <img src="https://international.lcms.org/wp-content/uploads/2020/03/ELCK-Archbishop-2.jpg"/>
                            <h3 class="h2 mb-2">The Most Reverend Dr. Joseph Ochola Omolo</h3>
                            <p class="mb-0 fs-5">Archbishop of the Evangelical Lutheran Church in Kenya</p>
                        </div>
                    </div>
                    <div class="archbishop-info">
                        <span class="archbishop-badge">Current Archbishop</span>
                        <h2 class="text-primary mb-3">The Most Reverend Dr. Joseph Ochola Omolo</h2>
                        <p class="text-muted mb-4 fs-5">Installed as Archbishop in January 2020</p>
                        
                        <div class="mb-4">
                            <h4 class="h5 text-primary mb-3">About Archbishop Omolo</h4>
                            <p class="fs-5 mb-3">Archbishop Omolo serves as the head of the entire national church and provides spiritual guidance to all nine dioceses of the ELCK.</p>
                            <p class="fs-5 mb-3">His seat is the Uhuru Highway Cathedral Diocese in Nairobi, where he oversees the church's national operations and ecumenical relationships.</p>
                            <p class="fs-5">Before becoming Archbishop, he served as Bishop of the Lake Diocese, demonstrating his extensive experience in church leadership.</p>
                        </div>
                        
                        <div class="row g-3 mt-4">
                            <div class="col-md-6">
                                <div class="d-flex align-items-center">
                                    <div class="bg-primary bg-opacity-10 p-2 rounded me-3">
                                        <i class="fas fa-church text-primary"></i>
                                    </div>
                                    <div>
                                        <p class="mb-0 fw-bold">Head of ELCK</p>
                                        <p class="mb-0 text-muted small">National Church Leader</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex align-items-center">
                                    <div class="bg-primary bg-opacity-10 p-2 rounded me-3">
                                        <i class="fas fa-calendar-alt text-primary"></i>
                                    </div>
                                    <div>
                                        <p class="mb-0 fw-bold">Since January 2020</p>
                                        <p class="mb-0 text-muted small">Installed as Archbishop</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ELCK Leadership Structure -->
            <div class="mt-5">
                <h3 class="text-center h2 text-primary mb-5">ELCK Leadership Structure</h3>
                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="structure-card">
                            <div class="d-flex align-items-center mb-3">
                                <div class="bg-primary bg-opacity-10 p-3 rounded-circle me-3">
                                    <i class="fas fa-crown text-primary fa-lg"></i>
                                </div>
                                <h4 class="h4 mb-0 text-primary">Archbishop</h4>
                            </div>
                            <p class="mb-0 fs-5">Serves as the head of the entire national church, guiding and leading the entire denomination from the Uhuru Highway Cathedral Diocese in Nairobi.</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="structure-card">
                            <div class="d-flex align-items-center mb-3">
                                <div class="bg-primary bg-opacity-10 p-3 rounded-circle me-3">
                                    <i class="fas fa-user-alt text-primary fa-lg"></i>
                                </div>
                                <h4 class="h4 mb-0 text-primary">Diocesan Bishops</h4>
                            </div>
                            <p class="mb-0 fs-5">The ELCK is divided into nine dioceses, each led by a Diocesan Bishop who provides spiritual leadership and oversight within their respective region.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

   <!-- Founder Section -->
<section class="section-padding">
  <div class="container">
    <h2 class="text-center section-title">Our Founder</h2>
    <div class="founder-wrapper">
      <!-- Image -->
      <div class="founder-image">
        <img
          src="https://images.unsplash.com/photo-1744370575314-0ae9bb68d604?ixlib=rb-4.1.0&auto=format&fit=crop&q=60&w=900"
          alt="Founder of ELCK"
        />
      </div>

      <!-- Info -->
      <div class="founder-info">
        <h3 class="h2 text-primary mb-3">Founder of ELCK</h3>
        <p class="text-muted mb-4 fs-5">
          The pioneering missionary work that established our church
        </p>
        <p class="fs-5 mb-4">
          The ELCK originated from the missionary work of the Swedish Lutheran
          Mission (SLM), which began at Itierio, Kisii County, in 1948. These
          dedicated missionaries laid the foundation for what would become the
          Evangelical Lutheran Church in Kenya.
        </p>
        <p class="fs-5 mb-0">
          It was initially registered in 1963 as the Lutheran Church of Kenya
          (LCK) and later changed its name to the Evangelical Lutheran Church in
          Kenya (ELCK).
        </p>
      </div>
    </div>
  </div>
</section>


    <!-- History Timeline -->
    <section class="section-padding bg-light-custom">
        <div class="container">
            <h2 class="text-center section-title">Our History</h2>
            <div class="timeline">
                <div class="timeline-item">
                    <div class="timeline-content" onclick="openModal('timeline-modal-1')">
                        <h4 class="h3 text-primary">1948</h4>
                        <p class="fs-5">The Swedish Lutheran Mission begins work at Itierio, Kisii County, marking the foundation of Lutheranism in Kenya.</p>
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-content" onclick="openModal('timeline-modal-2')">
                        <h4 class="h3 text-primary">1963</h4>
                        <p class="fs-5">Registered as the Lutheran Church of Kenya (LCK) as Kenya gains independence.</p>
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-content" onclick="openModal('timeline-modal-3')">
                        <h4 class="h3 text-primary">1996</h4>
                        <p class="fs-5">Adopted Episcopal polity and elected its first bishop, establishing the episcopal structure.</p>
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-content" onclick="openModal('timeline-modal-4')">
                        <h4 class="h3 text-primary">2002-2003</h4>
                        <p class="fs-5">Major restructuring occurred, converting deaneries into Dioceses. The church now has nine dioceses and an Archdiocese.</p>
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-content" onclick="openModal('timeline-modal-5')">
                        <h4 class="h3 text-primary">2020</h4>
                        <p class="fs-5">The Most Reverend Dr. Joseph Ochola Omolo installed as Archbishop of the ELCK.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Statistics -->
    <section class="section-padding">
        <div class="container">
            <h2 class="text-center section-title">Our Reach</h2>
            <div class="row g-5">
                <div class="col-md-3">
                    <div class="stat-box">
                        <div class="stat-number">9</div>
                        <p class="mb-0 fs-5">Dioceses</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-box">
                        <div class="stat-number">350K+</div>
                        <p class="mb-0 fs-5">Members</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-box">
                        <div class="stat-number">75+</div>
                        <p class="mb-0 fs-5">Years of Service</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-box">
                        <div class="stat-number">100+</div>
                        <p class="mb-0 fs-5">Congregations</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Ministries Section -->
<section class="section-padding bg-light-custom">
  <div class="container">
    <h2 class="text-center section-title">Our Ministries</h2>

    <div class="ministries-wrapper">
      <!-- Ministry 1 -->
      <div class="ministry-card">
        <div class="ministry-image">
          <img
            src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQF27ppSg-TKac_fKHTAcJuRqlwFly2R7OrqQ&s"
            alt="Education Ministry"
          />
          <div class="ministry-overlay">
            <h3>Education</h3>
            <p>
              Establishing and running schools and Bible colleges like Neema
              Lutheran College.
            </p>
          </div>
        </div>
      </div>

      <!-- Ministry 2 -->
      <div class="ministry-card">
        <div class="ministry-image">
          <img
            src="https://media.istockphoto.com/id/2230393709/photo/black-male-chaplain-praying-and-reading-bible-beside-hospital-bed.webp?a=1&b=1&s=612x612&w=0&k=20&c=W3ofpziF5WHqSBWJVRRHNabcqIMl2Jzq36jeS2swmkA="
            alt="Health Ministry"
          />
          <div class="ministry-overlay">
            <h3>Health Services</h3>
            <p>
              Medical services, health centers, and free medical camps in
              communities.
            </p>
          </div>
        </div>
      </div>

      <!-- Ministry 3 -->
      <div class="ministry-card">
        <div class="ministry-image">
          <img
            src="https://images.unsplash.com/photo-1694286068274-1058e6b04dcc?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTJ8fGNoaWxkcmVucyUyMG9ycGhhbmFnZXxlbnwwfHwwfHx8MA%3D%3D&auto=format&fit=crop&q=60&w=600"
            alt="Orphan Care Ministry"
          />
          <div class="ministry-overlay">
            <h3>Orphan Care</h3>
            <p>
              Project 24 and 1001 Orphans Program to support vulnerable
              children.
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


    <!-- Call to Action -->
    <section class="section-padding text-white" style="background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);">
        <div class="container text-center">
            <h2 class="mb-4 display-5">Join Our Community</h2>
            <p class="lead mb-5 fs-4">Become part of our vibrant Lutheran community and participate in our mission to spread God's love and serve humanity.</p>
            <a href="#" class="btn btn-primary-custom me-4">Visit Our Church</a><br>
            <a href="#" class="btn btn-outline-light btn-lg">Contact Us</a>
        </div>
    </section>
</div>

<!-- Modal Structure -->
<div class="modal-overlay" id="modal-overlay">
    <div class="modal-content">
        <button class="close-modal" onclick="closeModal()">&times;</button>
        <div id="modal-body">
            <!-- Modal content will be inserted here by JavaScript -->
        </div>
    </div>
</div>

<!-- Font Awesome for icons -->
<script src="https://kit.fontawesome.com/your-fontawesome-kit.js" crossorigin="anonymous"></script>

<script>
    // Scroll animation
    document.addEventListener('DOMContentLoaded', function() {
        // Animate elements on scroll
        const animateOnScroll = function() {
            const elements = document.querySelectorAll('.mission-vision-card, .leader-card, .timeline-item, .ministry-card, .stat-box');
            
            elements.forEach(element => {
                const elementTop = element.getBoundingClientRect().top;
                const elementVisible = 150;
                
                if (elementTop < window.innerHeight - elementVisible) {
                    element.classList.add('visible');
                }
            });
        };
        
        // Run on load and scroll
        animateOnScroll();
        window.addEventListener('scroll', animateOnScroll);
        
        // Animate stats
        const statBoxes = document.querySelectorAll('.stat-box');
        statBoxes.forEach(box => {
            box.addEventListener('mouseenter', function() {
                const number = this.querySelector('.stat-number');
                if (number.textContent.includes('K')) {
                    // Animate counting for numbers with K
                    const target = parseInt(number.textContent) * 1000;
                    animateValue(number, 0, target, 1000);
                } else if (number.textContent.includes('+')) {
                    // Animate counting for numbers with +
                    const target = parseInt(number.textContent);
                    animateValue(number, 0, target, 1000);
                }
            });
        });
        
        function animateValue(obj, start, end, duration) {
            let startTimestamp = null;
            const step = (timestamp) => {
                if (!startTimestamp) startTimestamp = timestamp;
                const progress = Math.min((timestamp - startTimestamp) / duration, 1);
                const value = Math.floor(progress * (end - start) + start);
                if (end > 1000) {
                    obj.textContent = Math.floor(value/1000) + "K+";
                } else {
                    obj.textContent = value + "+";
                }
                if (progress < 1) {
                    window.requestAnimationFrame(step);
                }
            };
            window.requestAnimationFrame(step);
        }
    });
    
    // Modal functionality
    function openModal(modalType) {
        const modalOverlay = document.getElementById('modal-overlay');
        const modalBody = document.getElementById('modal-body');
        
        let content = '';
        
        switch(modalType) {
            case 'founder-modal':
                content = `
                    <h2 class="text-primary mb-4">Our Founders</h2>
                    <p class="fs-5 mb-4">The Swedish Lutheran Mission (SLM) began its work in Kenya in 1948 at Itierio, Kisii County. These pioneering missionaries established the foundation of Lutheranism in Kenya.</p>
                    <p class="fs-5 mb-4">Their dedication and commitment to spreading the Gospel led to the establishment of what would become the Evangelical Lutheran Church in Kenya.</p>
                    <p class="fs-5">The mission work focused on education, healthcare, and spiritual development, creating a lasting impact that continues to this day.</p>
                `;
                break;
            case 'timeline-modal-1':
                content = `
                    <h2 class="text-primary mb-4">1948 - The Beginning</h2>
                    <p class="fs-5">The Swedish Lutheran Mission establishes its first mission station at Itierio, Kisii County, marking the official beginning of organized Lutheranism in Kenya.</p>
                `;
                break;
            case 'ministry-modal-1':
                content = `
                    <h2 class="text-primary mb-4">Education Ministry</h2>
                    <p class="fs-5 mb-4">Our education ministry includes primary and secondary schools, vocational training centers, and theological institutions like Neema Lutheran College.</p>
                    <p class="fs-5">We believe education is essential for holistic development and spiritual growth, empowering individuals and communities to reach their God-given potential.</p>
                `;
                break;
            default:
                content = `<h2 class="text-primary mb-4">More Information</h2><p class="fs-5">Detailed information about this topic will be available soon.</p>`;
        }
        
        modalBody.innerHTML = content;
        modalOverlay.classList.add('active');
        document.body.style.overflow = 'hidden';
    }
    
    function closeModal() {
        const modalOverlay = document.getElementById('modal-overlay');
        modalOverlay.classList.remove('active');
        document.body.style.overflow = 'auto';
    }
    
    // Close modal when clicking outside content
    document.getElementById('modal-overlay').addEventListener('click', function(e) {
        if (e.target === this) {
            closeModal();
        }
    });
</script>
@endsection