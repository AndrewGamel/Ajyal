@section('title', 'Categories')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">
        Categories</li>
@endsection

{{-- @section('nav-item-1', 'active')
@section('nav-item-2', '')
@section('nav-item-3', '') --}}

<x-dashboard-layout>

    <input type="search" name="search" id="search" placeholder="Enter ID 'Live Search'" class="form-control col-2 mb-3 mx-1"  >

    <form action="{{ URL::current() }}" method="get" class="d-flex justify-content-between mb-4">
        <x-form.label />
        <x-form.input  onfocus="this.value=''" class="p-1 " placeholder="Enter Name" type="text" name='name' role="input" :value="request('name')" />
        <x-form.select name='status' class="mx-2" selected_value='All' :options="['active' => 'Active', 'archived' => 'Archived']" :selected="request('status')" />
        {{-- <  :selected="$category->parent_id" /> --}}
        <input type="submit" class=" btn btn-outline-light ml-2" value="Filter">
    </form>

 <div class="mb-5">
        <a href="{{ route('dashboard.categories.create') }}" class="btn btn-sm btn-outline-primary mr-2"><i class="fas fa-address-book mr-2"></i>Create</a>
        <a href="{{ route('dashboard.categories.trash') }}" class="btn btn-sm btn-outline-warning mr-2"><i class="fas fa-trash mr-2"></i>trash</a>
    </div>

    <x-alert type="success" />
    <x-alert type="info" />


    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th colspan="1">No | ID | Parent ID </th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Status</th>
                    <th>Created At</th>
                    <th>Edit</th>
                    <th>Delete</th>

                </tr>
            </thead>
            <tbody class="all_data">
                @if (count($categories) == 0)
                    <tr>
                        <td colspan="7">
                            <h2 class="text-center">Category is Empty</h2>
                        </td>
                    </tr>
                @endif

                @foreach ($categories as $i => $category)
                    <tr>
                        <td>{{ $i + 1 }} |
                            <p class="badge badge-danger text-bold ml-1"> {{ $category->id }}</p> |
                            <p class="badge badge-info text-bold ml-1">{{ $category->parent_name ?? 'Null' }}</p>
                        </td>


                        <td>
                            <img src="{{ asset('storage/' . $category->image) }}" alt="" height="60">
                        </td>
                        <td><a
                                href="{{ route('dashboard.categories.show', ['category' => $category->id]) }}">{{ $category->name }}</a>
                        </td>
                        <td>{{ $category->slug }}</td>
                        <td>
                            @if ($category->status == 'active')
                                <p class="badge badge-success text-bold ml-1"> Active </p>
                            @else
                                <p class="badge badge-danger text-bold ml-1"> Archived </p>
                            @endif
                        </td>
                        <td>{{ $category->created_at }}</td>
                        <td><a href="{{ route('dashboard.categories.edit', [$category->id]) }}"
                                class="btn btn-outline-dark">Edit</a></td>
                        <td>
                            <form action="{{ route('dashboard.categories.destroy', $category->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <button class="btn btn-outline-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach



            </tbody>
            <tbody class="search_data" id="search_list">

            </tbody>
        </table>
        {{ $categories->withQueryString()->links() }}
    </div>


</x-dashboard-layout>
