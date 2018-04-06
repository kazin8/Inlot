@include(
    'auth.fields.layouts.text',
    [
        'name' => 'email',
        'label' => Form::label('email', $label),
        'input' => Form::text(
            'email',
            null,
            ['class' => 'form-control', 'placeholder' => 'Укажите e-mail', 'value' => old('email')]
        ),
        'errors' => $errors
    ]
)