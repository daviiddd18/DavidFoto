@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="container mt-4">

                    <a href="{{ route('user.index') }}" class="user-link-gente">
                        <h2>Gente</h2>
                    </a>

                    <form method="GET" action="{{ route('user.index') }}" class="mt-3" id="buscador">
                        <div class="row">
                            <div class="col-md-10">
                                <input type="text" id="search" class="form-control"
                                    placeholder="Buscar personas...">
                            </div>
                            <div class="col-md-2">
                                <input type="submit" value="Buscar" class="btn btn-success w-100">
                            </div>
                        </div>
                    </form>
                </div>
                <hr>
                @foreach ($users as $user)
                    <div class="profile-user">

                        @if ($user->image)
                            <div class="container-avatar">
                                <img src="{{ route('user.avatar', ['filename' => $user->image]) }}" class="avatar" />
                            </div>
                        @else
                            <div class="container-avatar">
                                <img src="{{ asset('img/sin-avatar.png') }}" alt="Sin avatar" class="avatar" />
                            </div>
                        @endif

                        <div class="user-info">
                            <h4>
                                <a href="{{ route('profile', ['id' => $user->id]) }}" class="user-link">
                                    <span class="nickname">{{ '@' . $user->nick }}</span>
                                </a>
                            </h4>
                            <h5>{{ $user->name . ' ' . $user->surname }}</h5>
                            <p>{{ 'Se unió: ' . \FormatTime::LongTimeFilter($user->created_at) }}</p>
                        </div>

                        <div class="clearfix"></div>
                        <hr>
                    </div>
                @endforeach

                <div class="clearfix">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
