@php $t = $transaction ?? null; @endphp

<div class="mb-3">
    <label class="form-label">Type</label>
    <select name="type" class="form-select" required>
        <option value="">-- Select --</option>
        <option value="credit" @selected(old('type', $t->type ?? '') === 'credit')>Credit (Paisa aya)</option>
        <option value="debit" @selected(old('type', $t->type ?? '') === 'debit')>Debit (Paisa gaya)</option>
    </select>
</div>

<div class="mb-3">
    <label class="form-label">Amount</label>
    <input type="number" step="0.01" name="amount" class="form-control"
           value="{{ old('amount', $t->amount ?? '') }}" required>
</div>

<div class="mb-3">
    <label class="form-label">Date</label>
    <input type="date" name="transaction_date" class="form-control"
           value="{{ old('transaction_date', isset($t) ? $t->transaction_date->format('Y-m-d') : now()->format('Y-m-d')) }}" required>
</div>

<div class="mb-3">
    <label class="form-label">Description (optional)</label>
    <textarea name="description" class="form-control" rows="2">{{ old('description', $t->description ?? '') }}</textarea>
</div>
