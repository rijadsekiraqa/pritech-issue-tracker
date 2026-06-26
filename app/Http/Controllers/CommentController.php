<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Comment\StoreCommentRequest;
use App\Http\Requests\Comment\UpdateCommentRequest;
use App\Models\Comment;
use App\Models\Issue;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $comments = Comment::latest()->paginate(10);
        return view('comments.index', compact('comments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $issues = Issue::orderBy('title')->get();
        return view('comments.create', compact('issues'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCommentRequest $request)
    {
        Comment::create($request->validated());
        return redirect()->route('comments.index')->with('success', 'Comment created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        $comment->load('issue');

        return view('comments.show', compact('comment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        $issues = Issue::orderBy('title')->get();
        return view('comments.edit', compact('comment', 'issues'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCommentRequest $request, Comment $comment)
    {
        $comment->update($request->validated());
        return redirect()->route('comments.index')
            ->with('success', 'Comment updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();
        return redirect()->route('comments.index')
            ->with('success', 'Comment deleted successfully');
    }

    public function loadComments(Issue $issue)
    {
        $comments = $issue->comments()
            ->latest()
            ->paginate(5);

        return response()->json($comments);
    }

    public function storeAjax(StoreCommentRequest $request, $issueId)
    {
        $data = $request->validated();

        $data['issue_id'] = $issueId;

        $comment = Comment::create($data);

        return response()->json([
            'message' => 'Comment created successfully',
            'comment' => $comment
        ]);
    }
}
