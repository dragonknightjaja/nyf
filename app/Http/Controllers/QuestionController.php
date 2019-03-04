<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Http\Requests\StoreQuestionRequest;
use App\Question;

class QuestionController extends Controller
{
    public function __construct(){
        $this->middleware('auth')->except(['index','show']);//保证只有用户登录后才能访问index,show。我也不知道这是怎么实现的。
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return 'index';
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('questions.create');
    }
 
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreQuestionRequest $request)
    {
        // $rules = [
        //     'title' =>'required|min:6|max:196',
        //     'body' => 'required|min:26',
        // ];
        // $msg = [
        //     'title.required' =>'标题不能为空',
        //     'title.min' =>'标题至少6个字符',
        //     'title.max' =>'标题最多196个字符',
        //     'bofy.required' =>'内容不能为空',
        //     'bofy.min' =>'内容至少26个字符'

        // ];
        // $this->validate($request,$rules,$msg);
        
        $data = [
            'title'=>$request->get('title'),
            'body'=>$request->get('body'),
            'user_id'=>Auth::id()
        ];
        $question = Question::create($data);
        //dd($question->id);
        return redirect()->route('question.show',['id'=>$question->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $question = Question::find($id);
        return view('questions.show',compact('question'));
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
