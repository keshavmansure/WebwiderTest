<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Http\Requests\StoreBranchRequest;
use App\Http\Requests\UpdateBranchRequest;
use App\Services\BranchService;

class BranchController extends Controller
{
    public function __construct(private BranchService $branchService) {}
    public function index()
    {
        if (request()->ajax()) {
            return $this->branchService->getBranches();
        }
        return view('branches.index');
    }

    public function create() {}


    public function store(StoreBranchRequest $request)
    {
        try {
            return $this->branchService->create($request->validated());
            return response()->json(['message' => 'Branch Created Successfully']);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Branch $branch)
    {
        return response()->json($branch);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Branch $branch)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBranchRequest $request, Branch $branch)
    {
        try {
            $this->branchService->update($branch, $request->validated());
            return response()->json(['message' => "Branch Updated Successfully"], 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Branch $branch)
    {
        try {
            $this->branchService->delete($branch);
            return response()->json(['message' => "branch deleted"]);
        } catch (\Throwable $th) {
            return response()->json(['message' => "error"], 400);
        }
    }
}
