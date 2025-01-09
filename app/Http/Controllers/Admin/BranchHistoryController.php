<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BranchHistory;
use App\Repositories\BranchHistoryRepository;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class BranchHistoryController extends Controller
{
    public function __construct(private BranchHistoryRepository $branchHistoryRepository) {}
    public function __invoke()
    {
        if (request()->ajax()) {
            return $this->branchHistoryRepository->getHistory();
        }
        return view('admin.dashboard');
    }
}
