@extends('dashboard.master')
@section('content')

<a href="{{ route('category.create') }}" target="_blank">Crear Categoria</a>

 <table>
   <thead>

        <tr>
        <td>Title</td>       
        <td>Options</td>
        </tr>

   </thead>
    <tbody>

     @if (@session('status'))
        <h1>{{ session('msj') }}</h1>
            {{ session('status') }}
        
      @endif
          

          @foreach ($categories as $c)
    <tr>
        {{-- Check if $p is actually an object before trying to access its properties --}}
        @if (is_object($c))
            <td>
                {{ $c->id ?? 'N/A' }}
            </td>   
            <td>
                {{ $c->title ?? 'N/A' }}
            </td>
            <td>
                {{ $c->category->title ?? 'N/A' }}
            </td>
            <td>
                {{-- Now it's safe to access $p->id --}}
                <a href="{{ route('category.show', $c->id) }}">Ver</a>
                <a href="{{ route('category.edit', $c->id) }}">Editar</a>
                <a href="{{ route('category.show', $c->id) }}">Detalles</a>
                <form action="{{ route('category.destroy', $c->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Eliminar</button>
                </form>
            </td>
        @else
            {{-- This block will execute if $p is boolean (false) or null --}}
            <td colspan="8">
                Error: Invalid post data encountered. (e.g., this item was boolean or null)
            </td>
        @endif
    </tr>

     
@endforeach
 </table> 
{{ $categories->links() }} <!-- Paginación -->
    
@endsection
