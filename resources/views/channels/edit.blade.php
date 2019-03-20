@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit {{ $channel->title }}</div>

                    <div class="card-body">
                        <form action="{{ route('channels.update',['id'=>$channel->id]) }}" method="post">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                            <div class="form-group">
                                <input type="text" name="channel" value="{{ $channel->title }}" class="form-control">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="text-center btn btn-success">
                                    Update
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
