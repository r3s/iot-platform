<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use App\Http\Requests;

use App\Board;
use App\Device;
use App\MQTTAcl;
use Auth;

class DeviceController extends Controller
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
