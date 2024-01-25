@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @include('includes.message')
                @foreach($images as $image)
                    <div class="card mb-3">

                        <div class="card-header">
                            <a href="{{ route('image.detail', ['id'=>$image->id])}}" style="color: #444">
                                {{ $image->user->name.' '.$image->user->surname}}
                            </a>
                        </div>
                        <div class="card-body d-flex align-items-center justify-content-center"
                             style="padding:0px; width: 100%; max-height: 400px; overflow: hidden">
                            <img src="{{route('image.file', ['filename'=>$image->image_path])}}" style="width: 100%">
                        </div>

                        <div class="card-footer">
                            <div>
                                {{' @'.$image->user->nick}}

                                {{' | '.\App\Helpers\FormatTime::LongTimeFilter($image->created_at)}}
                            </div>

                            <div>
                                {{$image->description}}
                            </div>
                            <div class="row align-items-center">
                                <div class="col-md-auto likes m-2">
                                    <?php $user_like=false ?>
                                    @foreach($image->likes as $like)
                                        @if($like->user->id == \Illuminate\Support\Facades\Auth::user()->id)
                                            <?php $user_like=true ?>
                                        @endif
                                    @endforeach
                                    @if($user_like)
                                        <img src="{{ asset('img/heart-red.png') }}" alt="Icono de corazón"
                                             class="img-fluid" style="max-height: 25px;">
                                    @else
                                        <img src="{{ asset('img/heart-black.png') }}" alt="Icono de corazón"
                                             class="img-fluid" style="max-height: 25px;">
                                    @endif
                                    <span class="my-3">{{count($image->likes)}}</span>
                                </div>
                                <div class="col-md-auto">
                                    <a href="#" class="btn btn-warning">Comentarios ({{count($image->comments)}})</a>
                                </div>
                            </div>


                        </div>
                    </div>
                @endforeach
                <div>{{$images->links()}}</div>
            </div>
        </div>
    </div>
@endsection
