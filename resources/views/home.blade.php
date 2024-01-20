@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @include('includes.message')
            @foreach($images as $image)
            <div class="card mb-3">

                <div class="card-header">
                    {{ $image->user->name.' '.$image->user->surname}}
                </div>
                <div class="card-body d-flex align-items-center justify-content-center" style="padding:0px; width: 100%; max-height: 400px; overflow: hidden">
                    <img src="{{route('image.file', ['filename'=>$image->image_path])}}" style="width: 100%">
                </div>

                <div class="card-footer">
                    <div class="likes">

                    </div>
                    <div>
                        {{' @'.$image->user->nick}}
                    </div>

                    <div>
                        {{$image->description}}
                    </div>
                    <div class="row align-items-center">
                        <div class="col-md-auto likes m-2">
                            <img src="{{ asset('img/heart-black.png') }}" alt="Icono de corazón" class="img-fluid" style="max-height: 25px;">
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
