<div class="d-flex gap-1">
    <a href="{{ route('loans.show', $loan->id) }}" class="btn btn-sm btn-outline-secondary">View</a>
    <a href="{{ route('loans.edit', $loan->id) }}" class="btn btn-sm btn-outline-primary">Edit</a>
    <form action="{{ route('loans.destroy', $loan->id) }}" method="POST" onsubmit="return confirm('Delete karna hai?');">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
    </form>
</div>
