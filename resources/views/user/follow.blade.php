@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="container mt-4">
                    <h2>Followers</h2>
                </div>
                <hr>
                @foreach ($followers as $follower)
                    <div class="profile-user">

                        @if ($follower->user->image)
                            <div class="container-avatar">
                                <img src="{{ route('user.avatar', ['filename' => $follower->user->image]) }}"
                                    class="avatar" />
                            </div>
                        @else
                            <div class="container-avatar">
                                <img src="{{ asset('img/sin-avatar.png') }}" alt="Sin avatar" class="avatar" />
                            </div>
                        @endif

                        <div class="user-info">
                            <h4>
                                <a href="{{ route('profile', ['id' => $follower->user->id]) }}" class="user-link">
                                    <span class="nickname">{{ '@' . $follower->user->nick }}</span>
                                </a>
                            </h4>
                            <h5>{{ $follower->user->name . ' ' . $follower->user->surname }}</h5>
                            <p>{{ 'Se unió: ' . \FormatTime::LongTimeFilter($follower->user->created_at) }}</p>
                        </div>

                        <div class="clearfix"></div>
                        <hr>
                    </div>
                @endforeach
                <div class="container mt-4">
                    <h2>Follows</h2>
                </div>
                <hr>
                @foreach ($following as $follow)
                    <div class="profile-user">

                        @if ($follow->followedUser->image)
                            <div class="container-avatar">
                                <img src="{{ route('user.avatar', ['filename' => $follow->followedUser->image]) }}"
                                    class="avatar" />
                            </div>
                        @else
                            <div class="container-avatar">
                                <img src="{{ asset('img/sin-avatar.png') }}" alt="Sin avatar" class="avatar" />
                            </div>
                        @endif

                        <div class="user-info">
                            <h4>
                                <a href="{{ route('profile', ['id' => $follow->followedUser->id]) }}" class="user-link">
                                    <span class="nickname">{{ '@' . $follow->followedUser->nick }}</span>
                                </a>
                            </h4>
                            <h5>{{ $follow->followedUser->name . ' ' . $follow->followedUser->surname }}</h5>
                            <p>{{ 'Se unió: ' . \FormatTime::LongTimeFilter($follow->followedUser->created_at) }}</p>
                        </div>

                        <div class="clearfix"></div>
                        <hr>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
    </div>
@endsection
