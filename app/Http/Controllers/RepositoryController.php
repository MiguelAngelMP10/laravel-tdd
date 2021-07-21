<?php

namespace App\Http\Controllers;

use App\Http\Requests\RepositoryRequest;
use App\Models\Repository;
use Illuminate\Http\Request;

class RepositoryController extends Controller
{
    public function index(  )
    {
        return view('repositories.index', [
            'repositories' => auth()->user()->repositories
        ]);
    }

    public function create()
    {
        return view('repositories.create');
    }

    public function store(RepositoryRequest $request)
    {
        $request->user()->repositories()->create($request->all());
        return redirect()->route('repositories.index');
    }

    public function update(RepositoryRequest $request, Repository $repository)
    {
        $this->authorize('pass', $repository);
        $repository->update($request->all());
        return redirect()->route('repositories.edit', $repository);
    }

    public function destroy(Repository $repository)
    {
        $this->authorize('pass', $repository);
        $repository->delete();
        return redirect()->route('repositories.index');
    }


    public function show(Request $request, Repository $repository)
    {
        $this->authorize('pass', $repository);
        return view('repositories.show', compact('repository'));
    }

    public function edit(Request $request, Repository $repository)
    {
        $this->authorize('pass', $repository);
        return view('repositories.edit', compact('repository'));
    }
}
