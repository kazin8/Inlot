@include(
    'auth.fields.layouts.password',
    [
        'name' => 'password_confirmation',
        'label' => Form::label('password_confirmation', $label),
        'input' => Form::password(
            'password_confirmation',
            ['class' => 'form-control', 'placeholder' => 'Укажите пароль']
        ),
        'errors' => $errors
    ]
)