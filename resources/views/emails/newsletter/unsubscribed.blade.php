@extends('layouts.app')

@section('content')
<div class="unsubscribe-page">
    <section class="page-header">
        <div class="container">
            <div class="header-content">
                <h1>Newsletter Unsubscribe</h1>
                <div class="breadcrumb">
                    <a href="{{ route('home') }}">Home</a>
                    <span>/</span>
                    <span>Unsubscribe</span>
                </div>
            </div>
        </div>
    </section>

    <section class="unsubscribe-section">
        <div class="container">
            <div class="unsubscribe-content">
                <div class="unsubscribe-card">
                    @if(session('success'))
                    <div class="status-message success">
                        <i class="fas fa-check-circle"></i>
                        <h2>Unsubscribed Successfully</h2>
                        <p>{{ session('success') }}</p>
                    </div>
                    @elseif(session('error'))
                    <div class="status-message error">
                        <i class="fas fa-exclamation-circle"></i>
                        <h2>Unable to Unsubscribe</h2>
                        <p>{{ session('error') }}</p>
                    </div>
                    @endif

                    <div class="unsubscribe-info">
                        <h3>We're sorry to see you go</h3>
                        <p>If you unsubscribed by mistake or would like to resubscribe in the future, you can always sign up again on our <a href="{{ route('newsletter') }}">newsletter page</a>.</p>
                        
                        <div class="alternative-options">
                            <h4>Before you go, consider:</h4>
                            <ul>
                                <li>Updating your email preferences instead of unsubscribing completely</li>
                                <li>Reducing the frequency of emails you receive</li>
                                <li>Contacting us