<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use App\Http\Requests;
use App\Board;
use App\MQTTUser;
use App\Hasher;
use Auth;

class BoardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.board.create')->withTitle('New Board');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!empty($request->name)){

            $hasher = new Hasher;
            $randKey = Auth::user()->name.''.time();
            $randPass = $hasher->create_hash(Auth::user()->name.''.date('YmdHis'));
            

            $board = new Board;
            $board->name = $request->name;
            $board->key = md5($randKey);
            $board->password = $randPass;
            $board->user_id = Auth::user()->id;
            $board->touch();
            
            if(!$board->save()){
                return redirect()->route('board.create')
                            ->withMessage('Oops, we encountered some error.')
                            ->withInput();
            }
            session(['current_board' => $board->id]);

            
            $mqttUser = new MQTTUser;
            $mqttUser->username = $board->key;
            $mqttUser->pw = $board->password;
            $mqttUser->super = false;
            $mqttUser->save();

            return redirect()->route('board.show', $board->id);
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
        $board = Board::find($id);
        return view('backend.board.show')
                    ->withBoard($board)
                    ->withTitle('Board');
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
