@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">

                @include('includes.message')
                @foreach ($images as $image)
                    <div class="card pub_image">
                        <div class="card-header">

                            @if ($image->user->image)
                                <div class="container-avatar">
                                    <img src="{{ route('user.avatar', ['filename' => $image->user->image]) }}"
                                        class="avatar" />
                                </div>
                            @endif

                            <div class="data-user">
                                {{ $image->user->name . ' ' . $image->user->surname . ' | ' }}
                                <a href="{{route('image.detail', ['id' => $image->id])}}" class="user-link">
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
                                    <span class="nickname-description">{{ '@' . $image->user->nick . ' ~' }}</span>
                                    <span class="nickname-date">{{ \FormatTime::LongTimeFilter($image->created_at) }}</span>
                                    <div class="image-description">
                                        <img src="{{ asset('img/circle.png') }}" class="icono-description" /><span class="description-description">{{ $image->description }}</span>
                                    </div>
                                </div>
                                <div class="comments-likes">
                                    <?php $user_like = false; ?>
                                    @foreach ($image->likes as  $like)
                                    @if ($like->user->id == Auth::user()->id)
                                        <?php $user_like = true; ?>
                                    @endif
                                    @endforeach

                                    @if ($user_like)
                                        <img src="{{ asset('img/corazon-rojo.png') }}" class="btn-dislike"/>
                                    @else
                                        <img src="{{ asset('img/corazon-negro.png') }}" class="btn-like"/>
                                    @endif

                                    <span class="number_likes">{{count($image->likes)}}</span>

                                    <a href="{{route('image.detail', ['id' => $image->id])}}" class="btn btn-sm btn-warning btn-comments">Comentarios({{count($image->comments)}})</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="clearfix">
                    {{ $images->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
