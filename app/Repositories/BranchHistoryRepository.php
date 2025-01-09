<?php

namespace App\Repositories;

use App\Models\Branch;
use App\Models\BranchHistory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Yajra\DataTables\Facades\DataTables;

class BranchHistoryRepository
{

  public function getHistory()
  {
    return DataTables::of(BranchHistory::query()->with(['branch', 'user']))
      ->addIndexColumn()
      ->editColumn('created_at', function ($branchHistory) {
        return $branchHistory->created_at->format('d-m-Y H:i:s');
      })
      ->make(true);
  }
  public function createHistory(Branch $branch, string $action)
  {
    return BranchHistory::create([
      'branch_id' => $branch->id,
      'user_id' => Auth::id(),
      'action' => $action
    ]);
    
  }
}
