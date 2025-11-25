@extends('admin.layouts.app')

@section('title', 'Events Management - ELCT Southern Lake Diocese')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
  <!-- Header -->
  <div class="flex items-center justify-between mb-6">
    <div>
      <h1 class="text-3xl font-extrabold text-gray-900">Events Management</h1>
      <p class="mt-1 text-sm text-gray-500">Manage all church events and activities for the diocese.</p>
    </div>
    <a href="{{ route('admin.events.create') }}" class="inline-flex items-center gap-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-4 py-2 rounded-lg shadow-md hover:shadow-lg transition">
      <i class="fas fa-plus"></i>
      <span class="font-semibold">Create New Event</span>
    </a>
  </div>

  <!-- Success -->
  @if(session('success'))
  <div class="mb-6">
    <div class="flex items-center justify-between bg-green-50 border border-green-200 rounded-lg p-4">
      <div class="flex items-center gap-3">
        <div class="text-green-600 text-xl"><i class="fas fa-check-circle"></i></div>
        <p class="text-sm text-green-800">{{ session('success') }}</p>
      </div>
      <button type="button" onclick="this.parentElement.parentElement.remove()" class="text-green-600 hover:bg-green-100 rounded p-1">
        <i class="fas fa-times"></i>
      </button>
    </div>
  </div>
  @endif

  <!-- Stats -->
  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
    <div class="bg-white/80 backdrop-blur rounded-xl p-4 shadow">
      <div class="flex items-center justify-between">
        <div>
          <p class="text-xs font-semibold text-gray-500 uppercase">Total Events</p>
          <p class="text-2xl font-bold text-gray-900">{{ $totalEvents }}</p>
        </div>
        <div class="h-12 w-12 rounded-lg flex items-center justify-center bg-gradient-to-br from-indigo-500 to-indigo-700 text-white shadow-sm">
          <i class="fas fa-calendar-alt"></i>
        </div>
      </div>
    </div>

    <div class="bg-white/80 backdrop-blur rounded-xl p-4 shadow">
      <div class="flex items-center justify-between">
        <div>
          <p class="text-xs font-semibold text-gray-500 uppercase">Upcoming</p>
          <p class="text-2xl font-bold text-gray-900">{{ $upcomingEvents }}</p>
        </div>
        <div class="h-12 w-12 rounded-lg flex items-center justify-center bg-gradient-to-br from-green-400 to-green-600 text-white shadow-sm">
          <i class="fas fa-rocket"></i>
        </div>
      </div>
    </div>

    <div class="bg-white/80 backdrop-blur rounded-xl p-4 shadow">
      <div class="flex items-center justify-between">
        <div>
          <p class="text-xs font-semibold text-gray-500 uppercase">Public Events</p>
          <p class="text-2xl font-bold text-gray-900">{{ $publicEvents }}</p>
        </div>
        <div class="h-12 w-12 rounded-lg flex items-center justify-center bg-gradient-to-br from-cyan-400 to-sky-600 text-white shadow-sm">
          <i class="fas fa-eye"></i>
        </div>
      </div>
    </div>

    <div class="bg-white/80 backdrop-blur rounded-xl p-4 shadow">
      <div class="flex items-center justify-between">
        <div>
          <p class="text-xs font-semibold text-gray-500 uppercase">This Month</p>
          <p class="text-2xl font-bold text-gray-900">{{ $thisMonthEvents }}</p>
        </div>
        <div class="h-12 w-12 rounded-lg flex items-center justify-center bg-gradient-to-br from-yellow-400 to-orange-500 text-white shadow-sm">
          <i class="fas fa-star"></i>
        </div>
      </div>
    </div>
  </div>

  <!-- Main Card -->
  <div class="bg-white/80 backdrop-blur rounded-2xl shadow-xl overflow-hidden">
    <div class="flex items-center justify-between px-6 py-5 border-b">
      <div>
        <h2 class="text-lg font-semibold text-gray-900">All Events</h2>
        <p class="text-sm text-gray-500">Manage and organize church events</p>
      </div>

      <div class="flex items-center gap-3">
        <div class="relative">
          <span class="absolute inset-y-0 left-3 flex items-center pointer-events-none text-gray-400"><i class="fas fa-search"></i></span>
          <input type="text" placeholder="Search events..." class="search-input pl-10 pr-4 py-2 rounded-lg border border-gray-200 focus:outline-none focus:ring-2 focus:ring-indigo-300" />
        </div>

        <div class="relative group">
          <button class="inline-flex items-center gap-2 px-3 py-2 rounded-lg border border-gray-200 bg-white hover:shadow">
            <i class="fas fa-filter"></i>
            <span class="text-sm">Filter</span>
            <i class="fas fa-chevron-down text-xs"></i>
          </button>
          <div class="absolute right-0 mt-2 w-44 bg-white rounded-lg shadow-lg border hidden group-hover:block z-50">
            <a href="{{ request()->fullUrlWithQuery(['filter' => 'all']) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50">All Events</a>
            <a href="{{ request()->fullUrlWithQuery(['filter' => 'upcoming']) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50">Upcoming</a>
            <a href="{{ request()->fullUrlWithQuery(['filter' => 'past']) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50">Past Events</a>
            <a href="{{ request()->fullUrlWithQuery(['filter' => 'public']) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50">Public Only</a>
            <a href="{{ request()->fullUrlWithQuery(['filter' => 'private']) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50">Private Only</a>
          </div>
        </div>
      </div>
    </div>

    <div class="p-4 lg:p-6">
      <div class="overflow-x-auto">
        <table class="min-w-full divide-y">
          <thead>
            <tr class="text-xs text-gray-500 uppercase tracking-wider">
              <th class="px-4 py-3"><input type="checkbox" id="select-all" class="accent-indigo-600" /></th>
              <th class="px-4 py-3 text-left">Event</th>
              <th class="px-4 py-3 text-left">Type</th>
              <th class="px-4 py-3 text-left">Date & Time</th>
              <th class="px-4 py-3 text-left">Location</th>
              <th class="px-4 py-3 text-left">Ministry</th>
              <th class="px-4 py-3 text-left">Status</th>
              <th class="px-4 py-3 text-left">Registrations</th>
              <th class="px-4 py-3 text-left">Actions</th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y">
            @forelse($events as $event)
            <tr class="table-row {{ $event->start_time->isPast() ? 'opacity-60' : '' }}">
              <td class="px-4 py-4"><input type="checkbox" id="event-{{ $event->id }}" class="accent-indigo-600" /></td>
              <td class="px-4 py-4">
                <div class="flex flex-col">
                  <span class="font-medium text-gray-900">{{ $event->title }}</span>
                  @if($event->description)
                  <span class="text-sm text-gray-500">{{ Str::limit($event->description, 80) }}</span>
                  @endif
                </div>
              </td>
              <td class="px-4 py-4">
                <span class="inline-flex items-center gap-2 px-2 py-1 rounded-full text-sm font-semibold text-gray-700 bg-gray-100">
                  <i class="fas 
                    @if($event->event_type == 'service') fa-church 
                    @elseif($event->event_type == 'meeting') fa-users 
                    @elseif($event->event_type == 'conference') fa-microphone 
                    @elseif($event->event_type == 'workshop') fa-tools 
                    @else fa-calendar @endif"></i>
                  {{ ucfirst($event->event_type) }}
                </span>
              </td>
              <td class="px-4 py-4 text-sm text-gray-700">
                <div class="font-medium">{{ $event->start_time->format('M d, Y') }}</div>
                <div class="flex items-center gap-2 text-xs text-gray-500">
                  <i class="fas fa-clock"></i>
                  <span>{{ $event->start_time->format('h:i A') }}@if($event->end_time) - {{ $event->end_time->format('h:i A') }}@endif</span>
                </div>
              </td>
              <td class="px-4 py-4 text-sm text-gray-700 flex items-center gap-2"><i class="fas fa-map-marker-alt text-red-500"></i> <span>{{ Str::limit($event->location, 30) }}</span></td>
              <td class="px-4 py-4">
                @if($event->ministry)
                <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-gray-100 text-sm text-gray-700"><i class="fas fa-hands-helping"></i> {{ $event->ministry->name }}</span>
                @else
                <span class="text-gray-400 italic">—</span>
                @endif
              </td>
              <td class="px-4 py-4">
                @if($event->start_time->isPast())
                <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-gray-100 text-sm text-gray-600"><i class="fas fa-check-circle"></i> Completed</span>
                @else
                <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-sm font-semibold {{ $event->is_public ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-700' }}"><i class="fas {{ $event->is_public ? 'fa-eye' : 'fa-lock' }}"></i> {{ $event->is_public ? 'Active' : 'Private' }}</span>
                @endif
              </td>
              <td class="px-4 py-4">
                <a href="{{ route('admin.events.registrations', $event->id) }}" class="inline-flex items-center gap-2 px-3 py-1 rounded-lg bg-gray-50 border text-sm text-gray-700 hover:bg-indigo-50">
                  <i class="fas fa-users"></i>
                  <span class="font-semibold">{{ $event->registrations_count ?? 0 }}</span>
                </a>
              </td>
              <td class="px-4 py-4">
                <div class="flex items-center gap-2">
                  <a href="{{ route('admin.events.registrations', $event->id) }}" class="inline-flex items-center justify-center h-9 w-9 rounded-full bg-sky-500 text-white hover:opacity-90" title="View Registrations"><i class="fas fa-users"></i></a>
                  <a href="{{ route('admin.events.edit', $event->id) }}" class="inline-flex items-center justify-center h-9 w-9 rounded-full bg-indigo-600 text-white hover:opacity-90" title="Edit"><i class="fas fa-edit"></i></a>
                  <button onclick="confirmDelete({{ $event->id }})" class="inline-flex items-center justify-center h-9 w-9 rounded-full bg-red-600 text-white hover:opacity-90" title="Delete"><i class="fas fa-trash"></i></button>

                  <form id="delete-form-{{ $event->id }}" action="{{ route('admin.events.destroy', $event->id) }}" method="POST" class="hidden">@csrf @method('DELETE')</form>
                </div>
              </td>
            </tr>
            @empty
            <tr>
              <td colspan="9" class="py-12 text-center text-gray-500">
                <div class="flex flex-col items-center gap-4">
                  <div class="text-6xl text-gray-300"><i class="fas fa-calendar-plus"></i></div>
                  <h3 class="text-lg font-semibold">No Events Found</h3>
                  <p class="text-sm">Start by creating your first event for the diocese.</p>
                  <a href="{{ route('admin.events.create') }}" class="inline-flex items-center gap-2 mt-3 bg-indigo-600 text-white px-4 py-2 rounded-lg"> <i class="fas fa-plus"></i> Create First Event</a>
                </div>
              </td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>

      <!-- Pagination -->
      @if($events->hasPages())
      <div class="mt-6 flex flex-col sm:flex-row items-center justify-between gap-4">
        <div class="text-sm text-gray-600">Showing <strong>{{ $events->firstItem() }}</strong> to <strong>{{ $events->lastItem() }}</strong> of <strong>{{ $events->total() }}</strong> results</div>
        <div>
          {{ $events->links() }}
        </div>
      </div>
      @endif
    </div>
  </div>
</div>
@endsection

@push('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
<style>
  /* Small custom styles to complement Tailwind */
  :root { --glass: rgba(255,255,255,0.7); }
  body { background: linear-gradient(135deg,#eef2ff 0%, #fdf2f8 100%); }
  .search-input { min-width: 220px; }
  @media (max-width:640px){ .search-input{ min-width:140px } }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  function confirmDelete(eventId) {
    Swal.fire({
      title: 'Are you sure?',
      text: "This event and all its registrations will be permanently deleted!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#ef4444',
      cancelButtonColor: '#6b7280',
      confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
      if (result.isConfirmed) {
        document.getElementById('delete-form-' + eventId).submit();
      }
    });
  }

  document.addEventListener('DOMContentLoaded', function(){
    const searchInput = document.querySelector('.search-input');
    if (!searchInput) return;
    const tableRows = document.querySelectorAll('tbody .table-row');

    searchInput.addEventListener('input', function(e){
      const q = e.target.value.toLowerCase();
      tableRows.forEach(row => {
        const title = row.querySelector('td:nth-child(2) .font-medium')?.textContent.toLowerCase() || '';
        const desc = row.querySelector('td:nth-child(2) span.text-sm')?.textContent.toLowerCase() || '';
        if (title.includes(q) || desc.includes(q)) row.style.display = '';
        else row.style.display = 'none';
      });
    });

    // Select all checkbox
    const selectAll = document.getElementById('select-all');
    if (selectAll) {
      selectAll.addEventListener('change', function(){
        document.querySelectorAll('tbody input[type="checkbox"]').forEach(cb => cb.checked = this.checked);
      });
    }
  });
</script>
@endpush
