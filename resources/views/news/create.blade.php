@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <span>{{ __('Cadastrar notícia') }}</span>
                        <small>Cadastrando notícia como: <strong>{{ (Auth::check()) ? Auth::user()->name : 'Anônimo' }}</strong></small>
                    </div>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    <form method="POST" action="{{ route('news.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div>
                            <label for="title">{{ __('Título') }}:</label>
                            <input id="title" type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" value="{{ old('title') }}" maxlength="100" required autofocus>
                            @if ($errors->has('title'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('title') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="mt-3">
                            <label for="lead">{{ __('Lead') }}:</label>
                            <input id="lead" type="text" class="form-control{{ $errors->has('lead') ? ' is-invalid' : '' }}" name="lead" value="{{ old('lead') }}" maxlength="190" required>
                            @if ($errors->has('lead'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('lead') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="mt-3">
                            <label for="body">{{ __('Notícia (corpo)') }}:</label>
                            <textarea id="body" class="form-control{{ $errors->has('body') ? ' is-invalid' : '' }}" name="body" rows="6" maxlength="1000" required>{{ old('body') }}</textarea>
                            @if ($errors->has('body'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('body') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="mt-3">
                            <label for="image">{{ __('Imagem de capa') }}:</label>
                            <input id="image" type="file" class="form-control-file" name="image" value="{{ old('image') }}" accept="image/*">
                            @if ($errors->has('image'))
                                <span class="text-danger" role="alert">
                                    <strong>{{ $errors->first('image') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="mt-3">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Salvar') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection