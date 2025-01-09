<div class="d-flex justify-content-center gap-1">
    <div>
        <button onclick="editBranch({{ $branch->id }})" class="btn btn-sm btn-warning">Edit</button>
    </div>
    <div>
        <button onclick="deleteBranch({{ $branch->id }})" class="btn btn-sm btn-danger">Delete</button>
    </div>
</div>
