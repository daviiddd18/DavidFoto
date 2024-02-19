<div class="card pub_image">
    <div class="card-header">

        @if ($image->user->image)
            <div class="container-avatar">
                <img src="{{ route('user.avatar', ['filename' => $image->user->image]) }}" class="avatar" />
            </div>
        @endif

        <div class="data-user" style="display: flex; justify-content: space-between; align-items: center;">
            <div>
                {{ $image->user->name . ' ' . $image->user->surname . ' | ' }}
                <a href="{{ route('profile', ['id' => $image->user->id]) }}" class="user-link">
                    <span class="nickname">{{ '@' . $image->user->nick }}</span>
                </a>
            </div>
            <span class="follow-unfollow">
                @php
                    $user_follow = Auth::user() ? $image->user->followers->contains('user_id', Auth::user()->id) : false;
                @endphp

                @if (Auth::check() && Auth::user()->id !== $image->user->id)
                    @if ($user_follow)
                        <button class="btn btn-sm btn-danger btn-unfollow" data-id="{{ $image->user->id }}">Unfollow</button>
                    @else
                        <button class="btn btn-sm btn-primary btn-follow" data-id="{{ $image->user->id }}">Follow</button>
                    @endif
                @endif
            </span>

        </div>

    </div>
    <div class="card-body">
        <div class="image-container">
            <div class="image-container">
                <a href="{{route('image.detail', ['id' => $image->id])}}">
                    <img src="{{ route('image.file', ['filename' => $image->image_path]) }}">
                </a>
            </div>
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
                    <img src="{{ asset('img/corazon-rojo.png') }}" data-id="{{ $image->id }}" class="btn-dislike" />
                @else
                    <img src="{{ asset('img/corazon-negro.png') }}" data-id="{{ $image->id }}" class="btn-like" />
                @endif

                <span class="number_likes" id="likes-count-{{ $image->id }}">{{ count($image->likes) }}</span>

                <a href="{{ route('image.detail', ['id' => $image->id]) }}"
                    class="btn btn-sm btn-warning btn-comments">Comentarios({{ count($image->comments) }})</a>
            </div>
        </div>
    </div>
</div>
