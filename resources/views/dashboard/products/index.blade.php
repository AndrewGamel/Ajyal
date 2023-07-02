@section('title', 'products')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">
        products</li>
@endsection

{{-- @section('nav-item-1', 'active')
@section('nav-item-2', '')
@section('nav-item-3', '') --}}

<x-dashboard-layout>

    <input type="search" name="search" id="search" placeholder="Enter ID 'Live Search'"
        class="form-control col-2 mb-3 mx-1">

    <form action="{{ URL::current() }}" method="get" class="d-flex justify-content-between mb-4">
        <x-form.label />
        <x-form.input onfocus="this.value=''" class="p-1 " placeholder="Enter Name" type="text" name='name'
            role="input" :value="request('name')" />
        <x-form.select name='status' class="mx-2" selected_value='All' :options="['active' => 'Active', 'archived' => 'Archived']" :selected="request('status')" />
        {{-- <  :selected="$category->parent_id" /> --}}

        <input type="submit" class="btn btn-outline-light ml-2" value="Filter">
    </form>

    <div class="mb-5">
        <a href="{{ route('dashboard.products.create') }}" class="btn btn-sm btn-outline-primary mr-2"><i
                class="fas fa-plus mr-2"></i>Create</a>
        <a href="{{ route('dashboard.products.trash') }}" class="btn btn-sm btn-outline-warning mr-2"><i
                class="fas fa-trash mr-2"></i>trash</a>
    </div>

    <x-alert type="success" />
    <x-alert type="info" />


    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th colspan="1">No | ID </th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Category</th>
                    @if (Auth::user()->id == 1)
                        <th>Store</th>
                    @endif
                    <th>Created At</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody class="all_data">
                @forelse ($products as $i => $product)
                    <tr>
                        <td>{{ $i + 1 }} |
                            <p class="badge badge-danger text-bold ml-1"> {{ $product->id }}</p> |
                        </td>
                        <td>
                            <img src="{{ $product->image }}" alt="" height="60">
                        </td>
                        <td><a
                                href="{{ route('dashboard.products.show', ['product' => $product->id]) }}">{{ $product->name }}</a>
                        </td>
                        <td>{{ $product->category->name ?? null }}</td>

                        @if (Auth::user()->id == 1)
                            <td>{{ $product->store->id ?? '' }}</td>
                        @endif

                        <td>{{ $product->created_at->diffForHumans() }}</td>
                        <td><a href="{{ route('dashboard.products.edit', [$product->id]) }}"
                                class="btn btn-outline-dark">Edit</a></td>
                        <td>
                            <form action="{{ route('dashboard.products.destroy', $product->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <button class="btn btn-outline-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8">
                            <h2 class="text-center">product is Empty</h2>
                        </td>
                    </tr>
                @endforelse



            </tbody>
            <tbody class="search_data" id="search_list">

            </tbody>
        </table>
        {{ $products->withQueryString()->links() }}
    </div>


</x-dashboard-layout>
