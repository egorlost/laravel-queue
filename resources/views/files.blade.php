@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Uploaded files') }}</div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">{{ __('Filename') }}</th>
                                <th scope="col">{{ __('Treated members') }}</th>
                                <th scope="col">{{ __('All members') }}</th>
                                <th scope="col">{{ __('Status') }}</th>
                                <th scope="col">{{ __('Error') }}</th>
                                <th scope="col">{{ __('Time processing') }}</th>
                                <th scope="col">{{ __('Created') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse ($files as $file)
                                <tr>
                                    <th scope="row">{{ $file->id }}</th>
                                    <td>{{ $file->filename }}</td>
                                    <td>{{ $file->treated_members }}</td>
                                    <td>{{ $file->members }}</td>
                                    <td>{{ $file->status }}</td>
                                    <td>{{ $file->error }}</td>
                                    <td>{{ $file->time_processing }}</td>
                                    <td>{{ $file->created_at }}</td>
                                </tr>
                            @empty
                                <p>Empty files</p>
                            </tbody>
                            @endforelse
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
