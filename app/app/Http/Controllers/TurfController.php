<?php

namespace App\Http\Controllers;

use App\Models\Turf;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TurfController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $turfs = Turf::query()
            ->when($request->search, fn($query)=>
                $query->where('turf_name', 'like', '%' . $request->search . '%')
            )
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return Inertia::render('turfs/Index', [
            'turfs' => $turfs,
            'filters' => $request->only('search'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
