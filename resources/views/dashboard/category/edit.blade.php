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

    <form action="{{ route('category.update', $category->id) }}" method="POST" enctype="multipart/form-data"> 
        @csrf

        @method('PUT') {{-- Add this Blade directive for PUT/PATCH requests --}}

        <label for="title">Título</label> {{-- Corrected typo --}}
        <input type="text" name="title" placeholder="Título" value="{{ old('title', $category->title ?? '') }}"> {{-- Added old() helper --}}

        <label for="slug">Slug</label>
        <input type="text" name="slug" placeholder="Slug" value="{{ old('slug', $category->slug ?? '') }}"> {{-- Added old() helper and corrected placeholder --}}

             <button type="submit">Actualizar</button>
    </form>
@endsection