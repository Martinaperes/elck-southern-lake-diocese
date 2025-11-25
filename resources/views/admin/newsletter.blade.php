@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">Newsletter Subscribers</h2>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Email</th>
                <th>Subscribed On</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($subscribers as $subscriber)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $subscriber->email }}</td>
                    <td>{{ $subscriber->created_at->format('F j, Y, g:i a') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
