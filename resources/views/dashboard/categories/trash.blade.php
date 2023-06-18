@section('title', 'Categories')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item"><a href="{{ route('dashboard.categories.index') }}" class="mr-2"> Categories</a></li>
    <li class="breadcrumb-item "> Trash</li>
@endsection


<x-dashboard-layout>



    <x-alert type="success" />
    <x-alert type="danger" />

    <form action="{{ URL::current() }}" method="get" class="d-flex justify-content-between mb-4">
        <x-form.label />
        <x-form.input  onfocus="this.value=''" class="p-1 mx-2" placeholder="Enter Name" type="text" name='name' role="input" :value="request('name')" />
        <x-form.select name='status' class="mx-2" selected_value='All' :options="['active' => 'Active', 'archived' => 'Archived']" :selected="request('status')" />
        {{-- <  :selected="$category->parent_id" /> --}}
        <input type="submit" class=" btn btn-outline-light ml-2" value="Filter">
    </form>

 <div class="mb-5">
        <a href="{{ route('dashboard.categories.index') }}" class="btn btn-sm btn-outline-primary mr-2">Back</a>
</div>


    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th colspan="1">No | ID | Parent name </th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Status</th>
                    <th>Deleted At</th>
                    <th>Restore</th>
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



        </table>
        {{ $categories->withQueryString()->links() }}
    </div>


</x-dashboard-layout>
