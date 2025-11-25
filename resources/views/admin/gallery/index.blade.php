@extends('admin.layouts.app')

@section('title', 'Gallery Management')

@section('content')
<style>
    /* Reuse the same dashboard styles you used for Sermons */
    .stats-container {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
    gap: 1.5rem;
    margin-bottom: 2rem;
}

.stats-card {
    border-radius: 16px;
    padding: 1.5rem;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-align: center;
    transition: transform 0.2s, box-shadow 0.2s;
    cursor: default;
    box-shadow: 0 8px 20px rgba(0,0,0,0.08);
}

.stats-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 30px rgba(0,0,0,0.12);
}

.stats-icon {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.8rem;
    margin-bottom: 0.5rem;
}
.stats-title {
    font-weight: 600;
    font-size: 1rem;
    margin-bottom: 0.25rem;
}
.stats-value {
    font-weight: 700;
}
.btn-add-photo {
    background-color: #10B981; /* Emerald green */
    color: #fff;
    padding: 0.6rem 1.2rem;
    border-radius: 10px;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    text-decoration: none;
    transition: background 0.2s, transform 0.2s;
}

.btn-add-photo:hover {
    background-color: #059669; /* Darker green on hover */
    transform: translateY(-2px);
}

    .badge { /* same */ }
    .badge.active { background-color: #d1fae5; color: #065f46; }
    .badge.inactive { background-color: #fef3c7; color: #78350f; }
    .btn-add { /* same */ }
    .gallery-table {
        width: 100%;
        border-collapse: collapse;
        background: #fff;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    }
    .gallery-table th, .gallery-table td { padding: 0.75rem 1rem; }
    .gallery-table th { background: #f9fafb; font-weight: 600; color: #374151; }
    .gallery-table td { color: #4b5563; }
    .actions i { cursor: pointer; margin-right: 0.5rem; color: #6b7280; transition: color 0.2s; }
    .actions i:hover { color: #2563eb; }
</style>

<div class="container-fluid">
    <!-- Stats Cards -->
    <!-- Stats Cards -->
<div class="stats-container">
    <div class="stats-card" style="background: linear-gradient(135deg, #6EE7B7 0%, #3B82F6 100%); color: #fff;">
        <div class="stats-icon" style="background: rgba(255,255,255,0.2); color: #fff;">
            <i class="fas fa-images"></i>
        </div>
        <div class="stats-title">Total Galleries</div>
        <div class="stats-value" style="font-size:1.8rem; font-weight:700;">{{ $totalGalleries }}</div>
    </div>

    <div class="stats-card" style="background: linear-gradient(135deg, #FBBF24 0%, #F97316 100%); color: #fff;">
        <div class="stats-icon" style="background: rgba(255,255,255,0.2); color: #fff;">
            <i class="fas fa-check-circle"></i>
        </div>
        <div class="stats-title">Active Galleries</div>
        <div class="stats-value" style="font-size:1.8rem; font-weight:700;">{{ $activeGalleries }}</div>
    </div>
</div>


    <!-- Add New Photo Button -->
<div class="d-flex justify-content-end mb-4">
    <a href="{{ route('admin.gallery.create') }}" class="btn-add-photo">
        <i class="fas fa-plus"></i> Add New Photo
    </a>
</div>


    <!-- Gallery Table -->
    <div class="table-responsive">
        <table class="gallery-table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($galleries as $gallery)
                <tr>
                    <td>{{ $gallery->title }}</td>
                    <td>{{ $gallery->description ?? '-' }}</td>
                    <td>
                        @if($gallery->image_url)
                            <img src="{{ asset($gallery->image_url) }}" 
     alt="{{ $gallery->title }}" 
     style="width:80px; height:auto; border-radius:6px;">
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        <span class="badge {{ $gallery->is_active ? 'active' : 'inactive' }}">
                            {{ $gallery->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </td>
                    <td class="actions">
                        <a href="{{ route('admin.gallery.edit', $gallery) }}"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('admin.gallery.destroy', $gallery) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Are you sure?')" style="background:none;border:none;">
                                <i class="fas fa-trash text-red-600"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $galleries->links() }}
    </div>
</div>
@endsection
