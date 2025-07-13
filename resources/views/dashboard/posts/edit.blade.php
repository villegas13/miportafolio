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

    <form action="{{ route('post.update', $post->id) }}" method="POST"> 
        @csrf

        @method('PUT') {{-- Add this Blade directive for PUT/PATCH requests --}}

        <label for="title">Título</label> {{-- Corrected typo --}}
        <input type="text" name="title" placeholder="Título" value="{{ old('title', $post->title ?? '') }}"> {{-- Added old() helper --}}

        <label for="slug">Slug</label>
        <input type="text" name="slug" placeholder="Slug" value="{{ old('slug', $post->slug ?? '') }}"> {{-- Added old() helper and corrected placeholder --}}

        <label for="content">Contenido</label> {{-- Corrected label --}}
        <textarea name="content">{{ old('content', $post->content ?? '') }}</textarea>

        <label for="category_id">Categoría</label> {{-- Corrected label --}}

        <select name="category_id" id="category_id">
            @foreach ($categories as $title => $id)
                <option value="{{ $id }}" {{ old('category_id', $post->category_id ?? '') == $id ? 'selected' : '' }}>
                    {{ $title }}
                </option>
            @endforeach
        </select>

        <label for="descripcion">Descripción</label>
        <textarea name="descripcion" placeholder="Descripción">{{  $post->descripcion  }}</textarea>

        <label for="posted">Publicado</label> {{-- Corrected label --}}
        <input type="text" name="posted" placeholder="Fecha Publicación" value="{{ old('posted', $post->posted ?? '') }}"> {{-- Corrected placeholder --}}

        <label for="image">Imagen</label>
        <input type="file" name="image" placeholder="URL de la imagen" value="{{ old('image', $post->image ?? '') }}">

        <button type="submit">Actualizar</button> {{-- Changed button text to reflect update --}}
    </form>
@endsection