@extends('layouts.app')

@section('content')
<div class="church-donation-page">
    <!-- Hero Section -->
    <div class="hero-section position-relative">
        <div class="hero-overlay"></div>
        <div class="container py-5 position-relative text-white">
            <div class="row align-items-center min-vh-50">
                <div class="col-lg-8 mx-auto text-center">
                    <h1 class="display-4 fw-bold mb-4">Support Our Mission</h1>
                    <p class="lead fs-4 mb-4">
                        “Each of you should give what you have decided in your heart to give, 
                        not reluctantly or under compulsion, for God loves a cheerful giver.” — 2 Corinthians 9:7
                    </p>
                    <div class="mt-5">
                        <a href="#donation-form" class="btn btn-light btn-lg rounded-pill px-4 py-2 shadow">
                            <i class="bi bi-heart-fill me-2"></i> Give Now
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Flash Messages -->
    <div class="container mt-4">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show text-center shadow-sm" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
                <h5 class="alert-heading"><i class="bi bi-exclamation-triangle-fill me-2"></i>Please fix the following errors:</h5>
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    </div>

    <!-- Donation Purpose Cards -->
    <div class="container py-5">
        <div class="row text-center mb-5">
            <div class="col-lg-8 mx-auto">
                <h2 class="fw-bold text-primary mb-3">Where Your Giving Goes</h2>
                <p class="text-muted fs-5">Your generous donations support various ministries and outreach programs in our community.</p>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-md-6 col-lg-4">
                <div class="purpose-card h-100 text-center p-4 rounded-4 shadow-sm">
                    <div class="purpose-icon mb-3">
                        <i class="bi bi-house-heart text-primary"></i>
                    </div>
                    <h4 class="fw-semibold">Building Fund</h4>
                    <p class="text-muted">Support our church facilities maintenance and expansion projects.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="purpose-card h-100 text-center p-4 rounded-4 shadow-sm">
                    <div class="purpose-icon mb-3">
                        <i class="bi bi-people text-success"></i>
                    </div>
                    <h4 class="fw-semibold">Community Outreach</h4>
                    <p class="text-muted">Help us serve the needy in our community through various programs.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="purpose-card h-100 text-center p-4 rounded-4 shadow-sm">
                    <div class="purpose-icon mb-3">
                        <i class="bi bi-music-note-beamed text-warning"></i>
                    </div>
                    <h4 class="fw-semibold">Worship Ministry</h4>
                    <p class="text-muted">Support our music and worship programs for uplifting services.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Donation Form Section -->
    <div class="container py-5" id="donation-form">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
                    <div class="card-header bg-primary text-white py-4">
                        <h3 class="text-center mb-0 fw-bold">
                            <i class="bi bi-gift me-2"></i>Make a Donation
                        </h3>
                    </div>
                    <div class="card-body p-4 p-md-5">
                        <form action="{{ route('donations.store') }}" method="POST" class="needs-validation" novalidate>
                            @csrf

                            <div class="mb-4">
                                <label for="amount" class="form-label fw-semibold fs-5">Donation Amount (KES)</label>
                                <div class="input-group input-group-lg">
                                    <span class="input-group-text bg-light border-end-0">KES</span>
                                    <input type="number" name="amount" id="amount" class="form-control border-start-0 rounded-end" 
                                           min="10" placeholder="Enter amount e.g. 500" required>
                                </div>
                                <div class="form-text">Minimum donation: KES 10</div>
                            </div>

                            <div class="mb-4">
                                <label for="phone" class="form-label fw-semibold fs-5">Phone Number</label>
                                <input type="text" name="phone" id="phone" class="form-control form-control-lg rounded-3" 
                                       placeholder="2547XXXXXXXX" required>
                                <div class="form-text">Format: 2547XXXXXXXX (M-Pesa number)</div>
                            </div>

                            <div class="mb-4">
                                <label for="purpose" class="form-label fw-semibold fs-5">Select Purpose</label>
                                <select name="purpose" id="purpose" class="form-select form-select-lg rounded-3" required>
                                    <option value="" disabled selected>Choose purpose...</option>
                                    <option value="tithe">Tithe</option>
                                    <option value="offering">Freewill Offering</option>
                                    <option value="building">Building Fund</option>
                                    <option value="project">Special Project</option>
                                    <option value="charity">Charity/Welfare</option>
                                    <option value="missions">Missions</option>
                                </select>
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-semibold fs-5">Payment Method</label>
                                <div class="d-flex flex-wrap gap-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="payment_method" id="mpesa" value="mpesa" checked>
                                        <label class="form-check-label" for="mpesa">
                                            <i class="bi bi-phone me-1"></i> M-Pesa
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="payment_method" id="card" value="card">
                                        <label class="form-check-label" for="card">
                                            <i class="bi bi-credit-card me-1"></i> Credit/Debit Card
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="payment_method" id="bank" value="bank">
                                        <label class="form-check-label" for="bank">
                                            <i class="bi bi-bank me-1"></i> Bank Transfer
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-success btn-lg w-100 rounded-pill shadow-sm py-3 mt-2">
                                <i class="bi bi-heart-fill me-2"></i> Give Now
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Donation History -->
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <h2 class="text-center fw-bold text-secondary mb-5">Your Donation History</h2>

                @auth
                    @if(auth()->user()->donations->count())
                        <div class="table-responsive shadow-sm rounded-3">
                            <table class="table table-hover align-middle">
                                <thead class="table-success">
                                    <tr class="text-center">
                                        <th>#</th>
                                        <th>Amount (KES)</th>
                                        <th>Purpose</th>
                                        <th>Status</th>
                                        <th>Transaction Code</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach(auth()->user()->donations()->latest()->get() as $donation)
                                        <tr class="text-center">
                                            <td>{{ $loop->iteration }}</td>
                                            <td class="fw-semibold">{{ number_format($donation->amount, 2) }}</td>
                                            <td>
                                                <span class="badge bg-light text-dark rounded-pill px-3 py-2">
                                                    {{ ucfirst($donation->purpose) }}
                                                </span>
                                            </td>
                                            <td>
                                                @if($donation->status == 'completed')
                                                    <span class="badge bg-success rounded-pill px-3 py-2">Completed</span>
                                                @elseif($donation->status == 'pending')
                                                    <span class="badge bg-warning text-dark rounded-pill px-3 py-2">Pending</span>
                                                @else
                                                    <span class="badge bg-danger rounded-pill px-3 py-2">Failed</span>
                                                @endif
                                            </td>
                                            <td class="font-monospace">{{ $donation->transaction_code ?? 'N/A' }}</td>
                                            <td>{{ $donation->created_at->format('d M Y, H:i') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <div class="empty-state-icon mb-4">
                                <i class="bi bi-inbox display-1 text-muted"></i>
                            </div>
                            <h4 class="text-muted">No Donations Yet</h4>
                            <p class="text-muted mb-4">You haven't made any donations yet. Your first act of giving can make a difference.</p>
                            <a href="#donation-form" class="btn btn-primary rounded-pill px-4">
                                <i class="bi bi-heart-fill me-2"></i> Make Your First Donation
                            </a>
                        </div>
                    @endif
                @else
                    <div class="text-center py-5 bg-light rounded-4">
                        <h4 class="text-muted mb-3">View Your Donation History</h4>
                        <p class="text-muted fs-5 mb-4">
                            Please <a href="{{ url('/login') }}" class="fw-semibold text-decoration-none text-primary">log in</a> 
                            to view your donation history and track your contributions.
                        </p>
                        <a href="{{ url('/login') }}" class="btn btn-outline-primary rounded-pill px-4">
                            <i class="bi bi-box-arrow-in-right me-2"></i> Log In
                        </a>
                    </div>
                @endauth
            </div>
        </div>
    </div>

    <!-- Bible Verse Section -->
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="bg-light rounded-4 p-5 text-center">
                    <i class="bi bi-quote display-1 text-primary opacity-25"></i>
                    <blockquote class="blockquote fs-4 fst-italic text-dark mb-3">
                        "Give, and it will be given to you. A good measure, pressed down, shaken together and running over, will be poured into your lap. For with the measure you use, it will be measured to you."
                    </blockquote>
                    <footer class="blockquote-footer fs-5">Luke 6:38</footer>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .church-donation-page {
        font-family: 'Inter', sans-serif;
    }
    
    .hero-section {
        background: linear-gradient(rgba(44, 62, 80, 0.8), rgba(52, 152, 219, 0.7)), 
                    url('https://images.unsplash.com/photo-1519074069444-1ba4fff66d16?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80');
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        padding: 100px 0;
    }
    
    .min-vh-50 {
        min-height: 50vh;
    }
    
    .purpose-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border: 1px solid rgba(0,0,0,0.05);
    }
    
    .purpose-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.1) !important;
    }
    
    .purpose-icon {
        font-size: 3rem;
    }
    
    .empty-state-icon {
        opacity: 0.5;
    }
    
    .card-header {
        background: linear-gradient(135deg, #2c3e50, #3498db) !important;
    }
    
    .form-control, .form-select {
        border: 1px solid #e0e0e0;
        transition: border-color 0.3s, box-shadow 0.3s;
    }
    
    .form-control:focus, .form-select:focus {
        border-color: #3498db;
        box-shadow: 0 0 0 0.25rem rgba(52, 152, 219, 0.25);
    }
    
    .btn-success {
        background: linear-gradient(135deg, #27ae60, #2ecc71);
        border: none;
        font-weight: 600;
        transition: transform 0.2s, box-shadow 0.2s;
    }
    
    .btn-success:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(46, 204, 113, 0.4);
    }
    
    .table th {
        border-top: none;
        font-weight: 600;
    }
    
    h1, h2, h3, h4, h5 {
        font-family: 'Playfair Display', serif;
    }
    
    @media (max-width: 768px) {
        .hero-section {
            padding: 60px 0;
            background-attachment: scroll;
        }
        
        .display-4 {
            font-size: 2.5rem;
        }
    }
</style>

<script>
    // Form validation
    (function () {
        'use strict'
        
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.querySelectorAll('.needs-validation')
        
        // Loop over them and prevent submission
        Array.prototype.slice.call(forms)
            .forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }
                    
                    form.classList.add('was-validated')
                }, false)
            })
    })()
    
    // Phone number formatting
    document.getElementById('phone').addEventListener('input', function(e) {
        let value = e.target.value.replace(/\D/g, '');
        
        if (value.startsWith('0')) {
            value = '254' + value.substring(1);
        } else if (value.startsWith('7')) {
            value = '254' + value;
        }
        
        e.target.value = value;
    });
    
    // Smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            
            const targetId = this.getAttribute('href');
            if (targetId === '#') return;
            
            const targetElement = document.querySelector(targetId);
            if (targetElement) {
                window.scrollTo({
                    top: targetElement.offsetTop - 80,
                    behavior: 'smooth'
                });
            }
        });
    });
</script>
@endsection