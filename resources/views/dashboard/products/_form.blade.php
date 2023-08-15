@if ($errors->any())
    <div class="alert alert-danger">
        <h3>Error Occured! </h3>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>

    </div>
@endif

<div class="form-group d-flex">
    <div class="col-4">
        <x-form.input label="product Name" class="form-control" role="input" name="name" :value="$product->name" />
    </div>
    <div class="col-4">
        <label for="">price</label>
        <x-form.input name="price" :value="$product->price" />
    </div>

    <div class="col-4">
        <label for="">compare_price</label>
        <x-form.input name="compare_price" :value="$product->compare_price" />
    </div>
</div>

<div class="form-group d-flex">
    <div class="col-6">
        <label for="">Category</label>
        <select name="product_id" class="form-control form-select">
            <option value="">Primary product</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" @selected(old('category_id', $product->category_id) == $category->id)>{{ $category->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="col-6">
        <x-form.label id="image">Image</x-form.label>
        <x-form.input type="file" class="form-control mb-3" name="image" accept="image/*" />
        @if ($product->image)
            <img src="{{ $product->image }}" alt="" height="60">
        @endif
    </div>
</div>

<div class="">
    <x-form.input name="tags" class="with-border" :value="$tags"
        placeholder="e.g. job title, responsibilites" />
</div>


<div class="form-group ">
    <label for="">Status</label>
    <div class="">
        <x-form.radio name="status" :checked="$product->status" :options="['active' => 'Active', 'draft' => 'Draft', 'archived' => 'Archived']" />
    </div>
</div>

<div class="form-group ">
    <button type="submit" class="btn btn-primary">{{ $button_label ?? 'Save' }}</button>
</div>

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/Dashboard/dist/css/tagify.css') }}">
@endpush
@push('scripts')
<script src="{{ asset('assets/Dashboard/dist/js/tagify.min.js') }}"></script>
<script src="{{ asset('assets/Dashboard/dist/js/tagify.polyfills.min.js') }}"></script>
<script>
    var inputs = document.querySelector('[name=tags]'),
    tagify = new Tagify(inputs);
</script>
@endpush