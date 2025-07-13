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

    <form action=" {{ route('category.store') }} " method="POST">
        @csrf
        <label for="title">Titulddo</label>
        <input type="text" name="title" placeholder="Título">

        <label for="title">Slug</label>
        <input type="text" name="slug" placeholder="Título">

   
        <button type="submit">Crear</button>
    </form>
@endsection
