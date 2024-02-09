<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Label;
use App\Models\Ticket;
use App\Models\Comment;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreTicketRequest;
use App\Http\Requests\UpdateTicketRequest;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
        // $users = User::all();
        $categories = Category::all();
        $labels = Label::all();

        return view('ticket.create', compact('categories','labels'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTicketRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTicketRequest $request)
    {

        $ticket = new Ticket();
        $ticket->title = $request->title;
        $ticket->message = $request->message;
        $ticket->priority = $request->priority;
        $ticket->status = $request->status;
        $ticket->user_id = $request->user_id;
        $ticket->save();
        // return $ticket;

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

            return redirect()->route('ticket.index')->with('success', 'Ticket is Updated successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function show(Ticket $ticket)
    {
        $categories = Category::all();
        $labels = Label::all();
        return view('ticket.show', compact('ticket','categories','labels'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function edit(Ticket $ticket)
    {
        // return $ticket;
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
     * @param  \App\Http\Requests\UpdateTicketRequest  $request
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTicketRequest $request, Ticket $ticket)
    {
        // return $request;

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
            // $ticket->user_id = $request->user_id;
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
                // $ticket->user_id = $request->user_id;
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
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ticket $ticket)
    {
        if($ticket){
            $ticket->delete();
        }
        return redirect()->back()->with('delete','Ticket is Deleted Successfully');
    }
}
