<?php

namespace emutoday\Http\Controllers\Api;


use emutoday\Event;
use emutoday\Emutoday\Transformers\EventTransformer;

use Illuminate\Http\Request;
use Carbon\Carbon;

class EventsController extends ApiController
{
  /**
   * @var emutoday\Emutoday\Transformers\EventTransformer
   */
  protected $eventTransformer;

  function __construct(EventTransformer $eventTransformer)
  {
      $this->eventTransformer = $eventTransformer;
    //  $this->beforeFilter('auth.basic', ['on' => 'post']);
  }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

      // Current Issues:
      // 1. to many - must paginate
      // 2. Now way to attach metadata
      // 3. Linking db structurte to the API Output.. need to hide some data
      // 4. No error Checking

      $events = Event::all();

      return $this->respond([
          'data' => $this->eventTransformer->transformCollection($events->all())
      ]);
        //return Event::latest()->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      //return some kind of Response
      // 400  'bad request'
      // 403 Forbidden
      //
      // 422 'unprocessable entity'
      //
    //  if (! Input::get('title') or ! Input::get('location'))


    $validation = \Validator::make( $request->all(), [
                                  'title' => 'required',
                                  'location' => 'required',
                                  'start_date' => 'required',
                               ]);

     if( $validation->fails() )
     {
      //  return $this->setStatusCode(422)
      //              ->respondWithError($validation->errors()->getMessages());
       //
       return json_encode([
               'errors' => $validation->errors()->getMessages(),
               'code' => 422
            ]);
     }

    // if (! $request->input('title') or ! $request->input('location'))
    //   {
    //       return $this->setStatusCode(422)
    //                   ->respondWithError('Parameters failed validation for an event');
    //   }

      // Event::create(Input::all());
      Event::create($request->all());
      return $this->setStatusCode(201)->respondCreated('Event successfully created.');
      // $validation = \Illuminate\Support\Facades\Validator::make(
      //   $request->only('title','location','start_date', 'start_time'),[
      //    'title' => 'required|max:100',
      //    'location'       => 'required',
      //    'start_date'     => 'required',
      //    'start_time'     => 'required',
      //   ]);


        // if($validation->passes())
        // {
        //   $event = new Event;
        //   $event->author_id       = auth()->user()->id;
        //   $event->title           = $request->get('title');
        //   $event->short_title     = $request->get('short_title');
        //   $event->location        = $request->get('location');
        //   $event->start_date      = \Carbon\Carbon::parse($request->get(start_date));
        //   $event->start_time     = \Carbon\Carbon::parse($request->get(start_time));
        //
        //   if($event->save()) {
        //     return response()->json([
        //             'success' => true,
        //             'message' => 'record updated'
        //         ], 200);
        //   }
        // }
        //
        // $errors = $validation->errors();
        // $errors =  json_decode($errors);
        //
        // return response()->json([
        //   'success' => false,
        //   'message' => $errors
        // ], 422);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $event = Event::find($id);

      if (! $event)
      {
          return $this->respondNotFound('Event Does Not Exist!');
      }

      return $this->respond([
          'data' => $this->eventTransformer->transform($event)

      ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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