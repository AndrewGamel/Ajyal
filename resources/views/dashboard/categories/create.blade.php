



<form action="{{ route('dashboard.categories.store') }}" method="post" enctype="multipart/form-data">
    @csrf

    @include('dashboard.categories._form')
</form>