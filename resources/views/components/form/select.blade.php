@props(['name', 'selected' => '', 'label' => false, 'options','selected_value'])
@if ($label)
    <label for="">{{ $label }}</label>
@endif
<select name="{{ $name }}"
    {{ $attributes->class(['form-control', 'form-select', 'is-invalid' => $errors->has($name)]) }}>
    <option value="">{{ $selected_value }}</option>
    @foreach ($options as $value => $text)
        <option value="{{ $value }}" @selected($value == $selected)>{{ $text }}</option>
    @endforeach
</select>
<x-form.validation-feedback :name="$name" />
