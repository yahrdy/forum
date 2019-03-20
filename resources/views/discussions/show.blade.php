@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <img src="{{ asset($discussion->user->avatar) }}" alt="" width="40px" height="40px">
            &nbsp;&nbsp;&nbsp;
            <span>{{ $discussion->user->name }} <b>({{ $discussion->user->points }})</b></span>
            @if($discussion->is_being_watched_by_auth_user())
                <a href="{{ route('discussion.unwatch',['id'=>$discussion->id]) }}"
                   class="btn btn-danger float-right">Unwatch</a>
            @else
                <a href="{{ route('discussion.watch',['id'=>$discussion->id]) }}"
                   class="btn btn-success float-right">Watch</a>
            @endif
        </div>
        <div class="card-body">
            <h5>
                {{ $discussion->title }}
            </h5>
            <hr>
            {{ $discussion->content }}
            <hr>
            @if($best_answer)
                <h3>Best answer</h3>
                <div class="">
                    <div class="card">
                        <div class="card-header">
                            <img src="{{ $discussion->user->avatar }}" alt="" width="40px" height="40px">&nbsp;&nbsp;&nbsp;&nbsp;
                            <span>{{ $best_answer->user->name }}<b>({{ $best_answer->user->points }})</b></span>
                        </div>
                        <div class="card-body">
                            {{ $best_answer->content }}
                        </div>
                    </div>
                </div>
            @endif
        </div>
        <div class="card-footer">
            <span>
                {{ $discussion->replies->count() }} Replies
            </span>
            <a href="{{ route('channel',['slug'=>$discussion->channel->slug]) }}"
               class="float-right">{{ $discussion->channel->title }}</a>
        </div>
    </div>

    @foreach($discussion->replies as $reply)
        <div class="card">
            <div class="card-header">
                <img src="{{ asset($reply->user->avatar) }}" alt="" width="40px" height="40px">
                &nbsp;&nbsp;&nbsp;
                <span>{{ $reply->user->name }}, <b>{{ $reply->user->points }}</b></span>
                @if(!$best_answer)
                    @if(Auth::id() == $discussion->user->id)
                        <a href="{{ route('discussion.best.answer',['id'=>$reply->id]) }}"
                           class="btn btn-sm btn-outline-info float-right">Mark as best answer</a>
                    @endif
                @endif
            </div>
            <div class="card-body">
                <div>
                    {{ $reply->content }}
                </div>
            </div>
            <div class="card-footer">
                @if($reply->is_liked_by_auth_user())
                    <a href="{{ route('reply.unlike',['id'=>$reply->id]) }}" class="btn btn-danger">Unlike<span
                                class="badge">{{ $reply->likes->count() }}</span></a>
                @else
                    <a href="{{ route('reply.like',['id'=>$reply->id]) }}" class="btn btn-success">Like<span
                                class="badge">{{ $reply->likes->count() }}</span> </a>
                @endif
            </div>
        </div>
    @endforeach

    <div class="card">
        <div class="card-body">
            @if(Auth::check())
                <form action="{{ route('discussion.reply',['id'=>$discussion->id]) }}" method="post">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="reply">Your reply...</label>
                        <textarea name="reply" id="reply" cols="30" rows="5" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-success float-right" type="submit">Reply</button>
                    </div>
                </form>
            @else
                <h3 class="text-center">Sing in to reply</h3>
            @endif
        </div>
    </div>

@endsection
