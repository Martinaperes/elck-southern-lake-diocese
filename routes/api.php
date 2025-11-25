<?php
Route::post('/mpesa/callback', [MpesaCallbackController::class, 'handle']);
