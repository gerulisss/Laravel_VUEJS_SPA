<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Agent;
use Illuminate\Http\Request;

class AgentController extends Controller
{
    public function index()
    {
        $agents = Agent::all()->toArray();
        return array_reverse($agents);
    }

    public function add(Request $request)
    {

        $agent = new Agent([
            'username' => $request->username,
        ]);

        $agent->save();

        return response()->json('The Agent successfully added');
    }


    public function edit($id)
    {
        $agent = Agent::find($id);
        return response()->json($agent);
    }


    public function update($id, Request $request)
    {
        $agent = Agent::find($id);
        $agent->update($request->all());

        return response()->json('The Agent successfully updated');
    }


    public function delete($id)
    {
        $agent = Agent::find($id);
        $agent->delete();

        return response()->json('The Agent successfully deleted');
    }
}
