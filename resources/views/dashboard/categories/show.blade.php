@section('title', 'Categories')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">
        Categories


    </li>
@endsection


<x-dashboard-layout>
    <p class="border border-dark text-bold ml-1 p-2">{{ $category->name }}</p>

    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th colspan="1">No</th>
                    <th>Prod-Name</th>
                    <th>Image</th>
                    <th>Store Name #</th>
                    <th>Status</th>
                    <th>price</th>
                    <th>Created At</th>


                </tr>
            </thead>
            <tbody class="all_data">
                @php
                    $products = $category ->products()->with('store')->latest()->orderBy('products.name')->paginate();
                @endphp

                @forelse ($products as $i => $product)
                    <tr>
                        <td>
                            <p class="badge badge-danger text-bold ml-1">{{ $i + 1 }}</p>
                        </td>

                        <td>
                            <a href="{{ route('dashboard.products.show', ['product' => $product->id]) }}">{{ $product->name }}</a>
                        </td>

                        <td>
                            <img src="{{ $product->image ?? asset('storage/' . $category->image) }}" alt=""
                                height="60">
                        </td>

                        <td>{{ $product->store->name }}</td>
                        <td>

                            @if ($product->status == 'active')
                                <p class="badge badge-success text-bold ml-1"> Active </p>
                            @elseif ($product->status ==  'archived')
                                <p class="badge badge-info text-bold ml-1"> Archived </p>
                            @else
                                <p class="badge badge-danger text-bold ml-1"> Draft </p>
                            @endif</p>
                        </td>
                        <td>
                            <p class="badge badge-warning text-bold ml-1"> {{ $product->price }} </p>
                        </td>
                        <td>{{ $category->created_at->diffForHumans() }}</td>

                    </tr>

                @empty
                    <tr>
                        <td colspan="7">
                            <h2 class="text-center">Product is Empty</h2>
                        </td>
                    </tr>
                @endforelse



            </tbody>
            <tbody class="search_data" id="search_list">

            </tbody>
        </table>
        {{ $products->links() }}
    </div>


</x-dashboard-layout>
