@include(
    'auth.fields.layouts.text',
    [
        'name' => 'phone',
        'label' => Form::label('phone', $label),
        'input' => Form::text(
            'phone',
            null,
            ['class' => 'form-control', 'data-item' => 'phone', 'placeholder' => '+7 (___) ___-__-__', 'value' => old('phone')]
        ),
        'errors' => $errors
    ]
)