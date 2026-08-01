@php $loanRecord = $loan ?? null; @endphp

<div class="mb-3">
    <label class="form-label">Lender</label>
    <select name="lender_id" class="form-select" required>
        <option value="">-- Select --</option>
        @foreach ($lenders as $lender)
            <option value="{{ $lender->id }}" @selected(old('lender_id', $loanRecord->lender_id ?? '') == $lender->id)>
                {{ $lender->name }}
            </option>
        @endforeach
    </select>
    @if ($lenders->isEmpty())
        <div class="form-text text-danger">Pehle <a href="{{ route('lenders.create') }}">lender add</a> karein.</div>
    @endif
</div>

<div class="mb-3">
    <label class="form-label">Loan Amount</label>
    <input type="number" step="0.01" name="amount" class="form-control"
           value="{{ old('amount', $loanRecord->amount ?? '') }}" required>
</div>

<div class="mb-3">
    <label class="form-label">Loan Date</label>
    <input type="date" name="loan_date" class="form-control"
           value="{{ old('loan_date', isset($loanRecord) ? $loanRecord->loan_date->format('Y-m-d') : now()->format('Y-m-d')) }}" required>
</div>

<div class="mb-3">
    <label class="form-label">Description (optional)</label>
    <textarea name="description" class="form-control" rows="2">{{ old('description', $loanRecord->description ?? '') }}</textarea>
</div>
