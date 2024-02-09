@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-header">Manage Users</div>
    <div class="card-body">
        @can('create-url')
            <a href="{{ route('urls.create') }}" class="btn btn-success btn-sm my-2"><i class="bi bi-plus-circle"></i> Add New URL</a>
        @endcan
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                <th scope="col">S#</th>
                <th scope="col">Real_URL</th>
                <th scope="col">SHORT_URL</th>
                <th scope="col">User</th>
                <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($urls as $url)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>
                        <a href="{{ $url->real_url }}" target="_blank" rel="noopener noreferrer">{{ $url->real_url }}</a>
                    </td>
                    <td>
                        <a href="{{ route('shortener-url', $url->short_url) }}" target="_blank">
                            {{ route('shortener-url', $url->short_url) }}
                        </a>
                    </td>
                    <td>{{ $url->user->username }}</td>
                    <td>
                        <form action="{{ route('urls.destroy', $url->id) }}" method="post">
                            @csrf
                            @method('DELETE')

                            <a href="{{ route('urls.show', $url->id) }}" class="btn btn-warning btn-sm"><i class="bi bi-eye"></i> Show</a>

                            @if (in_array('Super Admin', $user->getRoleNames()->toArray() ?? []) )
                                @if (Auth::user()->hasRole('Super Admin'))
                                    @can('delete-url')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Do you want to delete this url?');"><i class="bi bi-trash"></i> Delete</button>
                                    @endcan
                                @endif
                            @endif
                        </form>
                    </td>
                </tr>
                @empty
                    <td colspan="5">
                        <span class="text-danger">
                            <strong>No URL Found!</strong>
                        </span>
                    </td>
                @endforelse
            </tbody>
        </table>

        {{ $urls->links() }}

    </div>
</div>
    
@endsection