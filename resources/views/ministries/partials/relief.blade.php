@extends('layouts.app')

@section('title', 'Relief and Development Ministry - ' . config('app.name'))

@section('content')
<style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background: #f4f7f9;
        color: #333;
    }

    .hero {
        background: linear-gradient(to right, #2a5934, #74b49b);
        color: white;
        padding: 80px 20px;
        text-align: center;
        border-radius: 10px;
        margin-bottom: 40px;
    }

    .hero h1 {
        font-size: 3rem;
        margin-bottom: 10px;
    }

    .hero p {
        font-size: 1.2rem;
        line-height: 1.6;
    }

    .section {
        margin-bottom: 50px;
        padding: 20px;
        border-radius: 10px;
        background: white;
        box-shadow: 0 4px 10px rgba(0,0,0,0.05);
    }

    .section h2 {
        color: #2a5934;
        font-size: 2rem;
        margin-bottom: 15px;
    }

    .section p, .section li {
        font-size: 1rem;
        line-height: 1.7;
    }

    .highlight {
        color: #ff6b35;
        font-weight: bold;
    }

    ul {
        margin-left: 20px;
        list-style: disc;
    }

    .accordion {
        cursor: pointer;
        padding: 15px;
        border: none;
        text-align: left;
        outline: none;
        font-size: 1.2rem;
        transition: 0.4s;
        width: 100%;
        background: #e6f4ea;
        border-radius: 5px;
        margin-bottom: 5px;
    }

    .active, .accordion:hover {
        background-color: #cce5d6;
    }

    .panel {
        padding: 0 15px;
        display: none;
        background-color: white;
        overflow: hidden;
        margin-bottom: 10px;
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
        padding: 10px 25px;
        background-color: #2a5934;
        color: white;
        font-weight: bold;
        text-decoration: none;
        border-radius: 5px;
        transition: background 0.3s ease;
    }

    .cta-btn:hover {
        background-color: #74b49b;
    }
</style>

<div class="hero">
    <h1>Relief & Development Ministry</h1>
    <p>Serving communities in need through <span class="highlight">emergency response</span> and <span class="highlight">sustainable development</span>.</p>
</div>

<div class="section">
    <h2>🚨 Relief (Emergency Response)</h2>
    <button class="accordion">Disaster Response & Aid Distribution</button>
    <div class="panel">
        <ul>
            <li>Immediate support during droughts and floods.</li>
            <li>Distribution of food, shelter, blankets, soap, and mosquito nets.</li>
            <li>Spiritual and psychosocial support for affected families.</li>
        </ul>
    </div>

    <button class="accordion">Refugee Assistance</button>
    <div class="panel">
        <p>Working with partners like <strong>Lutheran World Federation (LWF)</strong> to provide essential services to refugees in Kakuma and Dadaab camps.</p>
    </div>
</div>

<div class="section">
    <h2>🛠️ Development (Long-Term Solutions)</h2>
    <button class="accordion">Food Security & Livelihoods</button>
    <div class="panel">
        <ul>
            <li>Climate-smart agriculture & drought-resistant crops.</li>
            <li>Cooperative strengthening for sustainable economic growth.</li>
            <li>Animal husbandry projects supporting pastoralist communities.</li>
        </ul>
    </div>

    <button class="accordion">Health & Wellness</button>
    <div class="panel">
        <ul>
            <li>Health clinics and primary care programs.</li>
            <li>Malaria prevention and Water, Sanitation, & Hygiene (WASH) initiatives.</li>
            <li>Youth and women empowerment through skills training and microloans.</li>
        </ul>
    </div>
</div>

<div class="section">
    <h2>🌐 Partnerships</h2>
    <ul>
        <li>Lutheran World Federation (LWF) - emergency response and development projects.</li>
        <li>Lutheran World Relief (LWR) - agriculture, food security, and climate change programs.</li>
        <li>ELCA & LCMS : providing resources for relief and development initiatives.</li>
        <li>ACT Alliance -global humanitarian collaboration.</li>
    </ul>
</div>

<div class="section">
    <h2> Gallery</h2>
    <div class="img-grid">
        <img src="{{ asset('images/ministries/relief1.jpg') }}" alt="Food Distribution">
        <img src="{{ asset('images/ministries/relief2.jpg') }}" alt="Community Agriculture">
        <img src="{{ asset('images/ministries/relief3.jpg') }}" alt="Tree Planting">
    </div>
</div>

<div class="section" style="text-align: center;">
    <a href="{{ route('contact') }}" class="cta-btn">Volunteer / Participate</a>
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
