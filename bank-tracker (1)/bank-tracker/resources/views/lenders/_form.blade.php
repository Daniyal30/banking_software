@php $l = $lender ?? null; $d = $l->detail ?? null; @endphp

<h6 class="text-muted mb-2">Basic Info</h6>
<div class="mb-3">
    <label class="form-label">Name</label>
    <input type="text" name="name" class="form-control" value="{{ old('name', $l->name ?? '') }}" required>
</div>

<div class="mb-3">
    <label class="form-label">Phone (optional)</label>
    <input type="text" name="phone" class="form-control" value="{{ old('phone', $l->phone ?? '') }}">
</div>

<div class="mb-3">
    <label class="form-label">Notes (optional)</label>
    <textarea name="notes" class="form-control" rows="2">{{ old('notes', $l->notes ?? '') }}</textarea>
</div>

<hr>
<h6 class="text-muted mb-2">Personal Details</h6>

<div class="mb-3">
    <label class="form-label">CNIC / ID Number (optional)</label>
    <input type="text" name="cnic" class="form-control" value="{{ old('cnic', $d->cnic ?? '') }}">
</div>

<div class="mb-3">
    <label class="form-label">Address (optional)</label>
    <input type="text" name="address" class="form-control" value="{{ old('address', $d->address ?? '') }}">
</div>

<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label">City (optional)</label>
        <input type="text" name="city" class="form-control" value="{{ old('city', $d->city ?? '') }}">
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label">Relationship (optional)</label>
        <input type="text" name="relationship" class="form-control" placeholder="Friend / Relative / Colleague"
               value="{{ old('relationship', $d->relationship ?? '') }}">
    </div>
</div>

<div class="mb-3">
    <label class="form-label">Email (optional)</label>
    <input type="email" name="email" class="form-control" value="{{ old('email', $d->email ?? '') }}">
</div>
