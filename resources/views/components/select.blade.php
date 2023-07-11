
@props(['name', 'selected' => '', 'label' => false, 'options','selected_value'])


<select name="{{ $name }}"
    {{ $attributes->class(['form-select form-control border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm' ,
     'is-invalid' => $errors->has($name)]) }}>
    {{-- <option value="">{{ $selected_value }}</option> --}}
    <option value="">Choose {{  $name }}</option>
    @foreach ($options as $value => $text)

        <option value="{{ $value }}" @selected($value == $selected)>{{ $text }}</option>
    @endforeach
</select>


