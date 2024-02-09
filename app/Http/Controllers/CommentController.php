<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCommentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCommentRequest $request)
    {
        $comment = new Comment();
        $comment->message = $request->message;
        $comment->user_id =Auth::user()->id;
        $comment->ticket_id = $request->ticket_id;
        $comment->save();
        return redirect()->back();
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {



    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {

        $ticket = Ticket::find($comment->ticket_id);
        $currentComment = $ticket->comments()->find($comment->id);
        return view('ticket.show',compact('comment','ticket','currentComment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCommentRequest  $request
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCommentRequest $request, Comment $comment)
    {
        $comment->message = $request->message;
        $comment->user_id =Auth::user()->id;
        $comment->ticket_id = $request->ticket_id;
        $comment->update();
        $ticket = Ticket::find($comment->ticket_id);
        return redirect()->route('ticket.show',compact('ticket'));

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment = Comment::find($id);

        // Check if the comment exists
        if (!$comment) {
            return redirect()->back()->with('error', 'Comment not found.');
        }

        // Check if the authenticated user is an admin or the owner of the comment
        if (Auth::user()->role === '0' || Auth::user()->id === $comment->user_id) {
            // Admin or comment owner can delete the comment
            $comment->delete();
            return redirect()->back()->with('success', 'Comment deleted successfully.');
        }

        // Check if the authenticated user is an agent and the comment is assigned to them
        if (Auth::user()->role === '1' && $comment->agent_id === Auth::user()->id) {
            // Agent can delete comments assigned to them
            $comment->delete();
            return redirect()->back()->with('success', 'Comment deleted successfully.');
        }

        // If none of the above conditions are met, the user is not authorized to delete the comment
        return redirect()->back()->with('error', 'You are not authorized to delete this comment.');
    }

}
