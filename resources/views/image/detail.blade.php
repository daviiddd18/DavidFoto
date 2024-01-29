@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">

                @include('includes.message')

                <div class="card pub_image">
                    <div class="card-header">

                        @if ($image->user->image)
                            <div class="container-avatar">
                                <img src="{{ route('user.avatar', ['filename' => $image->user->image]) }}" class="avatar" />
                            </div>
                        @endif

                        <div class="data-user">
                            {{ $image->user->name . ' ' . $image->user->surname . ' | ' }}
                            <span class="nickname">{{ '@' . $image->user->nick }}</span>
                        </div>

                    </div>
                    <div class="card-body">
                        <div class="image-container">
                            <img src="{{ route('image.file', ['filename' => $image->image_path]) }}">
                        </div>
                        <div>
                            <div class="description">
                                <span class="nickname-description">{{ '@' . $image->user->nick . ' ~' }}</span>
                                <span class="nickname-date">{{ \FormatTime::LongTimeFilter($image->created_at) }}</span>
                                <div class="image-description">
                                    <img src="{{ asset('img/circle.png') }}" class="icono-description" /><span
                                        class="description-description">{{ $image->description }}</span>
                                </div>
                            </div>
                            <div class="comments-likes">
                                <h5>Comentarios ({{ count($image->comments) }})</h5>
                                <hr>

                            </div>
                            <div class="formulario">
                                <form method="POST" action="{{ route('comment.save') }}">
                                    @csrf

                                    <input type="hidden" name="image_id" value="{{ $image->id }}" />
                                    <div class="text-area-comments">
                                        <textarea class="form-control textarea-no-resize {{ $errors->has('content') ? 'is-invalid' : '' }}" name="content"
                                            required></textarea>
                                        @error('content')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-success btn-comments">Comentar</button>
                                </form>

                                @foreach ($image->comments as $comment)
                                    <div class="comment">
                                        <span class="nickname-description">{{ '@' . $comment->user->nick . ' ~' }}</span>
                                        <span
                                            class="nickname-date">{{ \FormatTime::LongTimeFilter($comment->created_at) }}</span>

                                        @if (Auth::check() && ($comment->user_id == Auth::user()->id || $comment->image->user_id == Auth::user()->id))
                                            <a href="{{ route('comment.delete', ['id' => $comment->id]) }}">
                                                <img src="{{ asset('img/papelera.png') }}" alt="Eliminar comentario" class="papelera">
                                            </a>
                                        @endif

                                        <p class="list-comments">{{ $comment->content }}</p>

                                        <hr>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
