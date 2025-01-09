<?php

namespace App\Services;

use App\Models\Branch;
use App\Repositories\BranchRepository;
use App\Repositories\BranchHistoryRepository;

class BranchService
{
  public function __construct(private BranchRepository $branchRepository, private BranchHistoryRepository $branchHistoryRepository) {}

  public function getBranches()
  {
    return $this->branchRepository->getBranches();
  }
  public function create($data)
  {
    $branch =  $this->branchRepository->create($data);
    $this->branchHistoryRepository->createHistory($branch, 'create');
    return $branch;
  }
  public function update(Branch $branch, array $data)
  {
    $this->branchRepository->update($branch, $data);
    $this->branchHistoryRepository->createHistory($branch, 'update');
    return $branch;
  }
  public function delete(Branch $branch)
  {
    $this->branchHistoryRepository->createHistory($branch, 'delete');
    $this->branchRepository->delete($branch);
  }
}
