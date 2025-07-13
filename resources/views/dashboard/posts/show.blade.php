@extends('master')

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
        <input type="text" name="title" placeholder="Título">

        <label for="title">Slug</label>
        <input type="text" name="slug" placeholder="Título">

        <label for="content">Content</label>
        <textarea name="content"></textarea>    

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
        <textarea name="descripcion" placeholder="Descripción"></textarea>

        <label for="title">Posted</label>
        <input type="text" name="posted" placeholder="Título">

        <label for="title">Image</label>
        <input type="text" name="image" placeholder="image">

        <button type="submit">Crear</button>
    </form>
@endsection
