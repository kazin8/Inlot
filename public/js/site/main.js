$('document').ready(function() {

    ymaps.ready(initMap);

    var myMap, myPlacemark;

    var token = $('meta[name="_token"]').attr('content');

    var select = $('[data-item="select"]');
    var selectNoSearch = $('[data-item="select-no-search"]');
    var selectTags = $('[data-item="select-tags"]');

    var Registration = {
        ValidationOptions: {
            framework: 'bootstrap',

            err: {
                container: function container($field, validator) {
                    return $field.next('.validation-right-inner');
                }
            },

            locale: 'ru_RU',

            icon: {
                valid: 'fa fa-check-circle-o',
                invalid: 'fa fa-times-circle-o',
                validating: 'fa fa-refresh'
            },

            fields: {
                company: {
                    trigger: 'keyup keydown keypress',

                    validators: {
                        notEmpty: {
                            message: 'Это обязательное поле.'
                        },
                        remote: {
                            valid: true,
                            headers: {
                                'X-CSRF-TOKEN': token
                            },
                            async: true,
                            type: 'POST',
                            url: '/checkCompany',
                            delay: 2000,
                            data: function(validator, $field, value) {
                                return {
                                    company: validator.getFieldElements('company').val(),
                                };
                            },
                            message: 'Компания с таким названием уже существует.'
                        }
                    }
                },
                name: {
                    trigger: 'keyup keydown keypress',

                    validators: {
                        notEmpty: {
                            message: 'Это обязательное поле.'
                        }
                    }
                },
                login: {
                    trigger: 'keyup keydown keypress',

                    validators: {
                        notEmpty: {
                            message: 'Это обязательное поле.'
                        },
                        remote: {
                            valid: true,
                            headers: {
                                'X-CSRF-TOKEN': token
                            },
                            async: true,
                            type: 'POST',
                            delay: 2000,
                            url: '/checkLogin',
                            data: function(validator, $field, value) {
                                return {
                                    login: validator.getFieldElements('login').val(),
                                };
                            },
                            message: 'Пользователь с таким логином уже существует.'
                        }
                    }
                },
                email: {
                    trigger: 'keyup keydown keypress',

                    validators: {
                        emailAddress: {
                            message: 'Неверный формат.'
                        },
                        notEmpty: {
                            message: 'Это обязательное поле.'
                        },
                        remote: {
                            headers: {
                                'X-CSRF-TOKEN': token
                            },
                            type: 'POST',
                            async: true,
                            delay: 2000,
                            url: '/checkEmailIsUnique',
                            data: function(validator, $field, value) {
                                return {
                                    email: validator.getFieldElements('email').val(),
                                };
                            },
                            message: 'Пользователь с таким e-mail уже существует.'
                        }
                    }
                },
                phone: {
                    trigger: 'keyup keydown keypress',

                    validators: {
                        notEmpty: {
                            message: 'Это обязательное поле'
                        }
                    }
                },
                password: {
                    trigger: 'keyup keydown keypress',

                    validators: {
                        stringLength: {
                            min: 6,
                            message: 'Пароль должен состоять минимум из 6-ти символов. Выбирайте надежный пароль!'
                        },
                        notEmpty: {
                            message: 'Это обязательное поле.'
                        }
                    }
                },
                password_confirmation: {
                    trigger: 'keyup keydown keypress',

                    validators: {
                        identical: {
                            field: 'userPassword',
                            message: 'Пароли не совпадают.'
                        }
                    }
                }
            }
        },

        initialize: function initialize() {
            this.Validation('.Registration-form');
        },
        Validation: function Validation(form) {

            $(form).on('init.field.fv', function (e, data) {
                var $parent = data.element.parents('.form-group'),
                $icon = data.element.data('fv.icon'),
                $label = $parent.find('.validation-right-inner .error-icon');

                $icon.appendTo($label);
            }).formValidation(this.ValidationOptions);
        }
    };

    var Login = {
        ValidationOptions: {
            framework: 'bootstrap',

            err: {
                container: function container($field, validator) {
                    return $field.next('.validation-right-inner');
                }
            },

            locale: 'ru_RU',

            icon: {
                valid: 'fa fa-check-circle-o',
                invalid: 'fa fa-times-circle-o',
                validating: 'fa fa-refresh'
            },

            fields: {
                login: {
                    trigger: 'keyup keydown keypress',

                    validators: {
                        notEmpty: {
                            message: 'Это обязательное поле.'
                        }
                    }
                },
                password: {
                    trigger: 'keyup keydown keypress',

                    validators: {
                        notEmpty: {
                            message: 'Это обязательное поле.'
                        }
                    }
                }
            }
        },

        initialize: function initialize() {
            this.Validation('.Login-form');
        },
        Validation: function Validation(form) {

            $(form).on('init.field.fv', function (e, data) {
                var $parent = data.element.parents('.form-group'),
                $icon = data.element.data('fv.icon'),
                $label = $parent.find('.validation-right-inner .error-icon');

                $icon.appendTo($label);
            }).formValidation(this.ValidationOptions);

        }
    };

    var ResetPassword = {
        ValidationOptions: {
            framework: 'bootstrap',

            err: {
                container: function container($field, validator) {
                    return $field.next('.validation-right-inner');
                }
            },

            locale: 'ru_RU',

            icon: {
                valid: 'fa fa-check-circle-o',
                invalid: 'fa fa-times-circle-o',
                validating: 'fa fa-refresh'
            },

            fields: {
                email: {
                    trigger: 'keyup keydown keypress',

                    validators: {
                        notEmpty: {
                            message: 'Это обязательное поле.'
                        },
                        remote: {
                            headers: {
                                'X-CSRF-TOKEN': token
                            },
                            type: 'POST',
                            url: '/checkEmailIsSet',
                            async: true,
                            data: function(validator, $field, value) {
                                return {
                                    email: validator.getFieldElements('email').val(),
                                };
                            },
                            message: 'Пользователя с таким e-mail не существует.'
                        }
                    }
                },
                password: {
                    trigger: 'keyup keydown keypress',

                    validators: {
                        stringLength: {
                            min: 6,
                            message: 'Пароль должен состоять минимум из 6-ти символов. Выбирайте надежный пароль!'
                        },
                        notEmpty: {
                            message: 'Это обязательное поле.'
                        }
                    }
                },
                password_confirmation: {
                    trigger: 'keyup keydown keypress',

                    validators: {
                        identical: {
                            field: 'password',
                            message: 'Пароли не совпадают.'
                        }
                    }
                }
            }
        },

        initialize: function initialize() {
            this.Validation('.Password-reset-form');
        },
        Validation: function Validation(form) {

            $(form).on('init.field.fv', function (e, data) {
                var $parent = data.element.parents('.form-group'),
                $icon = data.element.data('fv.icon'),
                $label = $parent.find('.validation-right-inner .error-icon');

                $icon.appendTo($label);
            }).formValidation(this.ValidationOptions);

        }
    };

    var Profile = {
        ValidationOptions: {
            framework: 'bootstrap',

            locale: 'ru_RU',

            fields: {
                company: {
                    trigger: 'keyup keydown keypress',
                    validators: {
                        notEmpty: {
                            message: 'Это поле не может быть пустым!'
                        },
                        blank: {}
                    }
                },
                name: {
                    trigger: 'keyup keydown keypress',
                    validators: {
                        notEmpty: {
                            message: 'Это обязательное поле'
                        },
                        blank: {}
                    }
                },
                phone: {
                    trigger: 'keyup keydown keypress',
                    validators: {
                        notEmpty: {
                            message: 'Эт обязательное поле'
                        },
                        blank: {}
                    }
                },
                region_id: {
                    trigger: 'keyup keydown keypress',
                    validators: {
                        blank: {}
                    }
                },
                city_id: {
                    trigger: 'keyup keydown keypress',
                    validators: {
                        blank: {}
                    }
                },
                postcode: {
                    trigger: 'keyup keydown keypress',
                    validators: {
                        blank: {}
                    }
                },
                inn: {
                    trigger: 'keyup keydown keypress',
                    validators: {
                        notEmpty: {
                            message: 'Это обязательное поле.'
                        },
                        blank: {}
                    }
                },
                image: {
                    validators: {
                        file: {
                            extensions: 'jpeg,jpg,png,bmp,gif,svg',
                            message: 'The selected file is not valid'
                        }
                    }
                }
            }
        },
        initialize: function initialize() {
            this.Validation('.Profile');
        },
        Validation: function Validation(form) {
            $(form).formValidation(this.ValidationOptions).on('success.form.fv', function (e) {
                e.preventDefault();
                var $form = $(e.target),
                fv = $form.data('formValidation'),
                fd = new FormData($form[0]),
                url = $(form).attr('action');

                $.ajax({
                    method: "POST",
                    headers: {'X-CSRF-TOKEN' : token},
                    url: url,
                    data: fd,
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    success: function() {
                        location.reload();
                    },
                    error: function(response) {
                        if (response.status == 422) {
                            var fields = $.parseJSON(response.responseText);
                            $.each(fields, function(index, value) {
                                fv
                                .updateStatus(index, 'INVALID', 'blank')
                                .updateMessage(index, 'blank', value);
                            });
                        } else if (response.status == 500) {
                            var resp = $.parseJSON(response.responseText);
                            alert(resp.message);
                        }
                    }
                });
            });
        }
    };

    var ChangePassword = {
        ValidationOptions: {
            framework: 'bootstrap',

            locale: 'ru_RU',

            fields: {
                current_password: {
                    trigger: 'keyup keydown keypress',
                    validators: {
                        stringLength: {
                            min: 6,
                            message: 'Пароль должен состоять минимум из 6-ти символов. Выбирайте надежный пароль!'
                        },
                        notEmpty: {
                            message: 'Это обязательное поле.'
                        },
                        blank: {}
                    }
                },
                password: {
                    trigger: 'keyup keydown keypress',
                    validators: {
                        stringLength: {
                            min: 6,
                            message: 'Пароль должен состоять минимум из 6-ти символов. Выбирайте надежный пароль!'
                        },
                        notEmpty: {
                            message: 'Это обязательное поле.'
                        },
                        blank: {}
                    }
                },
                password_confirmation: {
                    trigger: 'keyup keydown keypress',
                    validators: {
                        stringLength: {
                            min: 6,
                            message: 'Пароль должен состоять минимум из 6-ти символов. Выбирайте надежный пароль!'
                        },
                        notEmpty: {
                            message: 'Это обязательное поле.'
                        },
                        blank: {}
                    }
                },
            }
        },
        initialize: function initialize() {
            this.Validation('.ChangePassword');
        },
        Validation: function Validation(form) {

            $(form).formValidation(this.ValidationOptions).on('success.form.fv', function (e) {
                e.preventDefault();
                var $form = $(e.target),
                fv = $form.data('formValidation'),
                url = $(form).attr('action');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': token
                    }
                });
                $.ajax({
                    type: "PATCH",
                    url: url,
                    data: $form.serialize(),
                    dataType: 'json',
                    success: function() {
                        location.reload();
                    },
                    error: function(response) {
                        if (response.status == 422) {
                            var fields = $.parseJSON(response.responseText);
                            $.each(fields, function(index, value) {
                                fv
                                .updateStatus(index, 'INVALID', 'blank')
                                .updateMessage(index, 'blank', value);
                            });
                        } else if (response.status == 500) {
                            var resp = $.parseJSON(response.responseText);
                            alert(resp.message);
                        }
                    }
                });
            });

        }
    };

    var ChangeEmail = {
        ValidationOptions: {
            framework: 'bootstrap',

            locale: 'ru_RU',

            fields: {
                email: {
                    trigger: 'keyup keydown keypress',

                    validators: {
                        emailAddress: {
                            message: 'Неверный формат.'
                        },
                        notEmpty: {
                            message: 'Это обязательное поле.'
                        },
                        blank: {}
                    }
                }
            }
        },
        initialize: function initialize() {
            this.Validation('.ChangeEmail');
        },
        Validation: function Validation(form) {

            $(form).formValidation(this.ValidationOptions).on('success.form.fv', function (e) {
                e.preventDefault();
                var $form = $(e.target),
                fv = $form.data('formValidation'),
                url = $(form).attr('action');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': token
                    }
                });
                $.ajax({
                    type: "PATCH",
                    url: url,
                    data: $form.serialize(),
                    dataType: 'json',
                    success: function() {
                        location.reload();
                    },
                    error: function(response) {
                        if (response.status == 422) {
                            var fields = $.parseJSON(response.responseText);
                            $.each(fields, function(index, value) {
                                fv
                                .updateStatus(index, 'INVALID', 'blank')
                                .updateMessage(index, 'blank', value);
                            });
                        } else if (response.status == 500) {
                            var resp = $.parseJSON(response.responseText);
                            alert(resp.message);
                        }
                    }
                });
            });

        }
    };

    var ChangeLogin = {
        ValidationOptions: {
            framework: 'bootstrap',

            locale: 'ru_RU',

            fields: {
                login: {
                    trigger: 'keyup keydown keypress',

                    validators: {
                        notEmpty: {
                            message: 'Это обязательное поле.'
                        },
                        blank: {}
                    }
                }
            }
        },
        initialize: function initialize() {
            this.Validation('.ChangeLogin');
        },
        Validation: function Validation(form) {

            $(form).formValidation(this.ValidationOptions).on('success.form.fv', function (e) {
                e.preventDefault();
                var $form = $(e.target),
                fv = $form.data('formValidation'),
                url = $(form).attr('action');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': token
                    }
                });
                $.ajax({
                    type: "PATCH",
                    url: url,
                    data: $form.serialize(),
                    dataType: 'json',
                    success: function() {
                        location.reload();
                    },
                    error: function(response) {
                        if (response.status == 422) {
                            var fields = $.parseJSON(response.responseText);
                            $.each(fields, function(index, value) {
                                fv
                                .updateStatus(index, 'INVALID', 'blank')
                                .updateMessage(index, 'blank', value);
                            });
                        } else if (response.status == 500) {
                            var resp = $.parseJSON(response.responseText);
                            alert(resp.message);
                        }
                    }
                });
            });

        }
    };

    var SecondStepGoods = {
        ValidationOptions: {
            framework: 'bootstrap',

            locale: 'ru_RU',

            validateVin: function(value){
                var vin = new RegExp("^[A-HJ-NPR-Z\\d]{8}[\\dX][A-HJ-NPR-Z\\d]{2}\\d{6}$");
                return vin.test(value);
            },

            fields: {

                region_id: {
                    trigger: 'keyup keydown keypress',

                    validators: {
                        notEmpty: {
                            message: 'Это поле не может быть пустым!'
                        },
                        blank: {}
                    }
                },
                city_id: {
                    trigger: 'keyup keydown keypress',

                    validators: {
                        notEmpty: {
                            message: 'Это поле не может быть пустым!'
                        },
                        blank: {}
                    }
                },
                diameter: {
                    trigger: 'keyup keydown keypress',

                    validators: {
                        notEmpty: {
                            message: 'Это поле не может быть пустым!'
                        },
                        blank: {}
                    }
                },
                seasonality_id: {
                    trigger: 'keyup keydown keypress',

                    validators: {
                        notEmpty: {
                            message: 'Это поле не может быть пустым!'
                        },
                        blank: {}
                    }
                },
                profile_width: {
                    trigger: 'keyup keydown keypress',

                    validators: {
                        notEmpty: {
                            message: 'Это поле не может быть пустым!'
                        },
                        blank: {}
                    }
                },
                profile_height: {
                    trigger: 'keyup keydown keypress',

                    validators: {
                        notEmpty: {
                            message: 'Это поле не может быть пустым!'
                        },
                        blank: {}
                    }
                },
                rim_type_id: {
                    trigger: 'keyup keydown keypress',

                    validators: {
                        notEmpty: {
                            message: 'Это поле не может быть пустым!'
                        },
                        blank: {}
                    }
                },
                mark_id: {
                    trigger: 'keyup keydown keypress',

                    validators: {
                        notEmpty: {
                            message: 'Это поле не может быть пустым!'
                        },
                        blank: {}
                    }
                },
                'wheels_marks[]': {
                    trigger: 'keyup keydown keypress',

                    validators: {
                        notEmpty: {
                            message: 'Это поле не может быть пустым!'
                        },
                        blank: {}
                    }
                },
                model_id: {
                    trigger: 'keyup keydown keypress',

                    validators: {
                        notEmpty: {
                            message: 'Это поле не может быть пустым!'
                        },
                        blank: {}
                    }
                },
                'wheels_models[]': {
                    trigger: 'keyup keydown keypress',

                    validators: {
                        notEmpty: {
                            message: 'Это поле не может быть пустым!'
                        },
                        blank: {}
                    }
                },
                date_release_id: {
                    trigger: 'keyup keydown keypress',

                    validators: {
                        notEmpty: {
                            message: 'Это поле не может быть пустым!'
                        },
                        blank: {}
                    }
                },
                auto_part_kind_id: {
                    trigger: 'keyup keydown keypress',

                    validators: {
                        notEmpty: {
                            message: 'Это поле не может быть пустым!'
                        },
                        blank: {}
                    }
                },
                state_id: {
                    trigger: 'keyup keydown keypress',

                    validators: {
                        notEmpty: {
                            message: 'Это поле не может быть пустым!'
                        },
                        blank: {}
                    }
                },
                run_visible: {
                    trigger: 'keyup keydown keypress',
                    validators: {
                        callback: {
                            message: 'Вы превышаете лимит в 10 000 000',
                            callback: function(value, validator, $field) {
                                var val = +value.replace(/ /g, '');
                                var lim = 10000000;
                                if(val > lim) {
                                    return false;
                                }
                                return true;
                            }
                        },
                        notEmpty: {
                            message: 'Это поле не может быть пустым!'
                        },
                        blank: {}
                    }
                },
                gear_id: {
                    trigger: 'keyup keydown keypress',

                    validators: {
                        notEmpty: {
                            message: 'Это поле не может быть пустым!'
                        },
                        blank: {}
                    }
                },
                color_id: {
                    trigger: 'keyup keydown keypress',

                    validators: {
                        notEmpty: {
                            message: 'Это поле не может быть пустым!'
                        },
                        blank: {}
                    }
                },
                rudder_id: {
                    trigger: 'keyup keydown keypress',

                    validators: {
                        notEmpty: {
                            message: 'Это поле не может быть пустым!'
                        },
                        blank: {}
                    }
                },
                engine_id: {
                    trigger: 'keyup keydown keypress',

                    validators: {
                        notEmpty: {
                            message: 'Это поле не может быть пустым!'
                        },
                        blank: {}
                    }
                },
                kpp_id: {
                    trigger: 'keyup keydown keypress',

                    validators: {
                        notEmpty: {
                            message: 'Это поле не может быть пустым!'
                        },
                        blank: {}
                    }
                },
                name: {
                    trigger: 'keyup keydown keypress',

                    validators: {
                        notEmpty: {
                            message: 'Это поле не может быть пустым!'
                        },
                        blank: {}
                    }
                },
                width: {
                    trigger: 'keyup keydown keypress',

                    validators: {
                        notEmpty: {
                            message: 'Это поле не может быть пустым!'
                        },
                        blank: {}
                    }
                },
                vin: {
                    trigger: 'keyup keydown keypress',

                    validators: {
                        callback: {
                            callback: function(value, validator, $field) {
                                if(value.length === 0) return {valid:true};
                                var vin = validator.options.validateVin(value);
                                if(!vin) {
                                    return false;
                                }
                                return true;
                            },
                            message: 'Ваш VIN не соответствует!'
                        },
                        blank: {}
                    }
                }

            }
        },
        initialize: function initialize() {
            this.Validation('.SecondStepGoods');
        },
        Validation: function Validation(form) {
            $(form).formValidation(this.ValidationOptions).on('success.form.fv', function (e) {
                e.preventDefault();
                var $form = $(e.target),
                fv = $form.data('formValidation'),
                fd = new FormData($form[0]),
                url = $(form).attr('action');

                $.ajax({
                    method: "POST",
                    headers: {'X-CSRF-TOKEN' : token},
                    url: url,
                    data: fd,
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        location.href = data.url;
                    },
                    error: function(response) {
                        if (response.status == 422) {
                            var fields = $.parseJSON(response.responseText);
                            $.each(fields, function(index, value) {
                                fv
                                .updateStatus(index, 'INVALID', 'blank')
                                .updateMessage(index, 'blank', value);
                            });
                        } else if (response.status == 500) {
                            var resp = $.parseJSON(response.responseText);
                            alert(resp.message);
                        }
                    }
                });
            });
            $(form).find(select).change(function (e) {
                $(form).formValidation('revalidateField', e.target.name);
            }).end();
            $(form).find(selectNoSearch).on('change',function(e) {
                $(form).formValidation('revalidateField', e.target.name);
                $('.select2-search.select2-search--dropdown').remove();
            });
            $(form).find('[data-input="file"]').on('fileloaded', function (event, file, previewId, index, reader) {
                $(form).formValidation('revalidateField', event.target.name);
            }).end().find('[data-input="file"]').on('change', function (e) {
                $(form).formValidation('revalidateField', e.target.name);
            }).end().find('[data-input="file"]').on('fileclear', function (event) {
                $(form).formValidation('revalidateField', event.target.name);
            }).end();
        }
    };

    var ThirdStepGoods = {
        ValidationOptions: {
            framework: 'bootstrap',

            locale: 'ru_RU',

            fields: {
                price_visible: {
                    trigger: 'keyup keydown keypress',

                    validators: {
                        notEmpty: {
                            message: 'Это поле не может быть пустым!'
                        },
                        blank: {}
                    }
                }
            }
        },
        initialize: function initialize() {
            this.Validation('.ThirdStepGoods');
        },
        Validation: function Validation(form) {
            $(form).formValidation(this.ValidationOptions).on('success.form.fv', function (e) {
                e.preventDefault();
                var $form = $(e.target),
                fv = $form.data('formValidation'),
                fd = new FormData($form[0]),
                url = $(form).attr('action');

                $.ajax({
                    method: "POST",
                    headers: {'X-CSRF-TOKEN' : token},
                    url: url,
                    data: fd,
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        location.href = data.url;
                    },
                    error: function(response) {
                        if (response.status == 422) {
                            var fields = $.parseJSON(response.responseText);
                            $.each(fields, function(index, value) {
                                fv
                                .updateStatus(index, 'INVALID', 'blank')
                                .updateMessage(index, 'blank', value);
                            });
                        } else if (response.status == 500) {
                            var resp = $.parseJSON(response.responseText);
                            alert(resp.message);
                        }
                    }
                });
            });
        }
    };
    /* 
        ==================== Card item amount Validation ==================== 
        */
        var cartBtnBuy = $('[data-item="cartSubmit"]');
        cartBtnBuy.on('click', function(e){
            $('.CardBuy').submit();
        });

        var CardBuy = {
            ValidationOptions: {
                framework: 'bootstrap',
                locale: 'ru_RU',

                err: {
                    container: '.err'
                },

                fields: {
                    cardAmount: {
                        trigger: 'keyup',
                        validators: {
                            callback: {
                                message: '',
                                callback: function(value, validator, $field) {
                                    var val = +value.replace(/ /g, '');
                                    var lim = validator.$form.data('item-amount');
                                    if(val > lim || val === 0) {
                                        return {
                                            valid: false,
                                            message: `не более ${lim}`
                                        }
                                    } 
                                    return true;
                                }
                            },
                            blank: {}
                        }
                    }
                }
            },

            initialize : function () {
                this.Validation('.CardBuy');
            },
            Validation:function(form){
                $(form).formValidation(this.ValidationOptions).on('success.form.fv', function(e) {
                    e.preventDefault();
                    var $form = $(e.target),
                    fv = $form.data('formValidation');
                // For demonstrating purpose, the url is generated randomly
                // to get different response each time
                // In fact, it should be /path/to/your/back-end/
                var url = ['response.json'];
                $.ajax({
                    url: url,
                    data: $form.serialize(),
                    dataType: 'json'
                }).success(function(response) {
                // If there is error returned from server
                if (response.result === 'error') {
                    for (var field in response.fields) {
                        fv
                                // Show the custom message
                                .updateMessage(field, 'blank', response.fields[field])
                                // Set the field as invalid
                                .updateStatus(field, 'INVALID', 'blank');
                            }
                        } else {
                        // Do whatever you want here
                        // such as showing a modal ...
                    }
                });
            });
            }
        };
    /* 
        ==================== Card item amount Validation END ==================== 
        */
        Registration.initialize();

        Login.initialize();

        ResetPassword.initialize();

        Profile.initialize();

        ChangePassword.initialize();

        ChangeEmail.initialize();

        ChangeLogin.initialize();

        SecondStepGoods.initialize();

        ThirdStepGoods.initialize();
        
        CardBuy.initialize();

        $('.select-regions').change(function() {
            var regionId = $(this).val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': token
                }
            });

            $.ajax({
                type: 'POST',
                url: '/choose-region',
                dataType: 'text',
                data: {'regionId': regionId},
                success: function(data) {
                    data = $.parseJSON(data);
                    var cities = [];
                    $.each(data, function(index, value) {
                        cities.push({'id': index, text: value});
                    });
                    $('.select-cities').empty().select2({
                        theme: "bootstrap",
                        data: cities
                    });
                }
            });
        });

        $('.select-marks').change(function() {
            var markId = $(this).val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': token
                }
            });

            $.ajax({
                type: 'POST',
                url: '/choose-mark',
                dataType: 'text',
                data: {'markId': markId},
                success: function(data) {
                    data = $.parseJSON(data);
                    var models = [];
                    $.each(data, function(index, value) {
                        models.push({'id': index, text: value});
                    });
                    $('.select-models').empty().select2({
                        theme: "bootstrap",
                        data: models
                    });
                }
            });
        });

        $('.form-filter').submit(function(e) {
            e.preventDefault();
            renderCatList();
        });

        $('.sort-list').change(function() {
            renderCatList();
        });

        $('.view-list').click(function(e) {
            e.preventDefault();
            $('.view-list').removeClass('active');
            $(this).addClass('active');
            renderCatList();
        });

        $('.become-a-dealer').click(function(e) {
            e.preventDefault();
            var url = $(this).attr('href');

            $.ajax({
                headers: {'X-CSRF-TOKEN': token},
                type: 'POST',
                url: url,
                dataType: 'text',
                success: function() {
                    $('#become-a-dealer-modal').modal('show');
                }
            })
        })

    });

var token = $('meta[name="_token"]').attr('content');

$(document).on('click', '.disactivate-goods', function(e) {
    e.preventDefault();

    var url = $(this).attr('data-url');
    var listCode = $(this).attr('data-code');
    var page = parseInt($('.page-pagination').length ? $('.page-pagination').val() : 0);

    $.ajax({
        headers: {'X-CSRF-TOKEN' : token},
        type: 'PATCH',
        url: url,
        dataType: 'json',
        data: {'listCode': listCode, 'page': page},
        success: function(response) {
            $('#result-list').html(response.view);
            $('#pagination-block').html(response.pagination);
        },
        error: function(response) {
            var resp = $.parseJSON(response.responseText);
            $('#result-list').html(resp.message);
        }
    });
});

$(document).on('click', '.activate-goods', function(e) {
    e.preventDefault();

    var url = $(this).attr('data-url');
    var listCode = $(this).attr('data-code');
    var page = parseInt($('.page-pagination').length ? $('.page-pagination').val() : 0);

    $.ajax({
        headers: {'X-CSRF-TOKEN' : token},
        type: 'PATCH',
        url: url,
        dataType: 'json',
        data: {'listCode': listCode, 'page': page},
        success: function(response) {
            $('#result-list').html(response.view);
            $('#pagination-block').html(response.pagination);
        },
        error: function(response) {
            var resp = $.parseJSON(response.responseText);
            $('#result-list').html(resp.message);
        }
    });
});

$(document).on('click', '.delete-goods', function(e) {
    e.preventDefault();

    var url = $(this).attr('data-url');
    var listCode = $(this).attr('data-code');
    var page = parseInt($('.page-pagination').length ? $('.page-pagination').val() : 0);

    $.ajax({
        headers: {'X-CSRF-TOKEN' : token},
        type: 'DELETE',
        url: url,
        dataType: 'json',
        data: {'listCode': listCode, 'page': page},
        success: function(response) {
            $('#result-list').html(response.view);
            $('#pagination-block').html(response.pagination);
        },
        error: function(response) {
            var resp = $.parseJSON(response.responseText);
            $('#result-list').html(resp.message);
        }
    });
});

$(document).on('click', '.restore-goods', function(e) {
    e.preventDefault();

    var url = $(this).attr('data-url');
    var listCode = $(this).attr('data-code');
    var page = parseInt($('.page-pagination').length ? $('.page-pagination').val() : 0);

    $.ajax({
        headers: {'X-CSRF-TOKEN' : token},
        type: 'PATCH',
        url: url,
        dataType: 'json',
        data: {'listCode': listCode, 'page': page},
        success: function(response) {
            $('#result-list').html(response.view);
            $('#pagination-block').html(response.pagination);
        },
        error: function(response) {
            var resp = $.parseJSON(response.responseText);
            $('#result-list').html(resp.message);
        }
    });
});

$(document).on('click', '.call-status-modal', function() {
    $('.change-order-status').attr('data-id', $(this).attr('data-id'));
});

$(document).on('click', '.change-order-status', function() {
    var id = $(this).attr('data-id');
    var status = $('.status-select').val();
    var page = parseInt($('.page-pagination').length ? $('.page-pagination').val() : 0);

    $.ajax({
        headers: {'X-CSRF-TOKEN': token},
        type: 'PATCH',
        url: '/cabinet/orders/change-status',
        dataType: 'json',
        data: {'id': id, 'status': status, 'page': page},
        success: function(response) {
            $('#order-status-changed').show();
            $('#result-list').html(response.view);
            $('#pagination-block').html(response.pagination);
        },
        error: function(response) {
            alert(response.message);
        }
    });
});

$(document).on('submit', '.form-pagination', function(e){
    e.preventDefault();

    var url = $(this).attr('action');
    var listCode = $('.goods-list-code').val();
    var sort = $('.sort-list').val();
    var view = $('.view-list.active').attr('data-view');
    var searchQuery = $('.search-input').val();
    var category = $('.category-select').val();
    var page = parseInt($('.page-pagination').val()) + 1;

    $.ajax({
        headers: {'X-CSRF-TOKEN': token},
        type: 'POST',
        url: url,
        data: {'sort': sort, 'view': view, 'searchQuery': searchQuery, 'category': category, 'page': page, 'listCode': listCode},
        dataType: 'json',
        success: function(response) {
            $('#result-list').append(response.view);
            $('#pagination-block').html(response.pagination);
        },
        error: function(reponse) {
            var resp = $.parseJSON(response.responseText);
            alert(resp.message);
        }
    });
});


function initMap(){
    var cord = $('#address-for-map').text();
    var myMap;
    ymaps.geocode(cord).then(function (res) {
        myMap = new ymaps.Map('map_canvas', {
            center: res.geoObjects.get(0).geometry.getCoordinates(),
            zoom : 10
        });

        var info = res.geoObjects.get(0).properties.getAll();
        console.log('Все данные геообъекта: ', res.geoObjects.get(0).properties.getAll());

        myPlacemark = new ymaps.Placemark(res.geoObjects.get(0).geometry.getCoordinates(), { // пытаюсь передать координаты и поставить метку
            hintContent: info.hintContent,
            balloonContent: info.balloonContent,
        });

        myMap.geoObjects.add(myPlacemark);
    });
}

function renderCatList() {
    var fd = new FormData($('.form-filter')[0]);
    fd.append('sort', $('.sort-list').val());
    fd.append('view', $('.view-list.active').attr('data-view'));
    fd.append('searchQuery', $('.search-input').val());
    fd.append('category', $('.category-select').val());
    fd.append('page', $('.page-pagination').length ? $('.page-pagination').val() : 0);
    var url = $('.form-filter').attr('action');
    $.ajax({
        headers: {'X-CSRF-TOKEN' : token},
        type: 'POST',
        url: url,
        dataType: 'json',
        data: fd,
        contentType: false,
        processData: false,
        success: function(response) {
            $('#result-list').html(response.view);
            $('#pagination-block').html(response.pagination);
        },
        error: function(response) {
            switch (response.status) {
                case 422 :
                alert(response)
                break;
                default :
                alert(response);
            }
        }
    });
}