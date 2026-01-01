<?php\n\nnamespace App\Http\Controllers\Admin;\n\n// app/Http/Controllers/Admin/GalleryController.php



use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class GalleryController extends Controller
{
    public function index()
    {
        $galleries = Gallery::latest()->paginate(10);
        $totalGalleries = Gallery::count();
        $activeGalleries = Gallery::where('is_active', true)->count();

        return view('admin.gallery.index', compact(
            'galleries',
            'totalGalleries',
            'activeGalleries'
        ));
    }

    public function create()
    {
        $totalGalleries = Gallery::count();
        $activeGalleries = Gallery::where('is_active', true)->count();
        
        return view('admin.gallery.create', compact(
            'totalGalleries',
            'activeGalleries'
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120', // 5MB
            'is_active' => 'boolean',
        ]);

        // Handle image upload - Store in public/images/gallery
        if ($request->hasFile('image')) {
            // Create directory if it doesn't exist
            $galleryPath = public_path('images/gallery');
            if (!File::exists($galleryPath)) {
                File::makeDirectory($galleryPath, 0755, true);
            }

            // Generate unique filename
            $imageName = time().'_'.str_replace(' ', '_', $request->file('image')->getClientOriginalName());
            
            // Move uploaded file
            $request->file('image')->move($galleryPath, $imageName);
            
            // Store relative path in database
            $validated['image_url'] = 'images/gallery/'.$imageName;
        }

        $validated['is_active'] = $request->has('is_active');

        // Create the gallery record
        Gallery::create($validated);

        return redirect()->route('admin.gallery.index')
            ->with('success', 'Image added successfully!');
    }

    public function show(Gallery $gallery)
    {
        $totalGalleries = Gallery::count();
        $activeGalleries = Gallery::where('is_active', true)->count();
        
        return view('admin.gallery.show', compact(
            'gallery',
            'totalGalleries',
            'activeGalleries'
        ));
    }

    public function edit(Gallery $gallery)
    {
        $totalGalleries = Gallery::count();
        $activeGalleries = Gallery::where('is_active', true)->count();
        
        return view('admin.gallery.edit', compact(
            'gallery',
            'totalGalleries',
            'activeGalleries'
        ));
    }

    public function update(Request $request, Gallery $gallery)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'is_active' => 'boolean'
        ]);

        // Handle image update - Store in public/images/gallery
        if ($request->hasFile('image')) {
            // Delete old image if it exists
            if ($gallery->image_url && file_exists(public_path($gallery->image_url))) {
                unlink(public_path($gallery->image_url));
            }
            
            // Create directory if it doesn't exist
            $galleryPath = public_path('images/gallery');
            if (!File::exists($galleryPath)) {
                File::makeDirectory($galleryPath, 0755, true);
            }

            // Generate unique filename
            $imageName = time().'_'.str_replace(' ', '_', $request->file('image')->getClientOriginalName());
            
            // Move uploaded file
            $request->file('image')->move($galleryPath, $imageName);
            
            // Store relative path in database
            $validated['image_url'] = 'images/gallery/'.$imageName;
        }

        $validated['is_active'] = $request->has('is_active');

        $gallery->update($validated);

        return redirect()->route('admin.gallery.index')
            ->with('success', 'Gallery image updated successfully!');
    }

    public function destroy(Gallery $gallery)
    {
        // Delete image file from public/images/gallery
        if ($gallery->image_url && file_exists(public_path($gallery->image_url))) {
            unlink(public_path($gallery->image_url));
        }

        $gallery->delete();

        return redirect()->route('admin.gallery.index')
            ->with('success', 'Gallery image deleted successfully!');
    }

    public function toggleActive(Gallery $gallery)
    {
        $gallery->update([
            'is_active' => !$gallery->is_active
        ]);

        return response()->json([
            'success' => true,
            'is_active' => $gallery->is_active,
            'message' => $gallery->is_active ? 'Image activated!' : 'Image deactivated!'
        ]);
    }
}
