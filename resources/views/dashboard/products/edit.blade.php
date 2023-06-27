@section('title','Edit Categories')
@section('breadcrumb')
@parent
<li class="breadcrumb-item active">Categories</li>
<li class="breadcrumb-item active">Edit</li>
@endsection

{{-- @section('nav-item-1','active')
@section('nav-item-2','')
@section('nav-item-3','') --}}

<x-dashboard-layout>

<form action="{{ route('dashboard.products.update',$product->id) }}" class="" method="post" enctype="multipart/form-data">
    @csrf
    @method('put')
    @include('dashboard.products._form',[
        'button_label' => 'Update'
    ])
</form>

</x-dashboard-layout>