
@section('title','Categories')
@section('breadcrumb')
@parent
<li class="breadcrumb-item active">Categories</li>
<li class="breadcrumb-item active">Create</li>

@endsection

{{-- @section('nav-item-1','active')
@section('nav-item-2','')
@section('nav-item-3','') --}}

<x-dashboard-layout>

<form action="{{ route('dashboard.products.store') }}" class="" method="post" enctype="multipart/form-data">
    @csrf

    @include('dashboard.products._form')
</form>

</x-dashboard-layout>

