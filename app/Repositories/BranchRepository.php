<?php

namespace App\Repositories;

use App\Models\Branch;
use Yajra\DataTables\Facades\DataTables;

class BranchRepository
{



  public function getBranches()
  {
    return DataTables::of(Branch::query())
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
    return Branch::create($data);
  }
  public function update(Branch $branch, array $data)
  {
    return    $branch->update($data);
  }
  public function delete(Branch $branch)
  {
    $branch->delete($branch);
  }
}
