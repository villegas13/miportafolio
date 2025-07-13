@csrf

     

        <label for="title">Título</label> {{-- Corrected typo --}}
        <input type="text" name="title" placeholder="Título" value="{{ old('title', $post->title ?? '') }}"> {{-- Added old() helper --}}

        <label for="slug">Slug</label>
        <input type="text" name="slug" placeholder="Slug" value="{{ old('slug', $post->slug ?? '') }}"> {{-- Added old() helper and corrected placeholder --}}

        <label for="content">Contenido</label> {{-- Corrected label --}}
        <textarea name="content">{{ old('content', $post->content ?? '') }}</textarea>

        <label for="category_id">Categoría</label> {{-- Corrected label --}}

        <select name="category_id" id="category_id">
            @foreach ($categories as $title => $id)
                <option value="1" >Categoria 1</option>                    
                </option>
                <option value="2" >Categoria 2</option>                    
                </option>
                <option value="3" >Categoria 3</option>                    
                </option>
                <option value="4" >Categoria 4</option>                    
                </option>
                <option value="5" >Categoria 5</option>                    
                </option>
            @endforeach
        </select>

        <label for="descripcion">Descripción</label>
        <textarea name="descripcion" placeholder="Descripción"></textarea>

        <label for="posted">Publicado</label> {{-- Corrected label --}}
        <input type="text" name="posted" placeholder="Fecha Publicación" value="{{ old('posted', $post->posted ?? '') }}"> {{-- Corrected placeholder --}}

        <label for="image">Imagen</label>
        <input type="text" name="image" placeholder="URL de la imagen" value="{{ old('image', $post->image ?? '') }}"> {{-- Corrected placeholder --}}

        <button type="submit">Actualizar</button> {{-- Changed button text to reflect update --}}