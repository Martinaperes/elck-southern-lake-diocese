@extends('layouts.app')

@section('title', 'Malaria Campaign - ' . config('app.name'))

@section('content')
<style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background: #f9f9f9;
        color: #333;
    }

    .hero {
        background: linear-gradient(to right, #00796b, #48a999);
        color: white;
        text-align: center;
        padding: 80px 20px;
        border-radius: 12px;
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
        background: white;
        border-radius: 10px;
        padding: 25px 20px;
        margin-bottom: 40px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    }

    .section h2 {
        color: #00796b;
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
        background-color: #e0f2f1;
        border-radius: 5px;
        margin-bottom: 10px;
    }

    .accordion:hover, .accordion.active {
        background-color: #b2dfdb;
    }

    .panel {
        padding: 0 20px;
        display: none;
        background-color: white;
        overflow: hidden;
        margin-bottom: 15px;
        border-left: 4px solid #00796b;
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
        background-color: #00796b;
        color: white;
        font-weight: bold;
        text-decoration: none;
        border-radius: 6px;
        transition: background 0.3s ease;
    }

    .cta-btn:hover {
        background-color: #48a999;
    }
</style>

<div class="hero">
    <h1>Malaria Campaign – ELCK</h1>
    <p>Combating malaria through <strong>prevention, education, and treatment</strong>, ensuring the health of children, pregnant women, and communities across Kenya.</p>
</div>

<div class="section">
    <h2>🌍 The ELCK Malaria Campaign Model</h2>

    <button class="accordion">1. Prevention</button>
    <div class="panel">
        <p>The cornerstone of the ELCK Malaria Campaign involves <strong>proactive measures</strong> to reduce transmission and protect vulnerable populations. This includes the distribution of <strong>Long-Lasting Insecticidal Nets (LLINs)</strong> to households with children under five and pregnant women, combined with community-led initiatives aimed at eliminating mosquito breeding sites and promoting proper sanitation and hygiene practices. The church actively engages congregations to participate in preventative strategies, ensuring the sustainability of these interventions at the grassroots level.</p>
    </div>

    <button class="accordion">2. Education & Awareness</button>
    <div class="panel">
        <p>The campaign leverages the credibility and influence of ELCK clergy and lay leaders to raise awareness and promote behavior change within communities. Through sermons, Bible studies, workshops, and training sessions for local health volunteers, families are equipped with knowledge about malaria prevention, correct use and maintenance of mosquito nets, and early recognition of symptoms. This educational component is crucial for long-term success, as informed communities are better able to protect themselves and reduce the burden of malaria.</p>
    </div>

    <button class="accordion">3. Treatment & Care</button>
    <div class="panel">
        <p>ELCK-operated health facilities are a vital component of the malaria response. Clinics and dispensaries are stocked with <strong>Rapid Diagnostic Tests (RDTs)</strong> and essential antimalarial drugs, such as Artemisinin-based Combination Therapies (ACTs), to ensure timely and effective treatment. Trained health personnel provide patient education on adherence, symptom monitoring, and follow-up care. This ensures that malaria cases are managed safely and efficiently, minimizing morbidity and mortality in affected populations.</p>
    </div>
</div>

<div class="section">
    <h2>🤝 Key Partnerships</h2>
    <p>The ELCK's malaria efforts are enhanced through collaboration with both international and national organizations. Strategic partners include:</p>
    <ul>
        <li><strong>Lutheran Malaria Initiative (LMI)</strong> – coordinating resources and support from US Lutheran churches, including LCMS and Lutheran World Relief (LWR).</li>
        <li><strong>Global Fund & UN Foundation</strong> – providing funds and technical support to maximize intervention reach and effectiveness.</li>
        <li><strong>Kenya National Malaria Control Programme (NMCP)</strong> – ensuring alignment with national strategies, harmonized health outcomes, and sustainability.</li>
    </ul>
    <p>These collaborations allow the ELCK to integrate spiritual care with public health interventions, demonstrating holistic concern for both body and soul.</p>
</div>

<div class="section">
    <h2> Campaign Gallery</h2>
    <div class="img-grid">
        <img src="{{ asset('images/ministries/malaria1.jpg') }}" alt="Net Distribution">
        <img src="{{ asset('images/ministries/malaria2.jpg') }}" alt="Community Education">
        <img src="{{ asset('images/ministries/malaria3.jpg') }}" alt="Health Clinic Support">
    </div>
</div>

<div class="section" style="text-align: center;">
    <a href="{{ route('contact') }}" class="cta-btn">Join the Malaria Campaign</a>
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
