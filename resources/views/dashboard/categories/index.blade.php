@include('layouts.partials.main-files')



<x-dashboard-layout>


    <div class="mb-5">
    <a href="{{ route('dashboard.categories.create') }}" class="btn btn-sm btn-outline-primary mr-2">Create</a>
    </div>

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
            {{-- @foreach ($categories as $category)
            <tr>
                <td>{{ $category->id }}</td>
                <td><img src="" alt="" height="50"></td>
                <td><a href="{{ route('categories.show', ['category' => $category->id]) }}">{{ $category->name }}</a></td>
                <td>{{ $category->slug }}</td>
                <td>{{ $category->parent_name }}</td>
                <td>{{ $category->created_at }}</td>
                <td><a href="{{ route('categories.edit', [$category->id]) }}" class="btn btn-sm btn-dark">Edit</a></td>
                <td>
                    <form action="{{ route('categories.destroy', $category->id) }}" method="post">
                        @csrf
                        @method('delete')
                        <button class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach --}}
        </tbody>
    </table>
</div>
</x-dashboard-layout>

