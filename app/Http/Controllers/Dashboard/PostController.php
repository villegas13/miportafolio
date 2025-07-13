<?php

namespace App\Http\Controllers\Dashboard;



use App\Http\Controllers\Controller;
use App\Http\Requests\Post\PutRequest;
use App\Http\Requests\Post\StoreRequest;
use Illuminate\Http\Request;
use App\Models\Post; // Import the Post model
use App\Models\Category;





class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //Elminar un redgistro
        //$post = Post::find(4); // Example to find a post with ID 1
        //$post ->delete(); // Example to update the title
        
        // Fetch all posts from the database

      //  $posts = Post::paginate(2);  // Es más común usar all() cuando quieres todos los registros
        //dd($posts); // Debugging line to check the posts
       //   return view('dashboard.posts.index', compact('posts'));
       
     $posts = Post::all();
    
    return view('dashboard.posts.index' , compact('posts'));

    

        //Crear un registro
        Post::create([
            'title' => 'Sample Post',
            'content' => 'This is a sample post content.',
            'slug' => 'sample-post',
            'category_id' => 1, // Assuming you have a category with ID 1
            'descripcion' => 'This is a sample description.',
            'posted' => 'yes',
            'image' => 'https://example.com/image.jpg', // Example image URL
        ]);

        return "Index method called. Post created successfully";
        //  dd($post->tile); // Debugging line to check the created post


    }


    /**
     * Show the form for creating a new resource.
     */
     public function create()
    {
        // This method is for showing the form to create a new post.

        // Fetch all categories from the database
        $categories = Category::all(); // Using all() is generally preferred over get() for retrieving all records

       //  dd($categories); // <--- This line is for debugging. You should remove or comment it out in production.

        // Pass the categories to the view
        return view('dashboard.posts.create', compact('categories'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        // This is where you handle the submission of the form
        // and create a new post in the database.

      // dd($request->all()); // Debugging line to check the request data
     

        // // Validate the request data
        // $request->validate([
        //     'title' => 'required',
        //     'slug' => 'required', // Ensure slug is unique
        //     'content' => 'required',
        //     'category_id' => 'required', // Ensure category exists
        //     'descripcion' => 'required', // Ensure slug is unique
        //     'posted' => 'required',
        //     'image' => 'required', 
        // ]);

        //dd('aaaaa');        
         $posts = Post::create($request->all()); // This will create a new post with all the request data
     // Aquí puedes validar y crear un nuevo post
        // Post::create(
        //     [
        //     'title' => $request->all()['title'], // Use input() for clearer access
        //     'content' => $request->all()['content'],
        //     'slug' => $request->all()['slug'],
        //     'category_id' => $request->all()['category_id'], // Changed 'category' to 'category_id'
        //     'descripcion' => $request->all()['description'], // Typo corrected: 'descripcion' to 'description'
        //     'posted' => $request->all()['posted'], // Use input() for clearer access
        //     'image' => $request->all()['image'], // Use input() for clearer access
        //     ]
        // );

        // After creation, you'll likely want to redirect or return a success message        
       
        //dd('Post created successfully!'); // Debugging line to check the creation

    
    
        return view('dashboard.posts.index')->with('posts', $posts);
    }

    /**
     * Display the specified resource.
     */
    public function show( Post $posts, $id = null)
    {
        // Find and display a single post.
        $posts = Post::findOrFail($id); // Find the post or throw a 404 error
        

        $categories = Category::pluck( 'id', 'title'); // Fetch all categories
        return view('dashboard.posts.show', compact('categories','posts'));
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        // Show the form to edit an existing post.
        //$post = Post::findOrFail($id);
        //return view('dashboard.posts.edit', compact('post'));

        
        $categories = Category::pluck( 'id', 'title'); // Fetch all categories
        return view('dashboard.posts.edit', compact('categories','post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PutRequest $request,Post $post, $id = null)
    {
        // 1. Get validated data immediately
        $data = $request->validated();

        // 2. Check if a new image was uploaded and is valid
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $uploadedImage = $request->file('image');

            // Debug Step A: Check the UploadedFile object just before attempting to move
            // What does this output? Is it an UploadedFile object?
            // Does its getPathname() point to a real temp file (like E:\xampp\tmp\phpXYZ.tmp)?
            // dd('Before move:', [
            //     'uploadedImage' => $uploadedImage,
            //     'originalName' => $uploadedImage->getClientOriginalName(),
            //     'tempPath' => $uploadedImage->getPathname(),
            //     'isValid' => $uploadedImage->isValid(),
            //     'error' => $uploadedImage->getError(), // Check PHP upload error codes
            //     'publicPath' => public_path('uploads/posts'),
            //     'targetFilename' => $filename = time() . '.' . $uploadedImage->extension(),
            // ]);

            // Generate filename only if needed
            $filename = time() . '.' . $uploadedImage->extension();

            // 3. Delete the old image (using Storage facade for robustness)
            // if ($post->image && Storage::disk('public')->exists('uploads/posts/' . $post->image)) {
            //     try {
            //         Storage::disk('public')->delete('uploads/posts/' . $post->image);
            //         // Log::info('Old image deleted: ' . $post->image); // Optional: log success
            //     } catch (\Exception $e) {
            //         Log::error("Error deleting old image: " . $post->image . " - " . $e->getMessage());
            //         // Decide if this should stop the process or just log
            //     }
            // }

            // 4. Attempt to move the new image
            try {
                // Ensure the target directory exists and has write permissions for the web server
                if (!file_exists(public_path('uploads/posts'))) {
                    mkdir(public_path('uploads/posts'), 0775, true); // Create directory if it doesn't exist
                    // Log::info('Created uploads/posts directory.'); // Optional: log creation
                }

                $uploadedImage->move(public_path('uploads/posts'), $filename);
                $data['image'] = $filename; // Update the 'image' field in $data with the new filename

                // Debug Step B: Check if move was successful (this line will only be reached if move works)
                // dd('Move successful!', public_path('uploads/posts') . '/' . $filename);

            } catch (\Exception $e) {
                // Debug Step C: This catch block will execute if $uploadedImage->move() throws an error
               // Log::error("Error moving uploaded image: " . $e->getMessage());
                // You can also dd() here to see the specific exception
                // dd('Move failed:', $e->getMessage(), $e->getFile(), $e->getLine());

                return back()->withInput()->withErrors(['image' => 'Error uploading image. Please try again.']);
            }

        } else {
            // If no new image is provided, retain the existing image name
            $data['image'] = $post->image;
        }

        // 5. Update the post with the (potentially updated) data
        $post = Post::findOrFail($id);
        $post->update($data);

        // 6. Redirect to the index page with a success message
     return view('dashboard.posts.index', ['posts' => $post]);
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, Post $posts)
    {
        // Delete a post from the database.
        $post = Post::findOrFail($id);
        $post->delete();
        return view('dashboard.posts.index', ['posts' => $posts]);
    }
}