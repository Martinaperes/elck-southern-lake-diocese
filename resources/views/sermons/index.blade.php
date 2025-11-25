@extends('layouts.app')

@section('content')

<style>
    /* ------------------------------ */
    /* ANIMATIONS & GLOBAL STYLING    */
    /* ------------------------------ */
    .fade-in {
        opacity: 0;
        transform: translateY(20px);
        transition: opacity .6s ease, transform .6s ease;
    }
    .fade-in.visible {
        opacity: 1;
        transform: translateY(0);
    }

    .hover-zoom {
        transition: transform .25s ease;
    }
    .hover-zoom:hover {
        transform: scale(1.03);
    }

    /* Scroll-to-top button */
    #scrollTopBtn {
        position: fixed;
        bottom: 30px;
        right: 30px;
        background: #4361ee;
        color: white;
        border: none;
        padding: 12px 16px;
        border-radius: 50%;
        font-size: 18px;
        display: none;
        cursor: pointer;
        box-shadow: 0 4px 20px rgba(0,0,0,0.2);
        transition: opacity .3s ease;
    }
    #scrollTopBtn:hover {
        opacity: 0.8;
    }


    /* ------------------------------ */
    /* ORIGINAL YOUR STYLES (Enhanced) */
    /* ------------------------------ */
    .sermon-hero {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 6rem 0;
        margin-bottom: 3rem;
        background-attachment: fixed; /* parallax */
    }

    .sermon-card {
        border: none;
        border-radius: 18px;
        box-shadow: 0 6px 20px rgba(0,0,0,0.07);
        transition: all 0.3s ease;
        overflow: hidden;
        height: 100%;
    }
    .sermon-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 16px 45px rgba(0,0,0,0.15);
    }

    .sermon-image {
        height: 200px;
        background: linear-gradient(135deg, #4361ee 0%, #3a0ca3 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 3rem;
    }

    .scripture-badge {
        background: rgba(67,97,238,.1);
        color: #4361ee;
        padding: .3rem .8rem;
        border-radius: 20px;
        font-size: .8rem;
        font-weight: 600;
    }

    .preacher-avatar {
        width: 45px;
        height: 45px;
        background: linear-gradient(135deg, #4cc9f0 0%, #4361ee 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 700;
        font-size: .9rem;
    }

    .media-badge {
        background: #f8f9fa;
        border: 1px solid #e9ecef;
        padding: .3rem .8rem;
        border-radius: 12px;
        font-size: .75rem;
        color: #6c757d;
    }
    .media-badge.has-media {
        background: rgba(40,167,69,.15);
        color: #28a745;
        border-color: rgba(40,167,69,.4);
    }

    .filter-section {
        background: #ffffff;
        border-radius: 16px;
        padding: 1.8rem;
        box-shadow: 0 4px 12px rgba(0,0,0,0.06);
        margin-bottom: 2rem;
    }

    .stats-card {
        background: #fff;
        border-radius: 16px;
        padding: 1.5rem;
        text-align: center;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        transition: all 0.3s ease;
    }
    .stats-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    }
</style>

<!-- --------------------------- -->
<!-- HERO ======================= -->
<!-- --------------------------- -->
<section class="sermon-hero fade-in">
    <div class="container text-center">
        <h1 class="display-4 fw-bold mb-2">Sermon Library</h1>
        <p class="lead mb-4">Explore our collection of biblical teachings and spiritual guidance.</p>

        <div class="d-flex justify-content-center gap-3 flex-wrap">
            <span class="badge bg-light text-dark fs-6">
                <i class="fas fa-bible me-2"></i>{{ $totalSermons ?? 0 }} Sermons
            </span>
            <span class="badge bg-light text-dark fs-6">
                <i class="fas fa-user me-2"></i>{{ $uniquePreachers ?? 0 }} Preachers
            </span>
        </div>
    </div>
</section>


<div class="container fade-in">

    <!-- --------------------------- -->
    <!-- STATS CARDS -->
    <!-- --------------------------- -->
    <div class="row mb-5">
        <div class="col-md-4 mb-3">
            <div class="stats-card hover-zoom">
                <h3 class="fw-bold text-primary">{{ $totalSermons ?? 0 }}</h3>
                <p class="text-muted mb-0">Total Sermons</p>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="stats-card hover-zoom">
                <h3 class="fw-bold text-success">{{ $withAudio ?? 0 }}</h3>
                <p class="text-muted mb-0">With Audio</p>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="stats-card hover-zoom">
                <h3 class="fw-bold text-info">{{ $withVideo ?? 0 }}</h3>
                <p class="text-muted mb-0">With Video</p>
            </div>
        </div>
    </div>


    <!-- --------------------------- -->
    <!-- FILTER SEARCH -->
    <!-- --------------------------- -->
    <div class="filter-section fade-in">
        <form method="GET" action="{{ route('sermons.index') }}">
            <div class="input-group">
                <span class="input-group-text bg-light border-end-0">
                    <i class="fas fa-search text-muted"></i>
                </span>

                <input 
                    id="searchInput"
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    class="form-control border-start-0"
                    placeholder="Search sermons..."
                >

                @if(request('search'))
                    <a href="{{ route('sermons.index') }}" class="input-group-text bg-light">
                        <i class="fas fa-times text-muted"></i>
                    </a>
                @endif
            </div>
        </form>
    </div>


    <!-- --------------------------- -->
    <!-- SERMON CARDS GRID -->
    <!-- --------------------------- -->
    @if($sermons->count())
        <div class="row">
            @foreach($sermons as $sermon)
                <div class="col-xl-4 col-lg-6 mb-4 fade-in">
                    <div class="sermon-card hover-zoom">

                        <div class="sermon-image">
                            <i class="fas fa-bible"></i>
                        </div>

                        <div class="card-body p-4">
                            @if($sermon->scripture_references)
                                <span class="scripture-badge mb-3 d-inline-block">
                                    <i class="fas fa-book-bible me-1"></i>
                                    {{ Str::limit($sermon->scripture_references, 30) }}
                                </span>
                            @endif

                            <h4 class="fw-bold mb-3">{{ $sermon->title }}</h4>

                            @if($sermon->description)
                                <p class="text-muted">
                                    {{ Str::limit($sermon->description, 120) }}
                                </p>
                            @endif

                            <!-- Preacher -->
                            <div class="d-flex align-items-center justify-content-between mt-3 mb-3">
                                <div class="d-flex align-items-center">
                                    <div class="preacher-avatar me-3">
                                        {{ substr($sermon->preacher, 0, 1) }}
                                    </div>
                                    <div>
                                        <strong>{{ $sermon->preacher }}</strong><br>
                                        <small class="text-muted">{{ $sermon->sermon_date->format('F j, Y') }}</small>
                                    </div>
                                </div>

                                @if($sermon->duration_minutes)
                                    <div class="text-end">
                                        <small class="text-muted">Duration</small><br>
                                        <strong class="text-primary">{{ $sermon->duration_minutes }} min</strong>
                                    </div>
                                @endif
                            </div>

                            <!-- Media Badges -->
                            <div class="media-badges mb-4">
                                <span class="media-badge {{ $sermon->audio_url ? 'has-media' : '' }}">
                                    <i class="fas fa-music me-1"></i>Audio
                                </span>
                                <span class="media-badge {{ $sermon->video_url ? 'has-media' : '' }}">
                                    <i class="fas fa-video me-1"></i>Video
                                </span>
                                <span class="media-badge {{ $sermon->document_url ? 'has-media' : '' }}">
                                    <i class="fas fa-file-pdf me-1"></i>Notes
                                </span>
                            </div>

                            <a href="{{ route('sermons.show', $sermon) }}" class="btn btn-primary w-100 py-2 fw-bold">
                                <i class="fas fa-play-circle me-1"></i> Listen & Learn
                            </a>
                        </div>

                    </div>
                </div>
            @endforeach
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $sermons->links() }}
        </div>

    @else
        <div class="text-center py-5">
            <i class="fas fa-bible text-muted" style="font-size: 4rem;"></i>
            <h3 class="text-muted mt-3">No Sermons Available</h3>
        </div>
    @endif
</div>


<!-- -------------------------------------- -->
<!-- SCROLL TO TOP BUTTON -->
<!-- -------------------------------------- -->
<button id="scrollTopBtn"><i class="fas fa-arrow-up"></i></button>


<!-- -------------------------------------- -->
<!-- JAVASCRIPT INTERACTIVITY -->
<!-- -------------------------------------- -->
<script>
    /* Reveal elements on scroll */
    const faders = document.querySelectorAll('.fade-in');
    const revealOnScroll = () => {
        faders.forEach(el => {
            const top = el.getBoundingClientRect().top;
            if (top < window.innerHeight - 50) {
                el.classList.add('visible');
            }
        });
    };
    window.addEventListener('scroll', revealOnScroll);
    revealOnScroll();


    /* Search input glow effect */
    const search = document.getElementById('searchInput');
    if (search) {
        search.addEventListener('input', () => {
            search.style.boxShadow = search.value.length > 0
                ? "0 0 12px rgba(67,97,238,0.4)"
                : "none";
        });
    }

    /* Scroll-to-top button */
    const scrollBtn = document.getElementById('scrollTopBtn');
    window.addEventListener('scroll', () => {
        scrollBtn.style.display = window.scrollY > 300 ? "block" : "none";
    });
    scrollBtn.onclick = () => window.scrollTo({ top: 0, behavior: "smooth" });
</script>

@endsection
