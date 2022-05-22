<?php

namespace App\Http\Controllers;

use Auth;
use App\Item;
use App\Location;
use App\Purchase_Info;
Use App\TeamMember;
Use App\Transaction;
use App\User;
use App\Semester;
use App\Traits\Viewable;
use App\Http\Resources\ItemResource;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class TeamInventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($team)
    {
        $user = Auth::user();
        $team_member = $user->get_team_member();
        if ($user->master_admin == 0 && 
           (($team_member == 'Not Enrolled') || $team_member->team != $team)) 
           return redirect()->route('home');
        return view('pages.teamInventory')
                ->with('team', $team);
    }

    public function inventory($team)
    {
        $user = Auth::user();
        $team_items = $user->team_items($team);
        if (!is_object($team_items)) 
            return redirect()->route('home');
        else
            return $team_items;
    }

    public function single_item($id)
    {
        $user = Auth::user();
        $item = new ItemResource(Item::where('id', $id)->first());
        $team_member = $user->get_team_member();
        if ($item->team != $team_member->team) 
            return redirect()->route('home');
        else
            return view('pages.item')
                   ->with('team_member', $team_member)
                   ->with('item', $item);
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
        //
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
