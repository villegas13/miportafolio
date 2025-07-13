@extends('dashboard.master')
@section('content')

<a href="{{ route('post.create') }}" target="_blank">Crear Post</a>

 <table>
   <thead>

        <tr>
        <td>Title</td>
        <td>Slug</td>
        <td>Content</td>
        <td>Category</td>
        <td>Descripcion</td>
        <td>Posted</td>
        <td>Image</td>
        <td>Options</td>
        </tr>

   </thead>
    <tbody>
          @foreach ($posts as $p)
    <tr>
        {{-- Check if $p is actually an object before trying to access its properties --}}
        @if (is_object($p))
            <td>
                {{ $p->title ?? 'N/A' }}
            </td>
            <td>
                {{ $p->slug ?? 'N/A' }}
            </td>
            <td>
                {{ $p->content ?? 'N/A' }}
            </td>
            <td>
                {{ $p->category ?? 'N/A' }}
            </td>
            <td>
                {{ $p->descripcion ?? 'N/A' }}
            </td>
            <td>
                {{ $p->posted ?? 'N/A' }}
            </td>
            <td>
                {{ $p->image ?? 'N/A' }}
            </td>
            <td>
                {{-- Now it's safe to access $p->id --}}
                <a href="{{ route('post.edit', $p->id) }}">Editar</a>
                <a href="{{ route('post.show', $p->id) }}">Detalles</a>
            </td>
        @else
            {{-- This block will execute if $p is boolean (false) or null --}}
            <td colspan="8">
                Error: Invalid post data encountered. (e.g., this item was boolean or null)
            </td>
        @endif
    </tr>

     {{-- {{ $posts->links() }} <!-- Paginación --> --}}
@endforeach
 </table> 

    
@endsection
