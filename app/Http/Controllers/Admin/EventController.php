<?php

namespace emutoday\Http\Controllers\Admin;

use Illuminate\Http\Request;

use emutoday\Http\Requests;

use emutoday\Event;

class EventController extends Controller
{

  protected $events;

  public function __construct(Event $events)
  {
    $this->events = $events;
  }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $events = $this->events->orderBy('created_at', 'desc')->paginate(10);

      return view('admin.event.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Event $event)
    {
        return view('admin.event.form', compact('event'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\StoreEventRequest $request)
    {
      $data = [
        'author_id' => auth()->user()->id,
        'title' => $request->title,
        'short_title' => $request->short_title,
        'location' => $request->location,
        'start_date' => \Carbon\Carbon::parse($request->start_date),
        'end_date' => \Carbon\Carbon::parse($request->end_date),
        'all_day' => $request->is_approved,
        'no_end_time' => $request->is_promoted,
        'description' => $request->description
    ];
      $event = $this->events->create($data);
      flash()->success('Event has been created.');
      return redirect(route('admin.event.edit', $event->id));//->with('status', 'Story has been created.');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $event = $this->events->findOrFail($id);
      return view('admin.event.form', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\UpdateEventRequest $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
