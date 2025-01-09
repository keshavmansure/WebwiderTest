<?php

namespace App\Repositories;

use App\Models\Branch;
use Illuminate\Support\Facades\Cache;
use Yajra\DataTables\Facades\DataTables;

class BranchRepository
{



  public function getBranches()
  {
    $branches = Cache::remember('branches', 3600, function () {
      return Branch::all();
    });
    return DataTables::of($branches)
      ->addIndexColumn()
      ->addColumn('action', function ($branch) {
        return view('branches.actions', compact('branch'));
      })
      ->editColumn('created_at', function ($branch) {
        return $branch->created_at->format('Y-m-d H:i:s');
      })
      ->rawColumns(['action'])
      ->make(true);
  }

  public function create(array $data)
  {
    $branch =  Branch::create($data);
    Cache::forget('branches');
    return $branch;
  }
  public function update(Branch $branch, array $data)
  {
    $branch->update($data);
    Cache::forget('branches');
    return $branch;
  }
  public function delete(Branch $branch)
  {
    $branch->delete($branch);
    Cache::forget('branches');
    return true;
  }
}
