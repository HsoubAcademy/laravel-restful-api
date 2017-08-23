<?php

namespace App\Http\Controllers;

use App\Http\Transformers\TagsTransformer;
use App\Lesson;
use App\Tag;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class TagsController extends ApiController
{
    protected $tagsTransformer;
    /**
     * TagsController constructor.
     */
    public function __construct(TagsTransformer $tagsTransformer)
    {
        $this->tagsTransformer = $tagsTransformer;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($lessonId = null)
    {
        try
        {
            $tags = $lessonId ? Lesson::findOrFail($lessonId)->tags : Tag::all(); // all is bad
            return $this->respond([
                'data'  => $this->tagsTransformer->transformCollection($tags->toArray())
            ]);
        }
        catch(ModelNotFoundException $e)
        {
            return $this->respondNotFound();
        }
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
}
