<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;

use Carbon\Carbon;

use App\Http\Requests;
use App\Board;
use App\MQTTUser;
use App\Hasher;
use Auth;
use Datatables;


    define("PBKDF2_HASH_ALGORITHM", "sha256");
        define("PBKDF2_ITERATIONS", 901);
        define("PBKDF2_SALT_BYTE_SIZE", 12);
        define("PBKDF2_HASH_BYTE_SIZE", 24);
        define("SEPARATOR", "$");
        define("TAG", "PBKDF2");

class BoardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.board.index')->withTitle('Board');
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
            $randPass = Auth::user()->name.''.date('YmdHis');
            

            $board = new Board;
            $board->name = $request->name;
            $board->key = md5($randKey);
            $board->password = sha1($randPass);
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
            $mqttUser->pw = $hasher->create_hash($board->password);;
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


    public function getTable()
    {
        $boards = Auth::user()->boards;

        return Datatables::of($boards)
                            ->editColumn('created_at', function($data){
                                $dt = new Carbon($data->created_at);
                                return $dt->toFormattedDateString();
                            })
                            ->addColumn('active', function($data){
                                return 'YES';
                            })
                            ->addColumn('actions', function($data){
                                $str = '<a href="'.route('board.show',$data->id).'" class="btn btn-success btn-circle"><i class="fa fa-search-plus"></i></a><a href="#" class="btn btn-primary btn-circle"><i class="fa fa-pencil"></i></a><a href="#" class="btn btn-warning btn-circle"><i class="fa fa-trash"></i></a>';
                                return $str;
                            })
                            ->removeColumn('id')
                            ->removeColumn('key')
                            ->removeColumn('password')
                            ->removeColumn('user_id')
                            ->removeColumn('updated_at')
                            ->make();
    }

}
