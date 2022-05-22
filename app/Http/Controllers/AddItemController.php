<?php

namespace App\Http\Controllers;

use Auth;
use App\Item;
use App\Location;
use App\Category;
use App\Purchase_Info;
Use App\TeamMember;
Use App\Transaction;
use App\User;
use App\Semester;
use App\Traits\Viewable;
use App\Http\Resources\ItemResource;
use App\Http\Resources\CategoryResource;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
class AddItemController extends Controller
{
    public function addItemForm() {

        //$categories = CategoryResource::collection(Category::all());
        $categories = Category::all();
        return view('pages.addItemForm')
            ->with('categories', $categories);

    }

    public function submit(Request $request) {

        $request -> validate([
            'name' => 'required|string',
            'category' => 'required|integer',
            'serial_number' => 'string|nullable',
            'num_items' => 'required|integer',
            'description' => 'string|max:1000'
        ]);

        $item = new Item;
        $item->name = $request->name;
        $item->description = $request->description;
        $item->category_id = $request->category;
        $item->team = 'VP3';
        $item->available = $request->num_items;
        $item->total = $request->num_items;

        $item->save();
        return response()->json(null, 200);

    }
}

