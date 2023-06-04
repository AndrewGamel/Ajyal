@section('title', 'Categories')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Categories</li>
@endsection

@section('nav-item-1', 'active')
@section('nav-item-2', '')
@section('nav-item-3', '')

<x-dashboard-layout>
    <div class="mb-5">
        <a href="{{ route('dashboard.categories.create') }}" class="btn btn-sm btn-outline-primary mr-2">Create</a>
    </div>


    <x-alert type="success" />
    <x-alert type="info" />

    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Slug</th>
                    {{-- <th>Description</th> --}}
                    <th>Parent ID</th>
                    <th>Created At</th>
                    <th>Edit</th>
                    <th>Delete</th>

                </tr>
            </thead>
            <tbody>
                @if (count($categories) == 0)
                        <tr><td colspan="7"> <h2 class="text-center">Category is Empty</h2></td>  </tr>
                @endif

                @foreach ($categories as $i => $category)




                    <tr>
                        <td>{{ $i+1  }}|{{ $category->id }}</td>
                        <td>
                            <img src="{{ asset('storage/' . $category->image) }}" alt="" height="60">
                        </td>
                        <td><a
                                href="{{ route('dashboard.categories.show', ['category' => $category->id]) }}">{{ $category->name }}</a>
                        </td>
                        <td>{{ $category->slug }}</td>
                        <td>{{ $category->parent_id ?? 'Null' }}</td>
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
    </div>
</x-dashboard-layout>
