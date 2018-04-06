@include(
    'auth.fields.layouts.text',
    [
        'name' => 'login',
        'label' => Form::label('login', $label),
        'input' => Form::text(
            'login',
            null,
            ['class' => 'form-control', 'placeholder' => 'Укажите логин', 'value' => old('login')]
        ),
        'errors' => $errors
    ]
)