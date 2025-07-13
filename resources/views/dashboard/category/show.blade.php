@extends('dashboard.master')

@section('content')

  @if ($errors->any())
  <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $e)
            <div>
                <li>{{ $e }}</li>
            </div>    
            @endforeach
        </ul>
    </div>

  @endif

 @if (@session('status'))
            <h1>{{ session('msj') }}</h1>
            {{ session('status') }}
            
     @endif 

    <form action=" {{ route('post.store') }} " method="POST">
        @csrf
        <label for="title">Titulo</label>
        <input type="text" name="title" placeholder="Título" value="{{ old('title', $category->title ?? '') }}"> {{-- Added old() helper --}}

    </form>
@endsection
