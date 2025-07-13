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

    <form action=" {{ route('post.store') }} " method="POST">
        @csrf
        <label for="title">Titulddo</label>
        <input type="text" name="title" placeholder="Título" value="{{ old('title', $posts->title ?? '') }}"> {{-- Added old() helper --}}

        <label for="title">Slug</label>
        <input type="text" name="slug" placeholder="Título" value="{{ old('slug', $posts->slug ?? '') }}"> {{-- Added old() helper and corrected placeholder --}}

        <label for="content">Content</label>
        <textarea name="content"> {{ old('content', $posts->content ?? '') }} </textarea>    

        <label for="category_id">Category</label>
        
        <select name="category_id" id="category_id">
         
            <option value="1">Categoria 1</option>
            <option value="2">Categoria 2</option>
            <option value="3">Categoria 3</option>
            <option value="4">Categoria 4</option>
            <option value="5">Categoria 5</option>
            <option value="6">Categoria 6</option>
         
        </select>
        
        <label for="description">Descripción</label>
        <textarea name="descripcion" placeholder="Descripción"> {{ old('description', $posts->description ?? '') }} </textarea>

        <label for="title">Posted</label>
        <input type="text" name="posted" placeholder="Título" value="{{ old('posted', $posts->posted ?? '') }}"> {{-- Corrected placeholder --}}

        <label for="title">Image</label>
       <img src="{{ asset('uploads/posts/' . $posts->image) }}" alt="">
         

        <button type="submit">Crear</button>
    </form>
@endsection
