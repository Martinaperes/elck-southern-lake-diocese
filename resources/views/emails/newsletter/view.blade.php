@extends('layouts.app')

@section('content')
<div class="newsletter-view-page">
    <!-- Page Header -->
    <section class="page-header">
        <div class="container">
            <div class="header-content">
                <div class="breadcrumb">
                    <a href="{{ route('home') }}">Home</a>
                    <span>/</span>
                    <a href="{{ route('newsletter') }}">Newsletter</a>
                    <span>/</span>
                    <span>{{ $newsletter->title }}</span>
                </div>
                <h1>{{ $newsletter->title }}</h1>
                <div class="newsletter-meta">
                    <span class="newsletter-date">
                        <i class="fas fa-calendar"></i>
                        {{ $newsletter->created_at->format('F j, Y') }}
                    </span>
                    <span class="newsletter-category">
                        <i class="fas fa-tag"></i>
                        {{ ucfirst($newsletter->category) }}
                    </span>
                    @if($newsletter->author)
                    <span class="newsletter-author">
                        <i class="fas fa-user"></i>
                        By {{ $newsletter->author->name }}
                    </span>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- Newsletter Content -->
    <section class="newsletter-content-section">
        <div class="container">
            <div class="newsletter-layout">
                <div class="newsletter-main">
                    <article class="newsletter-article">
                        @if($newsletter->file_path)
                        <div class="newsletter-download">
                            <a href="{{ asset('storage/' . $newsletter->file_path) }}" class="btn btn-primary" target="_blank">
                                <i class="fas fa-download"></i>
                                Download PDF Version
                            </a>
                        </div>
                        @endif

                        <div class="newsletter-body">
                            {!! $newsletter->content !!}
                        </div>

                        <div class="newsletter-share">
                            <h4>Share this newsletter:</h4>
                            <div class="share-buttons">
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" 
                                   target="_blank" class="share-btn facebook">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($newsletter->title) }}" 
                                   target="_blank" class="share-btn twitter">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(url()->current()) }}" 
                                   target="_blank" class="share-btn linkedin">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                                <a href="mailto:?subject={{ urlencode($newsletter->title) }}&body={{ urlencode('Check out this newsletter: ' . url()->current()) }}" 
                                   class="share-btn email">
                                    <i class="fas fa-envelope"></i>
                                </a>
                            </div>
                        </div>
                    </article>
                </div>

                <aside class="newsletter-sidebar">
                    <!-- Subscription CTA -->
                    <div class="sidebar-widget">
                        <h3>Stay Updated</h3>
                        <p>Never miss an update from our diocese</p>
                        <a href="{{ route('newsletter') }}#subscription" class="btn btn-primary btn-full">
                            Subscribe to Newsletter
                        </a>
                    </div>

                    <!-- Recent Newsletters -->
                    @if($recentNewsletters->count() > 0)
                    <div class="sidebar-widget">
                        <h3>Recent Newsletters</h3>
                        <div class="recent-newsletters">
                            @foreach($recentNewsletters as $recent)
                            <div class="recent-item">
                                <h4>
                                    <a href="{{ route('newsletter.view', $recent->id) }}">
                                        {{ $recent->title }}
                                    </a>
                                </h4>
                                <span class="recent-date">{{ $recent->created_at->format('M j, Y') }}</span>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <!-- Categories -->
                    <div class="sidebar-widget">
                        <h3>Categories</h3>
                        <div class="categories-list">
                            <a href="{{ route('newsletter') }}?category=events" class="category-item">
                                <span class="category-name">Events</span>
                                <span class="category-count">{{ \App\Models\Newsletter::where('category', 'events')->where('status', 'published')->count() }}</span>
                            </a>
                            <a href="{{ route('newsletter') }}?category=sermons" class="category-item">
                                <span class="category-name">Sermons</span>
                                <span class="category-count">{{ \App\Models\Newsletter::where('category', 'sermons')->where('status', 'published')->count() }}</span>
                            </a>
                            <a href="{{ route('newsletter') }}?category=ministries" class="category-item">
                                <span class="category-name">Ministries</span>
                                <span class="category-count">{{ \App\Models\Newsletter::where('category', 'ministries')->where('status', 'published')->count() }}</span>
                            </a>
                            <a href="{{ route('newsletter') }}?category=updates" class="category-item">
                                <span class="category-name">Updates</span>
                                <span class="category-count">{{ \App\Models\Newsletter::where('category', 'updates')->where('status', 'published')->count() }}</span>
                            </a>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </section>
</div>
@endsection

@push('styles')
<style>
.newsletter-view-page .page-header {
    background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
    color: var(--text-white);
    padding: 3rem 0;
}

.newsletter-meta {
    display: flex;
    gap: 1.5rem;
    flex-wrap: wrap;
    margin-top: 1rem;
}

.newsletter-meta span {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.9rem;
    opacity: 0.9;
}

.newsletter-layout {
    display: grid;
    grid-template-columns: 1fr 300px;
    gap: 3rem;
    align-items: start;
}

.newsletter-main {
    background: var(--bg-white);
    border-radius: var(--border-radius);
    padding: 2rem;
    box-shadow: var(--shadow);
}

.newsletter-download {
    margin-bottom: 2rem;
    text-align: center;
    padding-bottom: 2rem;
    border-bottom: 1px solid var(--border-color);
}

.newsletter-body {
    line-height: 1.8;
    color: var(--text-dark);
}

.newsletter-body h1,
.newsletter-body h2,
.newsletter-body h3,
.newsletter-body h4 {
    color: var(--primary-color);
    margin: 2rem 0 1rem;
}

.newsletter-body p {
    margin-bottom: 1rem;
}

.newsletter-body ul,
.newsletter-body ol {
    margin: 1rem 0;
    padding-left: 2rem;
}

.newsletter-body li {
    margin-bottom: 0.5rem;
}

.newsletter-share {
    margin-top: 3rem;
    padding-top: 2rem;
    border-top: 1px solid var(--border-color);
    text-align: center;
}

.newsletter-share h4 {
    margin-bottom: 1rem;
    color: var(--text-dark);
}

.share-buttons {
    display: flex;
    gap: 0.5rem;
    justify-content: center;
}

.share-btn {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    text-decoration: none;
    transition: var(--transition);
}

.share-btn:hover {
    transform: translateY(-2px);
}

.share-btn.facebook { background: #3b5998; }
.share-btn.twitter { background: #1da1f2; }
.share-btn.linkedin { background: #0077b5; }
.share-btn.email { background: var(--primary-color); }

/* Sidebar */
.newsletter-sidebar {
    display: flex;
    flex-direction: column;
    gap: 2rem;
}

.sidebar-widget {
    background: var(--bg-white);
    border-radius: var(--border-radius);
    padding: 1.5rem;
    box-shadow: var(--shadow);
}

.sidebar-widget h3 {
    color: var(--primary-color);
    margin-bottom: 1rem;
    font-size: 1.25rem;
}

.sidebar-widget p {
    color: var(--text-light);
    margin-bottom: 1rem;
}

.recent-newsletters {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.recent-item h4 {
    margin-bottom: 0.25rem;
}

.recent-item h4 a {
    color: var(--text-dark);
    text-decoration: none;
    font-size: 0.95rem;
    line-height: 1.4;
}

.recent-item h4 a:hover {
    color: var(--primary-color);
}

.recent-date {
    color: var(--text-light);
    font-size: 0.8rem;
}

.categories-list {
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
}

.category-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0.75rem;
    border-radius: var(--border-radius);
    text-decoration: none;
    color: var(--text-dark);
    transition: var(--transition);
    border: 1px solid var(--border-color);
}

.category-item:hover {
    background: var(--bg-light);
    border-color: var(--primary-color);
}

.category-name {
    font-weight: 500;
}

.category-count {
    background: var(--primary-color);
    color: white;
    padding: 0.25rem 0.5rem;
    border-radius: 20px;
    font-size: 0.8rem;
    min-width: 30px;
    text-align: center;
}

@media (max-width: 768px) {
    .newsletter-layout {
        grid-template-columns: 1fr;
        gap: 2rem;
    }
    
    .newsletter-main {
        padding: 1.5rem;
    }
    
    .newsletter-meta {
        flex-direction: column;
        gap: 0.5rem;
    }
}
</style>
@endpush