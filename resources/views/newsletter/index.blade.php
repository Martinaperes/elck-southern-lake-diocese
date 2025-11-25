@extends('layouts.app')

@section('content')
<div class="newsletter-page">
    <!-- Page Header -->
    <section class="page-header">
        <div class="container">
            <div class="header-content">
                <h1>Newsletter</h1>
                <p>Stay connected with the latest news, events, and spiritual insights from ELCK Southern Lake Diocese</p>
                <div class="breadcrumb">
                    <a href="{{ route('home') }}">Home</a>
                    <span>/</span>
                    <span>Newsletter</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Subscription Section -->
    <section class="subscription-section" id="subscription">
        <div class="container">
            <div class="subscription-grid">
                <div class="subscription-content">
                    <h2>Subscribe to Our Newsletter</h2>
                    <p class="lead">Join our community of believers and stay updated with:</p>
                    
                    <div class="benefits-list">
                        <div class="benefit-item">
                            <i class="fas fa-calendar-check"></i>
                            <div>
                                <h4>Upcoming Events</h4>
                                <p>Be the first to know about church events, retreats, and special services</p>
                            </div>
                        </div>
                        <div class="benefit-item">
                            <i class="fas fa-book-bible"></i>
                            <div>
                                <h4>Spiritual Insights</h4>
                                <p>Receive weekly devotionals, sermon summaries, and biblical teachings</p>
                            </div>
                        </div>
                        <div class="benefit-item">
                            <i class="fas fa-hands-helping"></i>
                            <div>
                                <h4>Ministry Updates</h4>
                                <p>Stay informed about our outreach programs and community initiatives</p>
                            </div>
                        </div>
                        <div class="benefit-item">
                            <i class="fas fa-pray"></i>
                            <div>
                                <h4>Prayer Requests</h4>
                                <p>Share and receive prayer requests from our church family</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="subscription-form-container">
                    <div class="form-card">
                        <div class="form-header">
                            <h3>Subscribe Now</h3>
                            <p>Fill in your details to join our mailing list</p>
                        </div>

                        @if(session('success'))
                            <div class="alert alert-success">
                                <i class="fas fa-check-circle"></i>
                                {{ session('success') }}
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="alert alert-error">
                                <i class="fas fa-exclamation-circle"></i>
                                {{ session('error') }}
                            </div>
                        @endif

                        <form action="{{ route('newsletter.subscribe') }}" method="POST" class="newsletter-form" id="subscribeForm">
                            @csrf
                            <div class="form-group">
                                <label for="name">Full Name *</label>
                                <input type="text" id="name" name="name" value="{{ old('name') }}" required 
                                       class="form-control @error('name') error @enderror" 
                                       placeholder="Enter your full name">
                                @error('name')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="email">Email Address *</label>
                                <input type="email" id="email" name="email" value="{{ old('email') }}" required 
                                       class="form-control @error('email') error @enderror" 
                                       placeholder="Enter your email address">
                                @error('email')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="phone">Phone Number (Optional)</label>
                                <input type="tel" id="phone" name="phone" value="{{ old('phone') }}" 
                                       class="form-control @error('phone') error @enderror" 
                                       placeholder="Enter your phone number">
                                @error('phone')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Subscription Preferences</label>
                                <div class="preferences-grid">
                                    <label class="checkbox-label">
                                        <input type="checkbox" name="preferences[]" value="events" {{ in_array('events', old('preferences', [])) ? 'checked' : 'checked' }}>
                                        <span class="checkmark"></span>
                                        Events & Activities
                                    </label>
                                    <label class="checkbox-label">
                                        <input type="checkbox" name="preferences[]" value="sermons" {{ in_array('sermons', old('preferences', [])) ? 'checked' : 'checked' }}>
                                        <span class="checkmark"></span>
                                        Sermons & Teachings
                                    </label>
                                    <label class="checkbox-label">
                                        <input type="checkbox" name="preferences[]" value="ministries" {{ in_array('ministries', old('preferences', [])) ? 'checked' : '' }}>
                                        <span class="checkmark"></span>
                                        Ministry Updates
                                    </label>
                                    <label class="checkbox-label">
                                        <input type="checkbox" name="preferences[]" value="prayer" {{ in_array('prayer', old('preferences', [])) ? 'checked' : '' }}>
                                        <span class="checkmark"></span>
                                        Prayer Requests
                                    </label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="checkbox-label">
                                    <input type="checkbox" name="terms" required {{ old('terms') ? 'checked' : '' }}>
                                    <span class="checkmark"></span>
                                    I agree to receive email communications from ELCK Southern Lake Diocese and accept the 
                                    <a href="{{ route('privacy') }}">Privacy Policy</a>
                                </label>
                                @error('terms')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary btn-full" id="subscribeBtn">
                                <span class="btn-text">Subscribe to Newsletter</span>
                                <span class="btn-loading" style="display: none;">
                                    <i class="fas fa-spinner fa-spin"></i> Subscribing...
                                </span>
                            </button>
                        </form>

                        <div class="form-footer">
                            <p><small>We respect your privacy. You can unsubscribe at any time.</small></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Newsletter Archive -->
    <section class="archive-section">
        <div class="container">
            <div class="section-header">
                <h2>Recent Newsletters</h2>
                <p>Browse through our previously published newsletters</p>
            </div>

            @if($newsletters->count() > 0)
            <div class="newsletters-grid">
                @foreach($newsletters as $newsletter)
                <div class="newsletter-card">
                    <div class="newsletter-header">
                        <span class="newsletter-date">{{ $newsletter->created_at->format('F j, Y') }}</span>
                        <span class="newsletter-category">{{ ucfirst($newsletter->category) }}</span>
                    </div>
                    <h3 class="newsletter-title">{{ $newsletter->title }}</h3>
                    <p class="newsletter-excerpt">{{ $newsletter->excerpt ?? Str::limit(strip_tags($newsletter->content), 150) }}</p>
                    <div class="newsletter-actions">
                        <a href="{{ route('newsletter.view', $newsletter->id) }}" class="btn btn-sm btn-outline">
                            Read More
                        </a>
                        @if($newsletter->file_path)
                        <a href="{{ asset('storage/' . $newsletter->file_path) }}" class="btn btn-sm btn-secondary" target="_blank">
                            <i class="fas fa-download"></i> PDF
                        </a>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>

            @if($newsletters->hasPages())
            <div class="pagination-container">
                {{ $newsletters->links() }}
            </div>
            @endif

            @else
            <div class="no-newsletters">
                <i class="fas fa-newspaper"></i>
                <h3>No Newsletters Available</h3>
                <p>Check back later for our latest updates and publications.</p>
            </div>
            @endif
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="faq-section">
        <div class="container">
            <div class="section-header">
                <h2>Frequently Asked Questions</h2>
                <p>Get answers to common questions about our newsletter</p>
            </div>

            <div class="faq-grid">
                <div class="faq-item">
                    <div class="faq-question">
                        <h4>How often will I receive the newsletter?</h4>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        <p>We typically send our main newsletter once a week, usually on Friday afternoons. However, you may receive occasional special updates for urgent prayer requests or important event announcements.</p>
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question">
                        <h4>Can I choose what type of emails I receive?</h4>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        <p>Yes! During subscription, you can select your preferences for different types of content. You can also update these preferences at any time by clicking the "Update Preferences" link in any of our emails.</p>
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question">
                        <h4>How do I unsubscribe?</h4>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        <p>You can unsubscribe at any time by clicking the "Unsubscribe" link at the bottom of any newsletter email. Alternatively, you can contact us directly and we'll remove you from our mailing list.</p>
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question">
                        <h4>Is my information secure?</h4>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        <p>Absolutely. We take your privacy seriously. We will never share your personal information with third parties, and we use secure systems to protect your data. Read our <a href="{{ route('privacy') }}">Privacy Policy</a> for more details.</p>
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question">
                        <h4>Can I submit content for the newsletter?</h4>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        <p>We welcome submissions from our church community! If you have a testimony, event announcement, or ministry update you'd like to share, please contact our communications team at <a href="mailto:communications@elcksld.org">communications@elcksld.org</a>.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="container">
            <div class="cta-content">
                <h2>Stay Connected With Our Church Family</h2>
                <p>Join over 2,000 subscribers who receive spiritual nourishment and church updates directly in their inbox</p>
                <a href="#subscription" class="btn btn-primary btn-large">
                    <i class="fas fa-envelope"></i>
                    Subscribe Now
                </a>
            </div>
        </div>
    </section>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Form submission handling
    const subscribeForm = document.getElementById('subscribeForm');
    const subscribeBtn = document.getElementById('subscribeBtn');
    
    if (subscribeForm && subscribeBtn) {
        const btnText = subscribeBtn.querySelector('.btn-text');
        const btnLoading = subscribeBtn.querySelector('.btn-loading');

        subscribeForm.addEventListener('submit', function() {
            btnText.style.display = 'none';
            btnLoading.style.display = 'inline-block';
            subscribeBtn.disabled = true;
        });
    }

    // FAQ Accordion
    const faqQuestions = document.querySelectorAll('.faq-question');
    
    faqQuestions.forEach(question => {
        question.addEventListener('click', function() {
            const faqItem = this.parentElement;
            const answer = this.nextElementSibling;
            const icon = this.querySelector('i');
            
            // Toggle current item
            faqItem.classList.toggle('active');
            
            // Toggle icon
            if (faqItem.classList.contains('active')) {
                icon.classList.remove('fa-chevron-down');
                icon.classList.add('fa-chevron-up');
                answer.style.maxHeight = answer.scrollHeight + 'px';
            } else {
                icon.classList.remove('fa-chevron-up');
                icon.classList.add('fa-chevron-down');
                answer.style.maxHeight = '0';
            }
            
            // Close other items
            faqQuestions.forEach(otherQuestion => {
                if (otherQuestion !== this) {
                    const otherFaqItem = otherQuestion.parentElement;
                    const otherAnswer = otherQuestion.nextElementSibling;
                    const otherIcon = otherQuestion.querySelector('i');
                    
                    otherFaqItem.classList.remove('active');
                    otherIcon.classList.remove('fa-chevron-up');
                    otherIcon.classList.add('fa-chevron-down');
                    otherAnswer.style.maxHeight = '0';
                }
            });
        });
    });

    // Phone number formatting
    const phoneInput = document.getElementById('phone');
    if (phoneInput) {
        phoneInput.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length > 0) {
                if (value.length <= 3) {
                    value = value;
                } else if (value.length <= 6) {
                    value = value.slice(0, 3) + '-' + value.slice(3);
                } else {
                    value = value.slice(0, 3) + '-' + value.slice(3, 6) + '-' + value.slice(6, 10);
                }
            }
            e.target.value = value;
        });
    }

    // Smooth scroll for CTA button
    const ctaButton = document.querySelector('a[href="#subscription"]');
    if (ctaButton) {
        ctaButton.addEventListener('click', function(e) {
            e.preventDefault();
            const target = document.querySelector('.subscription-section');
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    }
});
</script>
@endpush