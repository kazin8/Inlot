@include(
    'auth.fields.layouts.text',
    [
        'name' => 'name',
        'label' => Form::label('name', $label),
        'input' => Form::text(
            'name',
            null,
            ['class' => 'form-control', 'placeholder' => 'Укажите имя и фамилию', 'value' => old('name')]
        ),
        'errors' => $errors
    ]
)