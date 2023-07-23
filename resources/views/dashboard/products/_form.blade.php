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
        <label for="">product product</label>
        <select name="product_id" class="form-control form-select">
            <option value="">Primary product</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" @selected(old('category_id', $product->category_id) == $category->id)>{{ $category->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-6">
        <x-form.label id="image">Image</x-form.label>
        <x-form.input type="file" class="form-control" name="image" accept="image/*" />
        @if ($product->image)
            <img src="{{ $product->image }}" alt="" height="60">
        @endif
    </div>
</div>


<label for="">tags</label>
<x-form.input name="compare_price" :value="$product->compare_price" />



<div class="form-group ">
    <label for="">Status</label>
    <div class="">
        <x-form.radio name="status" :checked="$product->status" :options="['active' => 'Active', 'draft' => 'Draft', 'archived' => 'Archived']" />
    </div>
</div>

<div class="form-group ">
    <button type="submit" class="btn btn-primary">{{ $button_label ?? 'Save' }}</button>
</div>
{{-- ['category_id','store_id','name','slug','description','image','price','','',]; --}}
