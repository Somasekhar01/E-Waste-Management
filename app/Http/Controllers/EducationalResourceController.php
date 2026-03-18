<?php

namespace App\Http\Controllers;

use App\Models\EducationalResource;
use Illuminate\Http\Request;

class EducationalResourceController extends Controller
{
    public function index()
    {
        $resources = EducationalResource::where('is_published', true)
            ->latest('published_at')
            ->paginate(12);

        return view('educational-resources.index', compact('resources'));
    }

    public function show(EducationalResource $resource)
    {
        if (!$resource->is_published) {
            abort(404);
        }

        return view('educational-resources.show', compact('resource'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $type = $request->input('type');
        $tag = $request->input('tag');

        $resources = EducationalResource::where('is_published', true)
            ->when($query, function ($q) use ($query) {
                return $q->where('title', 'like', "%{$query}%")
                    ->orWhere('content', 'like', "%{$query}%");
            })
            ->when($type, function ($q) use ($type) {
                return $q->where('type', $type);
            })
            ->when($tag, function ($q) use ($tag) {
                return $q->whereJsonContains('tags', $tag);
            })
            ->latest('published_at')
            ->paginate(12);

        return view('educational-resources.index', compact('resources'));
    }
} 