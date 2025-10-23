<div class="mb-3">
    <label>Name</label>
    <input type="text" name="name" class="form-control" value="{{ old('name', $service->name ?? '') }}" required>
</div>

<div class="mb-3">
    <label>Description</label>
    <textarea name="description" class="form-control" required>{{ old('description', $service->description ?? '') }}</textarea>
</div>

<div class="mb-3">
    <label>Category</label>
    <select name="service_category_id" class="form-control" required>
        <option value="">Select Category</option>
        @foreach($categories as $category)
            <option value="{{ $category->id }}" {{ (old('service_category_id', $service->service_category_id ?? '') == $category->id) ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label>Base Price</label>
    <input type="number" name="base_price" class="form-control" value="{{ old('base_price', $service->base_price ?? '') }}" required>
</div>

<div class="mb-3">
    <label>Image</label>
    <input type="file" name="image" class="form-control">
    @if(!empty($service->image))
        <img src="{{ asset('storage/'.$service->image) }}" alt="" width="100" class="mt-2">
    @endif
</div>

<div class="form-check mb-3">
    <input type="checkbox" name="active" class="form-check-input" {{ old('active', $service->active ?? true) ? 'checked' : '' }}>
    <label class="form-check-label">Active</label>
</div>
