@if(Auth::user()->image)
    <div class="container-avatar row mb-3" >
        <img src="{{route('user.avatar', ['filename'=>Auth::user()->image])}}" class="avatar">
    </div>
@endif
