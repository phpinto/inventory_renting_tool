<?php

namespace App\Traits;

use App\Item;
use App\Location;
use App\Purchase_Info;
Use App\Team_Member;
Use App\Transaction;
use App\User;
use App\Semester;
use App\Http\Resources\ItemResource;
use App\Http\Resources\TransactionResource;

trait Viewable {

    public function get_team_member() {

        $semester = Semester::where('active', 1)->first();
        $teamMember = Team_Member::where('user_id', $this->id)
                                ->where('year', $semester->year)
                                ->where('term', $semester->term)
                                ->first();

        return is_null($teamMember) ? 'Not Enrolled' : $teamMember;
        
    }
    
    public function transaction_history() {

        $history = array();

        $transactions = Transaction::where('id', $this->id)
                            ->paginate(5);

        return $transactions->isEmpty() ? 
            array("data" => array("id" => $this->first_name." ".$this->last_name." does not currently have any logged transactions."))
            : TransactionResource::collection($transactions);
    } 


    public function pending_returns() {
        $transactions = $this.transaction_history();
        $pending = array();
        foreach($transactions as $transaction):
            if (is_null($transaction->returned_at) || empty($transaction->returned_at) || $transaction->returned_at == '') {
                array_push($pending, $transaction);
            }
        endforeach;
        return $pending;
    }

    public function pending_returns_count() {
        $transactions = $this.transaction_history();
        $pending = array();
        foreach($transactions as $transaction):
            if (is_null($transaction->returned_at) || empty($transaction->returned_at) || $transaction->returned_at == '') {
                array_push($pending, $transaction);
            }
        endforeach;
        return count($pending);
    }

    public function returned_items() {
        $transactions = $this.transaction_history();
        $returned = array();
        foreach($transactions as $transaction):
            if (!is_null($transaction->returned_at) || !empty($transaction->returned_at) || $transaction->returned_at != '') {
                array_push($returned, $transaction);
            }
        endforeach;
        return $returned;
    }

    public function returned_items_count() {
        $transactions = $this.transaction_history();
        $returned = array();
        foreach($transactions as $transaction):
            if (!is_null($transaction->returned_at) || !empty($transaction->returned_at) || $transaction->returned_at != '') {
                array_push($returned, $transaction);
            }
        endforeach;
        return count($returned);
    }


    public function team_items($team) {
        $team_member = $this->get_team_member();
        if ($this->master_admin == 1) {
            $items = Item::where('team', $team_member->team)
                          ->paginate(5);
            return $items->isEmpty() ? 
                array("data" => array("id" => "Team ".$team_member->team." does not currently have any logged items."))
                : ItemResource::collection($items);
        }
        else if ($team_member == 'Not Enrolled') return 0;
        else if ($team_member->team == $team) {
            $team_items = array();
            $items = Item::where('team', $team_member->team)
                           ->paginate(5);
            return $items->isEmpty() ? 
                array("data" => array("id" => "Team ".$team_member->team." does not currently have any logged items."))
                : ItemResource::collection($items);
        }
        else return 0;
    }


}