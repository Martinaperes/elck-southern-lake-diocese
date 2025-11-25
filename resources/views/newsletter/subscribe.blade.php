@extends('layouts.app')

@section('content')
<div class="newsletter-page">
    <!-- Newsletter Header -->
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
    <section class="subscription-section">
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
                                        <input type="checkbox" name="preferences[]" value="events" checked>
                                        <span class="checkmark"></span>
                                        Events & Activities
                                    </label>
                                    <label class="checkbox-label">
                                        <input type="checkbox" name="preferences[]" value="sermons" checked>
                                        <span class="checkmark"></span>
                                        Sermons & Teachings
                                    </label>
                                    <label class="checkbox-label">
                                        <input type="checkbox" name="preferences[]" value="ministries">
                                        <span class="checkmark"></span>
                                        Ministry Updates
                                    </label>
                                    <label class="checkbox-label">
                                        <input type="checkbox" name="preferences[]" value="prayer">
                                        <span class="checkmark"></span>
                                        Prayer Requests
                                    </label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="checkbox-label">
                                    <input type="checkbox" name="terms" required>
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

            @if(isset($newsletters) && count($newsletters) > 0)
            <div class="newsletters-grid">
                @foreach($newsletters as $newsletter)
                <div class="newsletter-card">
                    <div class="newsletter-header">
                        <span class="newsletter-date">{{ $newsletter->created_at->format('F j, Y') }}</span>
                        <span class="newsletter-category">{{ ucfirst($newsletter->category) }}</span>
                    </div>
                    <h3 class="newsletter-title">{{ $newsletter->title }}</h3>
                    <p class="newsletter-excerpt">{{ Str::limit($newsletter->excerpt, 150) }}</p>
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
    const btnText = subscribeBtn.querySelector('.btn-text');
    const btnLoading = subscribeBtn.querySelector('.btn-loading');

    if (subscribeForm) {
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

<style>
/* Newsletter Page Specific Styles */
.newsletter-page {
    min-height: 100vh;
}

/* Page Header */
.page-header {
    background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
    color: var(--text-white);
    padding: 4rem 0 2rem;
    text-align: center;
}

.header-content h1 {
    font-size: 3rem;
    margin-bottom: 1rem;
    font-family: var(--font-heading);
}

.header-content p {
    font-size: 1.2rem;
    opacity: 0.9;
    max-width: 600px;
    margin: 0 auto 2rem;
}

.breadcrumb {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    font-size: 0.9rem;
}

.breadcrumb a {
    color: var(--text-white);
    text-decoration: none;
    opacity: 0.8;
    transition: var(--transition);
}

.breadcrumb a:hover {
    opacity: 1;
}

.breadcrumb span {
    opacity: 0.6;
}

/* Subscription Section */
.subscription-section {
    padding: 5rem 0;
    background: var(--bg-white);
}

.subscription-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 4rem;
    align-items: start;
}

.subscription-content h2 {
    font-size: 2.5rem;
    color: var(--primary-color);
    margin-bottom: 1.5rem;
    font-family: var(--font-heading);
}

.subscription-content .lead {
    font-size: 1.2rem;
    color: var(--text-light);
    margin-bottom: 2rem;
}

.benefits-list {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

.benefit-item {
    display: flex;
    gap: 1rem;
    align-items: flex-start;
}

.benefit-item i {
    color: var(--secondary-color);
    font-size: 1.5rem;
    margin-top: 0.25rem;
    flex-shrink: 0;
}

.benefit-item h4 {
    color: var(--primary-color);
    margin-bottom: 0.5rem;
    font-size: 1.1rem;
}

.benefit-item p {
    color: var(--text-light);
    line-height: 1.6;
}

/* Form Styles */
.form-card {
    background: var(--bg-white);
    border-radius: var(--border-radius);
    padding: 2.5rem;
    box-shadow: var(--shadow-lg);
    border: 1px solid var(--border-color);
    position: sticky;
    top: 2rem;
}

.form-header {
    text-align: center;
    margin-bottom: 2rem;
}

.form-header h3 {
    font-size: 1.75rem;
    color: var(--primary-color);
    margin-bottom: 0.5rem;
}

.form-header p {
    color: var(--text-light);
}

.form-group {
    margin-bottom: 1.5rem;
}

.form-group label {
    display: block;
    margin-bottom: 0.5rem;
    font-weight: 600;
    color: var(--text-dark);
}

.form-control {
    width: 100%;
    padding: 0.75rem 1rem;
    border: 2px solid var(--border-color);
    border-radius: var(--border-radius);
    font-size: 1rem;
    transition: var(--transition);
    background: var(--bg-white);
}

.form-control:focus {
    outline: none;
    border-color: var(--primary-color);
    box-shadow: 0 0 0 3px rgba(26, 75, 122, 0.1);
}

.form-control.error {
    border-color: #dc3545;
}

.error-message {
    color: #dc3545;
    font-size: 0.875rem;
    margin-top: 0.25rem;
    display: block;
}

/* Checkbox Styles */
.preferences-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 0.75rem;
}

.checkbox-label {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    cursor: pointer;
    font-weight: normal;
    margin-bottom: 0;
}

.checkbox-label input[type="checkbox"] {
    display: none;
}

.checkmark {
    width: 20px;
    height: 20px;
    border: 2px solid var(--border-color);
    border-radius: 4px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: var(--transition);
    flex-shrink: 0;
}

.checkmark::after {
    content: '✓';
    color: white;
    font-size: 12px;
    opacity: 0;
    transition: var(--transition);
}

.checkbox-label input[type="checkbox"]:checked + .checkmark {
    background: var(--primary-color);
    border-color: var(--primary-color);
}

.checkbox-label input[type="checkbox"]:checked + .checkmark::after {
    opacity: 1;
}

/* Alert Styles */
.alert {
    padding: 1rem;
    border-radius: var(--border-radius);
    margin-bottom: 1.5rem;
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.alert-success {
    background: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
}

.alert-error {
    background: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
}

/* Button Styles */
.btn-full {
    width: 100%;
    justify-content: center;
}

.btn-large {
    padding: 1rem 2rem;
    font-size: 1.1rem;
}

.form-footer {
    text-align: center;
    margin-top: 1.5rem;
    padding-top: 1.5rem;
    border-top: 1px solid var(--border-color);
}

.form-footer p {
    color: var(--text-light);
    font-size: 0.9rem;
}

/* Archive Section */
.archive-section {
    padding: 5rem 0;
    background: var(--bg-light);
}

.newsletters-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
    gap: 2rem;
    margin-bottom: 3rem;
}

.newsletter-card {
    background: var(--bg-white);
    border-radius: var(--border-radius);
    padding: 2rem;
    box-shadow: var(--shadow);
    transition: var(--transition);
    border-left: 4px solid var(--secondary-color);
}

.newsletter-card:hover {
    transform: translateY(-5px);
    box-shadow: var(--shadow-lg);
}

.newsletter-header {
    display: flex;
    justify-content: between;
    align-items: center;
    margin-bottom: 1rem;
    gap: 1rem;
}

.newsletter-date {
    color: var(--text-light);
    font-size: 0.9rem;
}

.newsletter-category {
    background: var(--primary-light);
    color: white;
    padding: 0.25rem 0.75rem;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 500;
}

.newsletter-title {
    font-size: 1.25rem;
    color: var(--primary-color);
    margin-bottom: 1rem;
    line-height: 1.4;
}

.newsletter-excerpt {
    color: var(--text-light);
    line-height: 1.6;
    margin-bottom: 1.5rem;
}

.newsletter-actions {
    display: flex;
    gap: 1rem;
}

.no-newsletters {
    text-align: center;
    padding: 4rem 2rem;
    color: var(--text-light);
}

.no-newsletters i {
    font-size: 4rem;
    margin-bottom: 1.5rem;
    color: var(--border-color);
}

.no-newsletters h3 {
    color: var(--text-dark);
    margin-bottom: 1rem;
}

/* FAQ Section */
.faq-section {
    padding: 5rem 0;
    background: var(--bg-white);
}

.faq-grid {
    max-width: 800px;
    margin: 0 auto;
}

.faq-item {
    border: 1px solid var(--border-color);
    border-radius: var(--border-radius);
    margin-bottom: 1rem;
    overflow: hidden;
}

.faq-question {
    padding: 1.5rem;
    background: var(--bg-light);
    cursor: pointer;
    display: flex;
    justify-content: space-between;
    align-items: center;
    transition: var(--transition);
}

.faq-question:hover {
    background: #e9ecef;
}

.faq-question h4 {
    color: var(--primary-color);
    margin: 0;
    font-size: 1.1rem;
}

.faq-answer {
    padding: 0 1.5rem;
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.3s ease;
}

.faq-item.active .faq-answer {
    padding: 1.5rem;
    max-height: 500px;
}

.faq-answer p {
    color: var(--text-light);
    line-height: 1.6;
    margin: 0;
}

.faq-answer a {
    color: var(--primary-color);
    text-decoration: none;
}

.faq-answer a:hover {
    text-decoration: underline;
}

/* CTA Section */
.cta-section {
    background: linear-gradient(135deg, var(--secondary-color) 0%, #c19b2a 100%);
    color: var(--text-dark);
    padding: 4rem 0;
    text-align: center;
}

.cta-content h2 {
    font-size: 2.5rem;
    margin-bottom: 1rem;
    font-family: var(--font-heading);
}

.cta-content p {
    font-size: 1.2rem;
    max-width: 600px;
    margin: 0 auto 2rem;
    opacity: 0.9;
}

/* Pagination */
.pagination-container {
    text-align: center;
    margin-top: 3rem;
}

/* Responsive Design */
@media (max-width: 768px) {
    .subscription-grid {
        grid-template-columns: 1fr;
        gap: 2rem;
    }

    .form-card {
        position: static;
    }

    .preferences-grid {
        grid-template-columns: 1fr;
    }

    .newsletters-grid {
        grid-template-columns: 1fr;
    }

    .header-content h1 {
        font-size: 2.5rem;
    }

    .subscription-content h2 {
        font-size: 2rem;
    }

    .form-card {
        padding: 2rem 1.5rem;
    }

    .newsletter-actions {
        flex-direction: column;
    }

    .faq-question h4 {
        font-size: 1rem;
    }
}

@media (max-width: 480px) {
    .page-header {
        padding: 3rem 0 1.5rem;
    }

    .header-content h1 {
        font-size: 2rem;
    }

    .subscription-section,
    .archive-section,
    .faq-section {
        padding: 3rem 0;
    }

    .benefit-item {
        flex-direction: column;
        text-align: center;
        gap: 0.5rem;
    }

    .newsletter-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 0.5rem;
    }
}
</style>