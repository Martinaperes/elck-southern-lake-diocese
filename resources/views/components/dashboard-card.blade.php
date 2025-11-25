@props(['title' => 'Default Title', 'count' => 0, 'link' => null])

<div class="p-6 bg-white shadow rounded-lg">
    <div class="text-gray-500 text-sm">{{ $title }}</div>
    <div class="text-3xl font-bold mt-2">{{ $count }}</div>

    @if($link)
        <a href="{{ $link }}" class="text-blue-600 text-sm mt-3 inline-block">
            View more →
        </a>
    @endif
</div>