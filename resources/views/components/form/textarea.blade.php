@props([
    'name', 'value' => '', 'label' => false
])

<textarea name="{{ $name }}"
{{ $attributes->class([
    'form-control',
    'is-invalid' => $errors->has($name)
]) }} cols="30" rows="10">{{ old($name, $value) }}</textarea>




<x-form.validation-feedback :name="$name" />