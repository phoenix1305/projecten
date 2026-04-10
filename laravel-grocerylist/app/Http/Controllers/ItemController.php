<?php

namespace App\Http\Controllers;
use App\Http\Requests\StoreItemRequest;
use App\Http\Requests\UpdateItemRequest;
use App\Models\Category;
use App\Models\Item;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Item::all();
        return view('items.index', compact('items') );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('items.create');
    }

    /**
     * Store a newly created resource in storage.
        */
    
    
    // De Request class wordt vervangen door de StoreItemRequest
    public function store(StoreItemRequest $request) {
        $validated = $request->validated();

    // Maakt een nieuw item aan met de gevalideerde gegevens
        Item::create($validated);

        return redirect()->route('items.index');
}
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id) {
            $item = Item::find($id);
            return view('items.edit', compact('item'));
        }
        
    /**
     * Update the specified resource in storage.
     */
    
       // De Request class wordt vervangen door de UpdateItemRequest
    public function update(UpdateItemRequest $request, $id)
    {
    $validated = $request->validated();

    // Haalt het item op met het gegeven ID
    $item = Item::findOrFail($id);

    // Werkt het item bij met de gevalideerde gegevens
    $item->update($validated);

    return redirect()->route('items.index')->with('success', 'Item succesvol bijgewerkt.');
    }
    
    
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item) {
        $item->delete();
        return redirect()->route('items.index');
    }
}
