<div class="d-flex gap-1">
    <a href="{{ route('transactions.edit', $transaction->id) }}" class="btn btn-sm btn-outline-primary">Edit</a>
    <form action="{{ route('transactions.destroy', $transaction->id) }}" method="POST" onsubmit="return confirm('Delete karna hai?');">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
    </form>
</div>
