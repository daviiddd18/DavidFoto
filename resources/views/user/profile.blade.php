@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">

                <div class="profile-user">

                    @if ($user->image)
                        <div class="container-avatar">
                            <img src="{{ route('user.avatar', ['filename' => $user->image]) }}" class="avatar" />
                        </div>
                    @else
                        <div class="container-avatar">
                            <img src={{ asset('img/sin-avatar.png') }} class="avatar" />
                        </div>
                    @endif

                    <div class="user-info">
                        <h1>{{ '@' . $user->nick }}</h1>
                        <h2>{{ $user->name . ' ' . $user->surname }}</h2>
                        <p>{{ 'Se unió: ' . \FormatTime::LongTimeFilter($user->created_at) }}</p>
                    </div>

                    <div class="clearfix"></div>
                    <hr>

                </div>

                <div class="clearfix"></div>

                @if ($user->images->isEmpty())
                    <div>
                        <img src="{{ asset('img/sin-foto.jpg') }}" class="sin-foto" />
                    </div>
                @else
                    @foreach ($user->images as $image)
                        @include('includes.image', ['image' => $image])
                    @endforeach
                @endif

            </div>
        </div>
    </div>
@endsection
