<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreIssueRequest;
use App\Http\Requests\UpdateIssueRequest;
use App\Models\Issue;
use App\Models\Project;
use App\Models\Tag;
use Illuminate\Http\Request;

class IssueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index(Request $request)
{
    $query = Issue::with('project');

    if ($request->filled('search')) {
        $search = $request->search;

        $query->where(function ($q) use ($search) {
            $q->where('title', 'like', "%{$search}%")
              ->orWhere('description', 'like', "%{$search}%");
        });
    }

    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }

    if ($request->filled('priority')) {
        $query->where('priority', $request->priority);
    }

    $issues = $query->latest()
        ->paginate(10)
        ->withQueryString();

    if ($request->ajax()) {
        return view('issues.partials.table', compact('issues'))->render();
    }

    return view('issues.index', compact('issues'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $projects = Project::all();
        $tags = Tag::all();

        return view('issues.create', compact('projects', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreIssueRequest $request)
    {
        $issue = Issue::create($request->validated());

        if ($request->has('tags')) {
            $issue->tags()->attach($request->tags);
        }

        return redirect()->route('issues.index')
            ->with('success', 'Issue created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Issue $issue)
    {
        $issue->load(['project', 'tags',]);
        $tags = Tag::all();
        return view('issues.show', compact('issue', 'tags'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Issue $issue)
    {
        $projects = Project::all();
        $tags = Tag::all();
        $issue->load('tags');
        return view('issues.edit', compact('issue', 'projects', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateIssueRequest $request, Issue $issue)
    {
        $issue->update($request->validated());

        if ($request->has('tags')) {
            $issue->tags()->sync($request->tags);
        }

        return redirect()
            ->route('issues.index')
            ->with('success', 'Issue updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Issue $issue)
    {
        $issue->delete();
        return redirect()->route('issues.index')
            ->with('success', 'Issue deleted successfully');
    }

    public function attachTag(Request $request, Issue $issue)
    {
        $request->validate([
            'tag_ids' => 'required|array',
            'tag_ids.*' => 'exists:tags,id',
        ]);

        $issue->tags()->syncWithoutDetaching($request->tag_ids);

        return response()->json([
            'success' => true
        ]);
    }

    public function detachTag(Issue $issue, Tag $tag)
    {
        $issue->tags()->detach($tag->id);

        return response()->json([
            'tag' => [
                'id' => $tag->id,
                'name' => $tag->name
            ]
        ]);
    }
}
