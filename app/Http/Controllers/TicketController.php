<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Label;
use App\Models\Ticket;
use App\Models\Comment;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $tickets = Ticket::all();
        // return view('ticket.index',compact('tickets'));

        $user = auth()->user();

        if ($user->role === '0') {
            $tickets = Ticket::all();
        } elseif ($user->role === '1') {
            $tickets = Ticket::with('agent')
                ->where(function ($query) use ($user) {
                    $query->where('user_id', $user->id)
                        ->orWhere('agent_id', $user->id);
                })
                ->get();
        } else {
            $tickets = Ticket::where('user_id', auth()->id())->get();
        }

        return view('ticket.index', compact('tickets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $labels = Label::all();
        return view('ticket.create',compact('categories','labels'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $ticket = new Ticket();
        $ticket->title = $request->title;
        $ticket->message = $request->message;
        $ticket->priority = $request->priority;
        $ticket->status = $request->status;
        $ticket->user_id = $request->user_id;

        $ticket->save();

        foreach ($request->file('files') as $file) {
            if ($file) {
                $newName = "gallery_" . uniqid() . "." . $file->extension();
                $file->storeAs("public/gallery", $newName);

                // Create a file record in the ticket_files table
                $ticket->ticketFiles()->create([
                    'file_name' => $newName,
                ]);
            }
        }

            if ($request->category_id) {
                $ticket->category()->attach($request->category_id);
            }

            if ($request->label_id) {
                $ticket->label()->attach($request->label_id);
            }

            return redirect()->route('ticket.index')->with('success', 'Ticket is created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ticket = Ticket::find($id);
        $comment = Comment::find($id);
        return view('ticket.show',compact('ticket','comment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $ticket = Ticket::find($id);
        $existingCategories = $ticket->category->pluck('id')->toArray();
        $existingLabels = $ticket->label->pluck('id')->toArray();
        $categories = Category::all();
        $labels = Label::all();
        $users = User::all();
        $agents = User::where('role', '1')->get();
        return view('ticket.edit', compact('ticket','categories','labels','agents','existingCategories','existingLabels'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $ticket = Ticket::find($id);
       // If new files are provided, delete existing files and update with new files
       if ($request->hasFile('files')) {
        // Delete existing files associated with the ticket
        foreach ($ticket->ticketFiles as $file) {
            Storage::delete("public/gallery/{$file->file_name}");
            $file->delete();
        }

        // Update ticket information
        $ticket->title = $request->title;
        $ticket->message = $request->message;
        $ticket->priority = $request->priority;
        $ticket->status = $request->status;
        $ticket->user_id = $request->user_id;
        $ticket->agent_id = $request->agent_id;
        $ticket->update();

        // Upload new files
        foreach ($request->file('files') as $file) {
            if ($file) {
                $newName = "gallery_" . uniqid() . "." . $file->extension();
                $file->storeAs("public/gallery", $newName);

                // Create a file record in the ticket_files table
                $ticket->ticketFiles()->create([
                    'file_name' => $newName,
                ]);
            }
        }
    } else {
        // If no new files are provided, update only the ticket information
        $ticket->title = $request->title;
        $ticket->message = $request->message;
        $ticket->priority = $request->priority;
        $ticket->status = $request->status;
        $ticket->user_id = $request->user_id;
        $ticket->agent_id = $request->agent_id;
        $ticket->update();


    }

    // Attach categories and labels if provided
    if ($request->category_id) {
        $ticket->category()->sync($request->category_id);
    }

    if ($request->label_id) {
        $ticket->label()->sync($request->label_id);
    }

    return redirect()->route('ticket.index')->with('success', 'Ticket is updated successfully');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ticket = Ticket::find($id);
        if($ticket){
            $ticket->delete();
        }
        return redirect()->route('ticket.index')->with('delete','Ticket is deleted!');
    }
}
