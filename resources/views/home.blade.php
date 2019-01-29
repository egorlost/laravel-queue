@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('File') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('file.store') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group row">
                                <label for="file" class="col-md-4 col-form-label text-md-right">{{ __('File') }}</label>

                                <div class="col-md-6">
                                    <input type="file" class="form-control-file" id="file" name="file">

                                    @if ($errors->has('file'))
                                        <span class="invalid" role="alert">
                                            <strong>{{ $errors->first('file') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Send') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
