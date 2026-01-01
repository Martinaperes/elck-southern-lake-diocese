<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsletterContent extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',      // Section title, e.g., "Weekly Sermons"
        'content',    // The body/content of the section
        'image',      // Optional image URL/path
        'link',       // Optional link for more details
        'order',      // Display order
    ];
}
