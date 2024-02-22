@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">

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
                            <a href="{{ route('profile', ['id' => $image->user->id]) }}" class="user-link">
                                <span class="nickname">{{ '@' . $image->user->nick }}</span>
                            </a>
                        </div>

                    </div>
                    <div class="card-body">
                        <div class="image-container">
                            <img src="{{ route('image.file', ['filename' => $image->image_path]) }}">
                        </div>
                        <div>
                            <div class="description">
                                <a href="{{ route('profile', ['id' => $image->user->id]) }}" class="user-link">
                                    <span class="nickname">{{ '@' . $image->user->nick }}</span>
                                </a>
                                <span class="nickname-date">
                                    @if ($image->created_at != $image->updated_at)
                                        Editado hace {{ \FormatTime::LongTimeFilter($image->updated_at) }}
                                    @else
                                        Hace {{ \FormatTime::LongTimeFilter($image->created_at) }}
                                    @endif
                                </span>
                                @if (Auth::user() && (Auth::user()->id == $image->user->id || Auth::user()->role == 'admin'))

                                    <div class="actions">
                                        <a href="{{ route('image.edit', ['id' => $image->id])  }}">
                                            <img src="{{ asset('img/lapiz.png') }}" alt="Editar publicación"
                                                class="lapiz-foto">
                                        </a>
                                        <a data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $image->id }}">
                                            <img src="{{ asset('img/papelera.png') }}" alt="Eliminar publicación" class="papelera-foto">
                                        </a>
                                    </div>
                                    <div class="modal fade" id="deleteModal-{{ $image->id }}" tabindex="-1"
                                        aria-labelledby="deleteModalLabel-{{ $image->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteModalLabel-{{ $image->id }}">
                                                        Confirmar Eliminación</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Cerrar"></button>
                                                </div>
                                                <div class="modal-body">
                                                    ¿Estás seguro de que deseas eliminar esta imagen?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Cancelar</button>
                                                    <form action="{{ route('image.delete', ['id' => $image->id]) }}">
                                                        <button type="submit" class="btn btn-danger">Eliminar</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <div class="image-description">
                                    <img src="{{ asset('img/circle.png') }}" class="icono-description" /><span
                                        class="description-description">{{ $image->description }}</span>
                                </div>
                            </div>
                            <div class="comments-likes">
                                <?php $user_like = false; ?>
                                @foreach ($image->likes as $like)
                                    @if ($like->user->id == Auth::user()->id)
                                        <?php $user_like = true; ?>
                                    @endif
                                @endforeach

                                @if ($user_like)
                                    <img src="{{ asset('img/corazon-rojo.png') }}" data-id="{{ $image->id }}"
                                        class="btn-dislike" />
                                @else
                                    <img src="{{ asset('img/corazon-negro.png') }}" data-id="{{ $image->id }}"
                                        class="btn-like" />
                                @endif

                                <span class="number_likes" id="likes-count-{{ $image->id }}">{{ count($image->likes) }}</span>

                                <a href="{{ route('image.detail', ['id' => $image->id]) }}"
                                    class="btn btn-sm btn-warning btn-comments">Comentarios({{ count($image->comments) }})</a>
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
                                                <img src="{{ asset('img/papelera.png') }}" alt="Eliminar comentario"
                                                    class="papelera">
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
