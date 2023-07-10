@props([
    'name', 'options', 'checked' => false, 'label' => false,
])


@if($label)
<label for="">{{ $label }}</label>
@endif



@foreach ($options as  $value => $text)
<span class="form-check d-inline">
    <input name="{{ $name }}" value="{{ $value }}"
    @checked(old($name,$checked) == $value)
    {{ $attributes->class([
        'class' => 'd-inline border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm',
        'is-invalid' => $errors->has($name)
    ]) }} >
</span>
<label for="" class=" font-medium text-sm text-gray-700 dark:text-gray-300 px-4"> {{ $text }}</label>
@endforeach
