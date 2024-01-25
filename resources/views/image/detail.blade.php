@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                @include('includes.message')
                <div class="card mb-3">

                    <div class="card-header">
                        {{ $image->user->name.' '.$image->user->surname}}
                    </div>
                    <div class="card-body d-flex align-items-center justify-content-center"
                         style="padding:0px; width: 100%; max-height: 500px; overflow: hidden">
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
                                <img src="{{ asset('img/heart-black.png') }}" alt="Icono de corazón" class="img-fluid"
                                     style="max-height: 25px;">
                            </div>
                            <div class="col-md">
                                <h4>Comentarios {{count($image->comments)}}</h4>
                                <hr>
                                <form action="{{route('comment.save')}}" method="POST">
                                    @csrf
                                    <input type="hidden" name="image_id" value="{{$image->id}}">
                                    <p>
                                        <textarea class="form-control" name="content" required></textarea>
                                    </p>
                                    <button type="submit" class="btn btn-success">
                                        Enviar
                                    </button>
                                </form>
                                <hr>
                                @foreach($image->comments as $comment)
                                    <div>
                                        {{' @'.$comment->user->nick}}
                                        {{' | '.\App\Helpers\FormatTime::LongTimeFilter($comment->created_at)}}
                                        <p>{{$comment->content}}
                                        @if(Auth::check() &&  ($comment->user_id == Auth::user()->id || $comment->image->user_id==Auth::user()->id))
                                            <a href="{{  route('comment.delete', ['id' => $comment->id])  }}"
                                               class="btn btn-sm btn-danger">Eliminar</a>
                                        @endif
                                        </p>
                                    </div>
                                @endforeach
                            </div>
                        </div>


                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
