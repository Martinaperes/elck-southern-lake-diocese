<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Http\Requests\Admin\GalleryRequest;
use App\Traits\FileUploadTrait;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    use FileUploadTrait;

    public function index(Request $request)
    {
        $query = Gallery::query();
        
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', "%{$request->search}%")
                  ->orWhere('description', 'like', "%{$request->search}%");
            });
        }
        
        if ($request->filled('status')) {
            $query->where('is_active', $request->status === 'active');
        }
        
        $galleries = $query->latest()->paginate(12);
        
        return view('admin.gallery.index', array_merge(compact('galleries'), $this->getBasicStats()));
    }

    public function create()
    {
        return view('admin.gallery.create', $this->getBasicStats());
    }

    public function store(GalleryRequest $request)
    {
        $data = $request->validated();
        
        if ($request->hasFile('image')) {
            // Using public_path to maintain existing directory structure if needed, 
            // but trait supports relative storage path too. Let's use public disk for consistency with modern Laravel.
            $data['image_url'] = $this->uploadImage($request->file('image'), 'gallery');
        }

        $data['is_active'] = $request->has('is_active');
        Gallery::create($data);

        return redirect()->route('admin.gallery.index')->with('success', 'Image added successfully!');
    }

    public function show(Gallery $gallery)
    {
        return view('admin.gallery.show', array_merge(compact('gallery'), $this->getBasicStats()));
    }

    public function edit(Gallery $gallery)
    {
        return view('admin.gallery.edit', array_merge(compact('gallery'), $this->getBasicStats()));
    }

    public function update(GalleryRequest $request, Gallery $gallery)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image_url'] = $this->uploadImage($request->file('image'), 'gallery', $gallery->image_url);
        }

        $data['is_active'] = $request->has('is_active');
        $gallery->update($data);

        return redirect()->route('admin.gallery.index')->with('success', 'Gallery image updated successfully!');
    }

    public function destroy(Gallery $gallery)
    {
        $this->deleteFile($gallery->image_url);
        $gallery->delete();

        return redirect()->route('admin.gallery.index')->with('success', 'Gallery image deleted successfully!');
    }

    public function toggleActive(Gallery $gallery)
    {
        $gallery->update(['is_active' => !$gallery->is_active]);

        return response()->json([
            'success' => true,
            'is_active' => $gallery->is_active,
            'message' => $gallery->is_active ? 'Image activated!' : 'Image deactivated!'
        ]);
    }

    protected function getBasicStats(): array
    {
        return [
            'totalGalleries' => Gallery::count(),
            'activeGalleries' => Gallery::where('is_active', true)->count(),
        ];
    }
}

