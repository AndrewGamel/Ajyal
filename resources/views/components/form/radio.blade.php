@props([
    'name', 'options', 'checked' => false, 'label' => false,
])


@if($label)
<label for="">{{ $label }}</label>
@endif



@foreach ($options as  $value => $text)
<div class="form-check">
    <input type="radio" name="{{ $name }}" value="{{ $value }}"
    @checked(old($name,$checked) == $value)
    {{ $attributes->class([
        'form-check-input',
        'is-invalid' => $errors->has($name)
    ]) }}
     id="" class="form-check-input">
</div>
<label for="" class="form-check-label px-4"> {{ $text }}</label>
@endforeach
<x-form.validation-feedback :name="$name" />