@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                @if (session('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                @endif

                <div class="card">
                    <div class="card-header">Editar mi imagen</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('image.update') }}" enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" name="image_id" value="{{$image->id}}" />

                            <div class="row mb-3">
                                <label for="image_path" class="col-md-4 col-form-label text-md-end">{{ __('Imagen') }}
                                </label>

                                <div class="col-md-6">
                                    @if ($image->user->image)
                                        <div class="container-avatar-edit">
                                            <img src="{{ route('image.file', ['filename' => $image->image_path]) }}">
                                        </div>
                                    @endif
                                    <input id="image_path" type="file"
                                        class="form-control @error('image_path') is-invalid @enderror" name="image_path">

                                    @error('image_path')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="description"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Description') }}</label>

                                <div class="col-md-6">
                                    <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description" required
                                        autofocus>{{ $image->description }}</textarea>

                                    @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Actualizar imagen
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
