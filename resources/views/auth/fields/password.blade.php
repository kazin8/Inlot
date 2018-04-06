@include(
    'auth.fields.layouts.password',
    [
        'name' => 'password',
        'label' => Form::label('password', $label),
        'input' => Form::password(
            'password',
            ['class' => 'form-control', 'placeholder' => 'Укажите пароль']
        ),
        'errors' => $errors
    ]
)