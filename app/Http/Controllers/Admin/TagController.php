<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::withCount('products')->orderBy('label')->get();

        return view('admin.tags.index', compact('tags'));
    }

    public function create()
    {
        return view('admin.tags.form', ['tag' => new Tag()]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        $key = Str::slug($request->input('key', $data['label']));

        if (Tag::where('key', $key)->exists()) {
            return back()->withInput()->withErrors(['key' => "A tag with key \"{$key}\" already exists."]);
        }

        Tag::create($data + ['key' => $key]);

        return redirect()->route('admin.tags.index')->with('success', 'Tag created.');
    }

    public function edit(Tag $tag)
    {
        return view('admin.tags.form', compact('tag'));
    }

    public function update(Request $request, Tag $tag)
    {
        $tag->update($this->validated($request));

        return redirect()->route('admin.tags.index')->with('success', 'Tag updated.');
    }

    public function destroy(Tag $tag)
    {
        if ($tag->products()->exists()) {
            return back()->with('error', "Can't delete \"{$tag->label}\" — it's assigned to products. Remove it from those products first.");
        }

        $tag->delete();

        return redirect()->route('admin.tags.index')->with('success', 'Tag deleted.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'label'           => ['required', 'string', 'max:40'],
            'badge_class'     => ['required', 'string', 'max:100'],
            'blocks_ordering' => ['sometimes', 'boolean'],
        ]) + ['blocks_ordering' => $request->boolean('blocks_ordering')];
    }
}
