<?php

namespace App\Http\Controllers;

use App\Events\LessonWasDeleted;
use App\Http\Transformers\LessonsTransformer;
use App\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class LessonsController extends ApiController
{

    protected $lessonsTransformer;

    public function __construct(LessonsTransformer $lessonsTransformer){
        $this->lessonsTransformer = $lessonsTransformer;

        $this->middleware('auth.token:admin,create_lessons|update_lessons', ['only' => ['store', 'update']]);
        $this->middleware('auth.token', ['except' => ['store', 'update']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // 1. all is bad
        // 2. no meta data
        // 3. database schema exposed
        // 4. status code

        $limit = $request->limit ?: 3;
        if($limit > 30) $limit = 30;

        $lessons = Lesson::paginate($limit);

        return $this->respondWithPagination($lessons, $lessons->all());
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
        if( ! $request->title || ! $request->body){
            return $this->respondInvalidRequest();
        }

        Lesson::create([
            'title' => $request->title,
            'body'  => $request->body,
            'is_ready'  => $request->active
        ]);

        return $this->respondCreated();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $lesson = Lesson::find($id);
        if( ! $lesson ){
            // failure
            return $this->respondNotFound();
        }
        // success
        return $this->respond([
            'data'  => $this->lessonsTransformer->transform($lesson)
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
        $lesson = Lesson::find($id);
        $lesson->delete();
        event(new LessonWasDeleted($lesson));
        return $this->respondDeleted();
    }
}
