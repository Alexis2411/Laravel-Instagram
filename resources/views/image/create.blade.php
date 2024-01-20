@extends('layouts.app')
@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Subir nueva Imagen</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('image.save') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row mb-3">
                                <label for="image_path" class="col-md-4 col-form-label text-md-end">Image</label>
                                <div class="col-md-7">
                                    <input id="image_path" type="file" class="form-control" name="image_path" required>
                                    @if($errors->has('image_path'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{$errors->first('image_path')}}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label for="description" class="col-md-4 col-form-label text-md-end">Description</label>
                                <div class="col-md-7">
                                    <textarea id="description" class="form-control" name="description" required></textarea>
                                    @if($errors->has('description'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{$errors->first('description')}}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <div class="col-md-6 offset-md-4">
                                    <input type="submit" class="btn btn-primary" value="Subir Imagen">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
