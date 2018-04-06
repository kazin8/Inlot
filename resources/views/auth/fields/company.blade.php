@include(
    'auth.fields.layouts.text',
    [
        'name' => 'company',
        'label' => Form::label('company', $label),
        'input' => Form::text(
            'company',
            null,
            ['class' => 'form-control', 'placeholder' => 'Укажите название компании', 'value' => old('company')]
        ),
        'errors' => $errors
    ]
)