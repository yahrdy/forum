@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
@if(session('info'))
    <div class="alert alert-info">{{ session('info') }}</div>
@endif
@if($errors->count()>0)
    <ul class="list-group text-danger">
        @foreach($errors->all() as $error)
            <li class="list-group-item">
                {{ $error }}
            </li>
        @endforeach
    </ul>
@endif