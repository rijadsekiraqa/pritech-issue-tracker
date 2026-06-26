<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Issue\StoreIssueRequest;
use App\Http\Requests\Issue\UpdateIssueRequest;
use App\Models\Issue;
use App\Models\Project;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;

class IssueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Issue::with(['project', 'tags']);

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

        if ($request->filled('tag_id')) {
            $query->whereHas('tags', function ($q) use ($request) {
                $q->where('tags.id', $request->tag_id);
            });
        }


      $issues = $query->latest()->get();

        $tags = Tag::orderBy('name')->get();

        if ($request->ajax()) {
            return view('issues.partials.table', compact('issues'))->render();
        }

        return view('issues.index', compact('issues', 'tags'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $projects = Project::all();

        return view('issues.create', compact('projects'));
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
        $issue->load(['project', 'tags', 'members']);
        $tags = Tag::all();
        $users = User::all();
        return view('issues.show', compact('issue', 'tags', 'users'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Issue $issue)
    {
        $projects = Project::all();
        return view('issues.edit', compact('issue', 'projects'));
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

    public function attachMember(Request $request, Issue $issue)
    {
        $issue->members()->syncWithoutDetaching([$request->user_id]);

        return response()->json([
            'success' => true,
            'user' => User::find($request->user_id)
        ]);
    }

    public function detachMember(Issue $issue, User $user)
    {
        $issue->members()->detach($user->id);

        return response()->json([
            'success' => true,
            'user' => [
                'id'   => $user->id,
                'name' => $user->name,
            ]
        ]);
    }
}
