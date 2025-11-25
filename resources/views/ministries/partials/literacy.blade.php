@extends('layouts.app')

@section('title', 'Adult Literacy Programs - ' . config('app.name'))

@section('content')
<style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background: #f5f5f5;
        color: #333;
    }

    .hero {
        background: linear-gradient(to right, #ffcc80, #ffb74d);
        color: #4e342e;
        text-align: center;
        padding: 70px 20px;
        border-radius: 12px;
        margin-bottom: 40px;
    }

    .hero h1 {
        font-size: 2.8rem;
        margin-bottom: 15px;
    }

    .hero p {
        font-size: 1.2rem;
        line-height: 1.6;
    }

    .section {
        background: white;
        border-radius: 10px;
        padding: 25px 20px;
        margin-bottom: 35px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    }

    .section h2 {
        color: #ff8f00;
        font-size: 2rem;
        margin-bottom: 15px;
    }

    .section p, .section li {
        font-size: 1rem;
        line-height: 1.7;
    }

    .accordion {
        cursor: pointer;
        padding: 18px 20px;
        width: 100%;
        text-align: left;
        border: none;
        outline: none;
        font-size: 1.2rem;
        transition: 0.4s;
        background-color: #ffe0b2;
        border-radius: 5px;
        margin-bottom: 10px;
    }

    .accordion:hover, .accordion.active {
        background-color: #ffcc80;
    }

    .panel {
        padding: 0 20px;
        display: none;
        background-color: white;
        overflow: hidden;
        margin-bottom: 15px;
        border-left: 4px solid #ff8f00;
    }

    .img-grid {
        display: flex;
        flex-wrap: wrap;
        gap: 15px;
        justify-content: center;
        margin-top: 20px;
    }

    .img-grid img {
        width: 300px;
        height: 200px;
        object-fit: cover;
        border-radius: 10px;
        transition: transform 0.3s ease;
    }

    .img-grid img:hover {
        transform: scale(1.05);
    }

    .cta-btn {
        display: inline-block;
        margin-top: 20px;
        padding: 12px 30px;
        background-color: #ff8f00;
        color: white;
        font-weight: bold;
        text-decoration: none;
        border-radius: 6px;
        transition: background 0.3s ease;
    }

    .cta-btn:hover {
        background-color: #ffb74d;
    }
</style>

<div class="hero">
    <h1>Adult Literacy Programs – ELCK</h1>
    <p>Empowering adults to read, write, and thrive spiritually and socio-economically through grassroots literacy initiatives.</p>
</div>

<div class="section">
    <h2>📚 Program Overview</h2>
    <p>The ELCK’s Adult Literacy Programs aim to equip adults with essential skills for spiritual growth, economic empowerment, and active community participation. Classes are primarily organized at the local parish or mission level, with a strong emphasis on <strong>women's literacy</strong> facilitated by the Women’s Department (Akinamama). Participants engage in reading, writing, numeracy, and life skills training over a multi-year structured curriculum, often culminating in recognized government certification.</p>
</div>

<div class="section">
    <h2>🎯 Key Features</h2>

    <button class="accordion">Grassroots Implementation</button>
    <div class="panel">
        <p>Programs are organized at the local Parish or Mission level, making them accessible even to adults in remote and rural communities. This ensures that literacy is available to those who need it most, fostering inclusivity and community engagement.</p>
    </div>

    <button class="accordion">Focus on Women (Akinamama)</button>
    <div class="panel">
        <p>The ELCK targets adult women in particular, addressing the high female illiteracy rates in Kenya due to early marriage, poverty, and cultural challenges. Women’s literacy initiatives empower mothers, improve family education, and strengthen community leadership.</p>
    </div>

    <button class="accordion">Comprehensive Curriculum</button>
    <div class="panel">
        <p>The curriculum goes beyond basic reading and writing. Learners are taught:</p>
        <ul>
            <li><strong>Reading & Writing:</strong> In Swahili, English, and sometimes local mother-tongues.</li>
            <li><strong>Numeracy/Mathematics:</strong> For effective household and business management.</li>
            <li><strong>Life Skills:</strong> Covering health education (HIV/AIDS, malaria), financial literacy, and civic responsibility.</li>
        </ul>
    </div>

    <button class="accordion">Long-Term Dedication</button>
    <div class="panel">
        <p>Programs typically span multiple years. Learners often balance family responsibilities with their studies, demonstrating remarkable dedication and perseverance. Graduates are commended for their commitment and the transformative impact on their households.</p>
    </div>

    <button class="accordion">Partnership for Resources</button>
    <div class="panel">
        <p>The ELCK collaborates with specialized literacy organizations such as <strong>Literacy & Evangelism International (L&E Kenya)</strong> to provide teacher training and supply easy-to-use primers tailored for adult learners, enhancing program quality and outcomes.</p>
    </div>

    <button class="accordion">Certification</button>
    <div class="panel">
        <p>Successful learners often take government-administered adult literacy exams, earning official certificates recognized by the Ministry of Education, which further empowers them socially and economically.</p>
    </div>
</div>

<div class="section">
    <h2> Gallery</h2>
    <div class="img-grid">
        <img src="{{ asset('images/ministries/literacy1.jpg') }}" alt="Literacy Class">
        <img src="{{ asset('images/ministries/literacy2.jpg') }}" alt="Women's Literacy Program">
        <img src="{{ asset('images/ministries/literacy3.jpg') }}" alt="Adult Reading Session">
    </div>
</div>

<div class="section">
    <h2>🎯 Program Impact</h2>
    <p>ELCK Adult Literacy Programs create transformative change by:</p>
    <ul>
        <li><strong>Spiritual Development:</strong> Equipping adults to read the Bible and engage deeply in faith.</li>
        <li><strong>Empowering Mothers:</strong> Enhancing family education and encouraging active school involvement.</li>
        <li><strong>Economic Empowerment:</strong> Providing skills for small business management and financial independence.</li>
        <li><strong>Bridging Education Gaps:</strong> Offering a second chance for individuals who missed out on formal education.</li>
    </ul>
</div>

<div class="section" style="text-align: center;">
    <a href="{{ route('contact') }}" class="cta-btn">Join a Literacy Class</a>
</div>

<script>
    const accordions = document.querySelectorAll('.accordion');
    accordions.forEach(acc => {
        acc.addEventListener('click', function() {
            this.classList.toggle('active');
            const panel = this.nextElementSibling;
            panel.style.display = (panel.style.display === "block") ? "none" : "block";
        });
    });
</script>

@endsection
