<?php

namespace App\Http\Controllers;

use App\Models\Label;
use App\Models\Ticket;
use App\Models\Category;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tickets = Ticket::all();
        return view('ticket.index',compact('tickets'));
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
<<<<<<< HEAD
        $file = $request->file('file'); // Accessing the file correctly

if ($file) {
    $newName = "gallery_" . uniqid() . "." . $file->extension();
    $file->storeAs("public/gallery", $newName);
    // $ticket->file = $newName;
}

        $ticket = new Ticket();
        $ticket->title = $request->title;
        $ticket->message = $request->message;
        $ticket->priority = $request->priority;
        // $ticket->category_id = $request->category_id;
        // $ticket->label_id = $request->label_id;
        $ticket->file = $newName;
        $ticket->status = $request->status;
        // $ticket->file = $request->file;
        $ticket->save();
        if($request->category_id){
            $ticket->category()->attach($request->category_id);
        }
        if($request->label_id)
        {
            $ticket->label()->attach($request->label_id);
        }


        // $ticket->label()->sync($request->input('labels', []));
        // $ticket->category()->sync($request->input('categories',[]));
=======
        $ticket = Ticket::create($request->all());

        $ticket->labels()->attach($request->labels);
        $ticket->categories()->attach($request->categories);

        // $ticket = new Ticket();
        // $ticket->title = $request->title;
        // $ticket->message = $request->message;
        // $ticket->priority = $request->priority;
        // $ticket->category_id = $request->category;
        // $ticket->label_id = $request->label;
        // $ticket->status = $request->status;
        // $ticket->file = $request->file;
        // $ticket->save();
        // $ticket->label()->sync($request->input('label', []));
        // $ticket->category()->sync($request->input('category',[]));
>>>>>>> 4f6e6fb0aba077bf7c03627090d7dc4c36d33b3c
        return redirect()->route('ticket.index')->with('success','Ticket is created successfully');
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
        return view('ticket.show',compact('ticket'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::all();
        $labels = Label::all();
        $ticket = Ticket::find($id);
        return view('ticket.edit',compact('ticket','categories','labels'));
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
        if($request->file){
            $file = $request->file;
            $newName = "gallery_".uniqid().".".$file->extension();
            $file -> storeAs("public/gallery",$newName);
            $ticket->title = $request->title;
            $ticket->message = $request->message;
            $ticket->priority = $request->priority;
            $ticket->status = $request->status;
            $ticket->file = $newName;
            $ticket->update();
        }

        $ticket = Ticket::find($id);
        $ticket->title = $request->title;
        $ticket->message = $request->message;
        $ticket->priority = $request->priority;
        $ticket->status = $request->status;
        $ticket->update();
        return redirect()->route('ticket.index')->with('update','Ticket is updated successfully');
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
