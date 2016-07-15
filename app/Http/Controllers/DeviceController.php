<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redis;
use App\Http\Requests;

use App\Board;
use App\DisplayType;
use App\Device;
use App\MQTTAcl;
use Auth;

use Datatables;
use Carbon\Carbon;

class DeviceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.device.index')->withTitle('Device');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $boards = Board::all();
        return view('backend.device.create')
                ->withBoards($boards)
                ->withTitle('New Device');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = $this->validator($request);

        if(!$validator->fails()){

            $randTopic = Auth::user().'-'.time();

            $device = new Device;
            $device->name = $request->name;
            $device->display_type = $request->display_type;
            $device->output_enabled = ($request->output)?true:false;
            $device->board_id = $request->board;
            $device->topic = md5($randTopic);

            if($device->save()){
                $mqttAcl = new MQTTAcl;
                $mqttAcl->username = $device->board->key;
                $mqttAcl->topic = $device->board->key.'/'.$device->topic;
                $mqttAcl->rw = true;
                $mqttAcl->save();
                return redirect()->route('device.show', $device->id);
            }

            $validator->errors->add('Error', 'Oops, we encountered an unexpected error');

        }

        return redirect()->route('device.create')
                        ->withErrors($validator);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $device = Device::find($id);
        return view('backend.device.show')
                ->withDevice($device)
                ->withTitle('Device');
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
        $devices = new \Illuminate\Database\Eloquent\Collection;
        foreach ($boards as $board) {
            foreach ($board->devices as $device) {
                $devices->add($device);
            }
        }
       

        return Datatables::of($devices)
                            ->addColumn('board', function($data){
                                return $data->board->name;
                            })
                            ->editColumn('display_type', function($data){
                                return DisplayType::find($data->display_type)->name;
                            })
                            ->editColumn('output_enabled', function($data){
                                return ($data->output_enabled==true)?'YES':'NO';
                            })
                            ->editColumn('created_at', function($data){
                                $dt = new Carbon($data->created_at);
                                return $dt->toFormattedDateString();
                            })
                            ->addColumn('active', function($data){
                                return 'YES';
                            })
                            ->addColumn('actions', function($data){
                                $str = '<a href="'.route('device.show',$data->id).'" class="btn btn-success btn-circle"><i class="fa fa-search-plus"></i></a><a href="#" class="btn btn-primary btn-circle"><i class="fa fa-pencil"></i></a><a href="#" class="btn btn-warning btn-circle"><i class="fa fa-trash"></i></a>';
                                return $str;
                            })
                            ->removeColumn('id')
                            ->removeColumn('topic')
                            ->removeColumn('board_id')
                            ->removeColumn('updated_at')
                            ->make();
    }

    public function updateVal($id, Request $request){
        $device = Device::find($id);
        $topic = $device->topic;
        $value = $request->input('value');
        $data = array('topic' => $topic, 'value'=>$value );

        $redis = Redis::connection();
        $redis->publish('mqtt-channel', json_encode($data));

        return response()->json(['status'=>'success']);
    }

    public function validator(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'display_type' => 'required',
            'board' => 'required',
        ]);
        return $validator;
    }

}
