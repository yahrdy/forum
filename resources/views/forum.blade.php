@extends('layouts.app')

@section('content')
    @foreach($discussions as $discussion)
        <div class="card">
            <div class="card-header">
                <img src="{{ asset($discussion->user->avatar) }}" alt="" width="40px" height="40px">
                &nbsp;&nbsp;&nbsp;
                <span>{{ $discussion->user->name }}, <b>{{ $discussion->created_at->diffForHumans() }}</b></span>
                <a href="{{ route('discussion',['slug'=>$discussion->slug]) }}" class="btn btn-info float-right">View</a>
            </div>

            <div class="card-body">
                <h5>
                    {{ $discussion->title }}
                </h5>
                <p>
                    {{ Str::limit($discussion->content,100) }}
                </p>
            </div>
            <div class="card-footer">
                <span>
                    {{ $discussion->replies->count() }} Replies
                </span>
                <a href="{{ route('channel',['slug'=>$discussion->channel->slug]) }}" class="float-right">{{ $discussion->channel->title }}</a>
            </div>
        </div>
    @endforeach

    <div class="text-center">
        {{ $discussions->links() }}
    </div>

@endsection
