//use strict mode;
'use strict';
import owlCarousel from '../owl.carousel.min.js';
import thumbs from '../owl.carousel2.thumbs.min.js';


$(document).ready( function() {
	
	/*function notifyMe() {

		if (!("Notification" in window)) {
			console.log("This browser does not support desktop notification");
		}


		else if (Notification.permission === "granted") {

			var notification = new Notification("Hi there!");
		}


		else if (Notification.permission !== 'denied' || Notification.permission === "default") {
			Notification.requestPermission(function (permission) {

				if (permission === "granted") {
					console.log(permission);
					var notification = new Notification("Hi there!");
				}
			});
		} 
	}
	notifyMe();*/
	//tooltips
	$(function () {
		var options = {
			trigger: 'click'
		};
		$('[data-toggle="tooltip"]').tooltip(options);
	})
	//phone number

	$('[data-item="phone"]').mask("+7 (999) 999-99-99");
	//show tabs in registration
	$('#registration label').click(function (e) {
		$(this).tab('show');
	});

	var select = $('[data-item="select"]');
	var selectNoSearch = $('[data-item="select-no-search"]');
	var selectTags = $('[data-item="select-tags"]');
	var selectColor = $('[data-item="select-color"]');

	function colorTmp (data, container) {
		if (!data.id) { return data.text;}
		var $data = $(
			'<div class="bg-select"><span class="bg-select-color" style="background-color: '+ data.element.value +'"></span><span class="bg-select-text">' + data.text + '</span>' + '</div>'
			);
		return $data;
	};

	$(selectColor).select2({
		theme: "bootstrap",
		templateResult: colorTmp,
		templateSelection: colorTmp
	});

	select.select2({theme: "bootstrap"});

	selectNoSearch.select2({ theme: "bootstrap"}).on('select2:open',function(e) {
		$('.select2-search.select2-search--dropdown').remove();
	});

	selectTags.select2({
		theme: "bootstrap",
		tags: true,
	});
	
	$("[data-item='select-clear']").on("click", function () {
		$(this).next().val(null).trigger("change");
	});
	/* select END*/
	/*header*/
	$('[data-item="dropdown"]').hover(
		function() {
			//$(this).dropdown('toggle');
			$(this).parent('.dropdown').addClass('open');

			$(this).next().next().stop(true, true).attr('data-hovered',true);
			$('[data-hovered="true"]').hover(
				function() {
					$(this).stop(true, true).attr('data-hovered',false);
				},
				function() {
					$(this).stop(true, true).delay(200).parent('.dropdown').removeClass('open');
				}
				);
		},
		function() {
			
		}
		);
	
	$('[data-item="click-dropdown"]').on('click',function(){
		$(this).parent('.dropdown').addClass('open');
		$(this).next().next().stop(true, true).attr('data-hovered',true);
		$('[data-hovered="true"]').hover(
			function() {
				$(this).stop(true, true).attr('data-hovered',false);
			},
			function() {
				$(this).stop(true, true).delay(200).parent('.dropdown').removeClass('open');
			}
			);
	});

	var dot = $('[data-item="overflow"]');
	function cuttext(el){
		for (var i = 0; $(el).length > i; i++) {
			var text = $(el[i]).text();
			var newstr = jQuery.trim(text).substring(0, 165).trim(this) + "...";
			$(el[i]).text(newstr);
		}
	}

	cuttext(dot);
	
	//sliders
	let owlMain = $('[data-item="slider-main"]');
	owlMain.owlCarousel({
		loop:true,
		margin:0,
		nav:true,
		dots:true,
		items:1,
		autoplayHoverPause: true,
		autoplayTimeout: 5000,
		autoplay:true,
		navText: [
		"<i class='fa fa-angle-left'></i>", 
		"<i class='fa fa-angle-right'></i>"
		],
		dots: true
	});
	//sliders end
	
	/*header END*/
	var Settings = {
		ValidationOptions: {
			framework: 'bootstrap',
			
			locale: 'ru_RU',

			fields: {
				userCity: {
					trigger: 'keyup keydown keypress',
					validators: {
						// The validator will create an Ajax request
						// sending { username: 'its value' } to the back-end
						// колбэк если нужно какое-то особое правило но в принцепе не более, в данном случае если value = 2 то error
						callback: {
							message: 'if script wrong test',
							callback: function(value, validator, $field) {
								if(value == 2) {
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
				DIMENSIONS: {
					trigger: 'keyup keydown keypress',
					validators: {
						// The validator will create an Ajax request
						// sending { username: 'its value' } to the back-end
						// колбэк если нужно какое-то особое правило но в принцепе не более, в данном случае если value = 2 то error
						notEmpty: {
							message: 'Это поле не может быть пустым!'
						},
						blank: {}
					}
				},
				userRegion: {
					trigger: 'keyup keydown keypress',
					validators: {
						// The validator will create an Ajax request
						// sending { username: 'its value' } to the back-end
						notEmpty: {
							message: 'Это поле не может быть пустым!'
						},
						blank: {}
					}
				},
				userAddress: {
					trigger: 'keyup keydown keypress',
					validators: {
						// The validator will create an Ajax request
						// sending { username: 'its value' } to the back-end
						notEmpty: {
							message: 'Это поле не может быть пустым!'
						},
						blank: {}
					}
				},
				companyName: {
					trigger: 'keyup keydown keypress',
					validators: {
						// The validator will create an Ajax request
						// sending { username: 'its value' } to the back-end
						notEmpty: {
							message: 'Это поле не может быть пустым!'
						},
						blank: {}
					}
				},
				userName: {
					trigger: 'keyup keydown keypress',
					validators: {
						// The validator will create an Ajax request
						// sending { username: 'its value' } to the back-end
						notEmpty: {
							message: 'Это поле не может быть пустым!'
						},
						blank: {}
					}
				},
				userPhone: {
					trigger: 'keyup keydown keypress',

					validators: {
						notEmpty: {
							message: 'Это поле не может быть пустым!'
						},
						blank: {}
					}
				},
				userPassword: {
					trigger: 'keyup keydown keypress',

					validators: {
						notEmpty: {
							message: 'Это поле не может быть пустым!'
						},
						blank: {}
					}
				},
				userMail: {
					trigger: 'keyup keydown keypress',

					validators: {
						emailAddress: {
							message: 'Это не похоже на e-mail!'
						},
						notEmpty: {
							message: 'Это поле не может быть пустым!'
						},
						blank: {}
					}
				},
				userPasswordNew: {
					trigger: 'keyup keydown keypress',

					validators: {
						stringLength: {
							min: 6,
							message: 'Длина пароля должна быть более 6 символов!'
						},
						notEmpty: {
							message: 'Это поле не может быть пустым!'
						},
						blank: {}
					}
				},
				userPasswordNewConfirm: {
					trigger: 'keyup keydown keypress',

					validators: {
						identical: {
							field: 'userPasswordNew',
							message: 'Ваши пороли не совпадают!'
						},
						blank: {}
					}
				},
				carPrice: {
					trigger: 'keyup keydown keypress',

					validators: {
						notEmpty: {
							message: 'Это поле не может быть пустым!'
						},
						blank: {}
					}
				},
				carCount: {
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

		initialize : function () {
			this.Validation('.Settings');
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
			$(form).find(select).select2({theme: "bootstrap"})
			.change(function(e) {
				$(form).formValidation('revalidateField', e.target.name);
			})
			.end();
			$(form)
			.find('[data-input="file"]')
			.on('fileloaded', function(event, file, previewId, index, reader) {
				$(form).formValidation('revalidateField', event.target.name);
			})
			.end()
			.find('[data-input="file"]')
			.on('change', function(e) {
				$(form).formValidation('revalidateField', e.target.name);
			})
			.end()
			.find('[data-input="file"]')
			.on('fileclear', function(event) {
				
				$(form).formValidation('revalidateField', event.target.name);
			})
			.end();
		}
	};
	var Registration = {
		ValidationOptions: {
			framework: 'bootstrap',

			err: {
				container: function($field, validator) {
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
				companyName: {
					trigger: 'keyup keydown keypress',

					validators: {
						// The validator will create an Ajax request
						// sending { username: 'its value' } to the back-end
						notEmpty: {
							message: 'Это поле не может быть пустым!'
						},
						remote: {
							message: 'Данное Имя уже используется!',
							url: 'hendler.php',
							type: 'POST',
							delay: 2000
						}
					}
				},
				userName: {
					trigger: 'keyup keydown keypress',

					validators: {
						// The validator will create an Ajax request
						// sending { username: 'its value' } to the back-end
						notEmpty: {
							message: 'Это поле не может быть пустым!'
						},
						remote: {
							message: 'Данное Имя уже используется!',
							url: 'hendler.php',
							type: 'POST',
							delay: 2000
						}
					}
				},
				userLogin: {
					trigger: 'keyup keydown keypress',

					validators: {
						notEmpty: {
							message: 'Это поле не может быть пустым!'
						}
					}
				},
				userMail: {
					trigger: 'keyup keydown keypress',

					validators: {
						emailAddress: {
							message: 'Это не похоже на e-mail!'
						},
						notEmpty: {
							message: 'Это поле не может быть пустым!'
						}
					}
				},
				userPhone: {
					trigger: 'keydown keyup keypress',

					validators: {
						callback: {
							message: 'Это поле не может быть пустым!',
							callback: function($field){
								if(/[+][7]\s[()][0-9]{3}[)]\s[0-9]{3}[-][0-9]{2}[-][0-9]{2}/i.test($field) === true){
									return true;
								} else {
									return false;
								}
							}
						},
						notEmpty: {
							message: 'Это поле не может быть пустым!'
						}
					}
				},
				userPassword: {
					trigger: 'keyup keydown keypress',

					validators: {
						stringLength: {
							min: 6,
							message: 'Длина пароля должна быть более 6 символов!'
						},
						notEmpty: {
							message: 'Это поле не может быть пустым!'
						}
					}
				},
				userPasswordConfirm: {
					trigger: 'keyup keydown keypress',

					validators: {
						identical: {
							field: 'userPassword',
							message: 'Ваши пороли не совпадают!'
						}
					}
				}
			}
		},

		initialize : function () {
			this.Validation('.Registration-form');
		},
		Validation:function(form){
			$(form).on('init.field.fv', function(e, data) {
				var $parent = data.element.parents('.form-group'),
				$icon   = data.element.data('fv.icon'),
				$label  = $parent.find('.validation-right-inner .error-icon');

				$icon.appendTo($label);
			})
			.formValidation(this.ValidationOptions);
		}
	};

	var TogglePassword = {

		initialize: function () {
			this.chengeType();
			this.toggleGlass();
		},
		toggleGlass: function(){
			$('.toggle-password').on('click', function(e){
				$(this).toggleClass('fa-eye-slash fa-eye');
			});
		},

		chengeType: function () {
			$('.toggle-password').on('click', function(e){
				var input = $(this).parent().find('input'),
				checkType = input.attr('type');

				if(checkType === 'password') {
					input.attr('type', 'text');
				}
				else {
					input.attr('type', 'password');
				}

			});
		}
	}

	var AddStageTwo = {
		ValidationOptions: {
			framework: 'bootstrap',
			
			locale: 'ru_RU',

			validateVin: function(value){
				var vin = new RegExp("^[A-HJ-NPR-Z\\d]{8}[\\dX][A-HJ-NPR-Z\\d]{2}\\d{6}$");
				return vin.test(value);
			},

			fields: {
				userCity: {
					trigger: 'keyup keydown keypress',
					validators: {
						notEmpty: {
							message: 'Это поле не может быть пустым!'
						},
						blank: {}
					}
				},
				
				userRegion: {
					trigger: 'keyup keydown keypress',
					validators: {
						// The validator will create an Ajax request
						// sending { username: 'its value' } to the back-end
						notEmpty: {
							message: 'Это поле не может быть пустым!'
						},
						blank: {}
					}
				},

				'carMark[]': {
					trigger: 'keyup keydown keypress',
					validators: {
						// The validator will create an Ajax request
						// sending { username: 'its value' } to the back-end
						notEmpty: {
							message: 'Это поле не может быть пустым!'
						},
						blank: {}
					}
				},

				'carModel[]': {
					trigger: 'keyup keydown keypress',
					validators: {
						// The validator will create an Ajax request
						// sending { username: 'its value' } to the back-end
						notEmpty: {
							message: 'Это поле не может быть пустым!'
						},
						blank: {}
					}
				},

				carStatus: {
					trigger: 'keyup keydown keypress',
					validators: {
						// The validator will create an Ajax request
						// sending { username: 'its value' } to the back-end
						notEmpty: {
							message: 'Это поле не может быть пустым!'
						},
						blank: {}
					}
				},

				carTransmission: {
					trigger: 'keyup keydown keypress',
					validators: {
						// The validator will create an Ajax request
						// sending { username: 'its value' } to the back-end
						notEmpty: {
							message: 'Это поле не может быть пустым!'
						},
						blank: {}
					}
				},

				carBodyType: {
					trigger: 'keyup keydown keypress',
					validators: {
						// The validator will create an Ajax request
						// sending { username: 'its value' } to the back-end
						notEmpty: {
							message: 'Это поле не может быть пустым!'
						},
						blank: {}
					}
				},

				carSteeringWheel: {
					trigger: 'keyup keydown keypress',
					validators: {
						// The validator will create an Ajax request
						// sending { username: 'its value' } to the back-end
						notEmpty: {
							message: 'Это поле не может быть пустым!'
						},
						blank: {}
					}
				},

				carMotorClass: {
					trigger: 'keyup keydown keypress',
					validators: {
						// The validator will create an Ajax request
						// sending { username: 'its value' } to the back-end
						notEmpty: {
							message: 'Это поле не может быть пустым!'
						},
						blank: {}
					}
				},

				carColor: {
					trigger: 'keyup keydown keypress',
					validators: {
						// The validator will create an Ajax request
						// sending { username: 'its value' } to the back-end
						notEmpty: {
							message: 'Это поле не может быть пустым!'
						},
						blank: {}
					}
				},

				carBuildYear: {
					trigger: 'keyup keydown keypress',
					validators: {
						// The validator will create an Ajax request
						// sending { username: 'its value' } to the back-end
						notEmpty: {
							message: 'Это поле не может быть пустым!'
						},
						blank: {}
					}
				},

				carRoadTrip: {
					trigger: 'keyup keydown keypress',
					validators: {
						// The validator will create an Ajax request
						// sending { username: 'its value' } to the back-end
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

				carEngineСapacity: {
					trigger: 'keyup keydown keypress',
					validators: {
						// The validator will create an Ajax request
						// sending { username: 'its value' } to the back-end
						callback: {
							message: 'Вы превышаете лимит в 16 000',
							callback: function(value, validator, $field) {
								var val = +value.replace(/ /g, '');
								var lim = 16000;
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

				carVIN: {
					trigger: 'keyup keydown keypress',
					validators: {
						// The validator will create an Ajax request
						// sending { username: 'its value' } to the back-end
						callback: {
							callback: function(value, validator, $field) {
								var vin = validator.options.validateVin(value);
								if(!vin) {
									return false;
								}
								return true;
							},

							message: 'Ваш VIN не соответствует!'
						},
						notEmpty: {
							message: 'Это поле не может быть пустым!'
						},
						blank: {}
					}
				}
			}
		},

		initialize : function () {
			this.Validation('.AddStageTwo');
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
			$(form).find(select)
			.change(function(e) {
				console.log(e.target.name);
				$(form).formValidation('revalidateField', e.target.name);
			})
			.end();
			$(form).find(selectNoSearch).on('change',function(e) {
				console.log(e.target.name);
				$(form).formValidation('revalidateField', e.target.name);
				$('.select2-search.select2-search--dropdown').remove();
			});
			$(form)
			.find('[data-input="file"]')
			.on('fileloaded', function(event, file, previewId, index, reader) {
				console.log(event.target.name);
				$(form).formValidation('revalidateField', event.target.name);
				
			})

			.end()

			.find('[data-input="file"]')

			.on('change', function(e) {
				console.log(e.target.name);
				$(form).formValidation('revalidateField', e.target.name);
			})
			.end()
			.find('[data-input="file"]')
			.on('fileclear', function(event) {
				console.log(event.target.name);
				$(form).formValidation('revalidateField', event.target.name);
			})
			.end();
		}
	};
	var AskForm = {
		ValidationOptions: {
			framework: 'bootstrap',
			locale: 'ru_RU',

			fields: {
				userMessage: {
					trigger: 'keyup keydown keypress',
					validators: {
						notEmpty: {
							message: 'Это поле не может быть пустым!'
						},
						blank: {}
					}
				},
				userMail: {
					trigger: 'keyup keydown keypress',
					validators: {
						emailAddress: {
							message: 'Это не похоже на e-mail!'
						},
						notEmpty: {
							message: 'Это поле не может быть пустым!'
						},
						blank: {}
					}
				},
				suggestion: {
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

		initialize : function () {
			this.Validation('.askForm');
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
	var ChangeStatusItem = {
		ValidationOptions: {
			framework: 'bootstrap',
			locale: 'ru_RU',

			fields: {
				itemStatus: {
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

		initialize : function () {
			this.Validation('.ChangeStatusItem');
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
	/*init libs*/
	ChangeStatusItem.initialize();
	AskForm.initialize();
	Settings.initialize();
	Registration.initialize();
	AddStageTwo.initialize();
	TogglePassword.initialize();
	

	var Category = {
		that: function(e){
			var val = +this.getAttribute('data-val');
			var cat = this.name;
			console.log(val);
			switch (cat){
				case 'category':

				var subcategory = $('[data-item="subcategory"]').find('input');
				var subsubcategory = $('[data-item="subsubcategory"]').find('input');

				for (var i = 0; subcategory.length > i; i++){
					subcategory[i].checked = false;
				}
				for (var i = 0; subsubcategory.length > i; i++){
					subsubcategory[i].checked = false;
				}

				$('[data-item="subcategory"]').addClass('hidden');
				$('[data-item="subsubcategory"]').addClass('hidden');

				$('[data-item="subcategory"]')[val].classList.remove('hidden');

				break;

				case 'subcategory':

				var subsubcategory = $('[data-item="subsubcategory"]').find('input');

				for (var i = 0; subsubcategory.length > i; i++){
					subsubcategory[i].checked = false;
				}
				$('[data-item="subsubcategory"]').addClass('hidden');
				if(!($('[data-item="subsubcategory"]')[val])) return;
				
				$('[data-item="subsubcategory"]')[val].classList.remove('hidden');

				break;
				case 'subsubcategory':
				break;
			}
		},
		category: function(){
			var category = $('[data-item="category"]');
			var form = $('[data-item="add-item-stage-1"]');

			form.find('input').on('change', this.that);

			form.on('submit',function(e){
				e.preventDefault();
			});
		},
		initialize: function () {
			this.category();
		}
	}

	Category.initialize();

	$('.btn-file').find('button').on('click',function(e){
		$(this).next('[data-item="photo"]').click();
	});

	//simple file preview manipulations
	var imagesPreview = function(input, placeToInsertImagePreview) {
		if (input.files) {
			var filesAmount = input.files.length;
			if(filesAmount >= 1){
				for (var i = 0; i < filesAmount; i++) {
					var file = input.files[i];
					setUp(placeToInsertImagePreview,file);
				}
				var list = $('.wrap-img').length;
				$('.wrap-img').append('<div class="del"></div>');
				var inputHidden = $($.parseHTML('<input type="hidden" class="hidden">')).attr('value', window.URL.createObjectURL(file));
				$(inputHidden).appendTo('.wrap-img');
				$('.del').on('click',function(e){
					$(this).parent('.wrap-img').remove();
					var list = $('.wrap-img').length;
					if(list <= 0) {
						placeholdIt(placeToInsertImagePreview);
					}
					calc();
				});
			}
			else {
				placeholdIt(placeToInsertImagePreview);
			}
		}
	};
	function setUp(place,file) {
		var img = $($.parseHTML('<img>')).attr('src', window.URL.createObjectURL(file));
		img.onload = function(e){
			window.URL.revokeObjectURL(this.src);
		}
		
		img.appendTo(place).wrap("<div class='wrap-img' data-title="+file.name.replace(/\s/g, '&nbsp;').replace('—', '-')+"></div>").addClass('loadedimg');
		$(place).find('.no-photo').remove();
		$(place).addClass('when-upload-photo');
		$(place).removeClass('when-no-photo');
	}

	function placeholdIt(place) {
		$(place).removeClass('when-upload-photo');
		$(place).addClass('when-no-photo');
		$(place).html('<div class="no-photo"><img src="http://placehold.it/200x200"></div>');
	}
	$('[data-item="photo"]').on('change', function() {
		$('div.photo-upload-container.one').html(' ');
		imagesPreview(this, 'div.photo-upload-container.one');
	});
	//reset Filter
	$('[data-item="reset-filter"]').on('click',function(event){
		event.preventDefault();
		var form = $(this).parents('form');
		var select = $(form).find('select');
		var inputs = $(form).find('input');
		$(select).select2("val", ""); 
		$(inputs).val('');
	});
	//reset Filter END
	//file upload trying
	var fInput = $('[data-input="file"]');
	function addPreview(){
		$.each(fInput, function(key,value){
			var input = value,
			preview = input.getAttribute('data-initial');
			if(preview) {
				var arr = this.getAttribute('data-initial').split(',');
				
			} else {
				var arr = 0;
			}
			$(input).fileinput({
				uploadUrl: 'url',
				language: "ru",
				allowedFileExtensions: ["jpg", "png", "gif", "svg"],
				browseLabel: "Загрузить изображение",
				dropZoneEnabled: false,
				overwriteInitial: false,
				initialPreviewAsData: true,
				validateInitialCount: true,
				browseIcon: '<span class="fa fa-upload kv-caption-icon"></span>',
				initialPreviewFileType: 'image',
				initialPreview: arr, 
				initialPreviewConfig: [
				{
					url:'url',
					frameClass: 'my-custom-frame-css',
					frameAttr: {
						style: 'height:80px'
					}
				}
				],

				layoutTemplates: {
					main1: "{preview}\n" +
					"<div class=\'input-group {class}\'>\n" +
					"   <div class=\'input-group-btn\'>\n" +
					"       {browse}\n" +
					"   </div>\n" +
					"</div>",

					preview: 
					'<div class="file-preview {class}">\n' +
					'    <div class="{dropClass}">\n' +
					'    <div class="file-preview-thumbnails">\n' +
					'    </div>\n' +
					'    <div class="clearfix"></div>' +
					'    <div class="file-preview-status text-center text-success"></div>\n' +
					'    <div class="kv-fileinput-error"></div>\n' +
					'    </div>\n' +
					'</div>',
					
					footer: '<div class="file-thumbnail-footer">\n' +
					'     {actions}\n' +
					'</div>',

					actions: '<div class="file-actions">\n' +
					'    <div class="file-footer-buttons">\n' +
					'         {delete} ' +
					'    </div>\n' +
					'    <div class="clearfix"></div>\n' +
					'</div>',

					actionDelete: '<button type="button" class="kv-file-remove {removeClass}" title="{removeTitle}"{dataUrl}{dataKey}><i class="fa fa-times" aria-hidden="true"></i></button>\n'
				},
				previewTemplates: {
					image: '<div class="file-preview-frame" id="{previewId}" data-fileindex="{fileindex}" data-template="{template}">\n' +
					'   {footer}\n' +
					'   <div class="kv-file-content">' +
					'       <img src="{data}" class="kv-preview-data file-preview-image" title="{caption}" alt="{caption}" >\n' +
					'   </div>\n' +
					'</div>\n'
				}
			});

		});
	}
	addPreview();
	var numberInput = $('[data-item="format"]');

	function NumberIn(event) {
		return (event.charCode >= 48 && event.charCode <= 57);
	}
	function formatNum(event) {
		var prev_value="";
		var nextInput = $(this).next().val(this.value);
		var nextInputVal = parseInt(nextInput.val().replace(/ /g, ''));
		this.value = this.value.replace(/[^\d\s]/g, "");

		if (prev_value==this.value) return;
		prev_value = this.value;
		this.value = this.value.replace(/[^\d]/g, "").split("").reverse().join("").replace(/\d{3}(?!$|(?:\s$))/g, "$& ").split("").reverse().join("");
		nextInput.val(nextInputVal);
	}
	function formatNumInit(el) {
		var i;
		for (i = 0; i < el.length; i+=1) {
			var val = $(el[i]).val().replace(/[^\d]/g, "").split("").reverse().join("").replace(/\d{3}(?!$|(?:\s$))/g, "$& ").split("").reverse().join("");
			$(el[i]).val(val);
		}
	}
	if(numberInput) {
		formatNumInit(numberInput);
		numberInput.on('keypress keyup change paste loaded', NumberIn);
		numberInput.on('keypress keyup change paste loaded', formatNum);
	}
	//complectations
	(function Complectation(){
		var complectations = $('[data-item="complectation"]');
		var calcPrice = $('[data-calc="price"]');
		var calcCount = $('[data-calc="count"]');
		var calcCompCount = calcCount.data('comp-count');

		function cmp(el){
			el = this || el;
			$('.Add-item-tab-content-complictation').addClass('hidden');
			if(+el.value === 1) {
				sumCmp();
				$('.Add-item-tab-content-complictation').removeClass('hidden');
			}
		}
		function sumCmp(){
			$('.Add-item-tab-content-complictation .price span').text(calcPrice.next().val() * calcCount.next().val());
			var str = $('.Add-item-tab-content-complictation .price span').text().replace(/[^\d]/g, "").split("").reverse().join("").replace(/\d{3}(?!$|(?:\s$))/g, "$& ").split("").reverse().join("");
			$('.Add-item-tab-content-complictation .price span').text(str);

		}
		calcCount.on('keypress keyup keydown', sumCmp);
		calcPrice.on('keypress keyup keydown', sumCmp);
		complectations.on('change', cmp);
	})();
	//complectations END
	var btnDelete = $('[data-item="delete"]');
	function doModal(heading, formContent, event) {
		heading.preventDefault();
		var html;
		var that = this;
		heading = $(this).text();
		formContent = $(this).parents('[data-item="target-delete"]').find('[data-item="modal-description"]').html();
		var msg = $(this).parents('[data-item="target-delete"]').is('.Message-preview-item');
		var msgPost = $(this).parents('[data-item="target-delete"]').is('.Message-preview-item.Inbox');
		if(msgPost) {
			$("#DelItem").remove();
			$(that).parents('[data-item="target-delete"]').remove();
			return;
		}
		if(msg) {
			html =  '<div id="DelItem" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="confirm-modal" aria-hidden="true">';
			html += '<div class="modal-dialog modal-md">';
			html += '<div class="modal-content">';
			html += '<div class="modal-header">';
			html += '<a class="close" data-dismiss="modal">×</a>';
			html += '<h4>'+heading+'</h4>'
			html += '</div>';
			html += '<div class="modal-body">';
			html += '<p>';
			html += 'Вы уверены, что <strong>хотите очистить всю историю сообщений</strong> с этим пользователем ?<br>';
			html += '<p>';
			html += 'Это <strong>не может</strong> быть отменено.';
			html += '</div>';
			html += '<div class="modal-footer">';
			html += '<button class="btn btn-default" type="button" data-modal="Cancel">Отмена</button>';
			html += '<button class="btn btn-primary" type="button" data-modal="OK">Удалить</button>';
			html += '</div>';  // content
			html += '</div>';  // dialog
			html += '</div>';  // footer
			html += '</div>';  // modalWindow
		} else {
			html =  '<div id="DelItem" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="confirm-modal" aria-hidden="true">';
			html += '<div class="modal-dialog">';
			html += '<div class="modal-content">';
			html += '<div class="modal-header">';
			html += '<a class="close" data-dismiss="modal">×</a>';
			html += '<h4>'+heading+'</h4>'
			html += '</div>';
			html += '<div class="modal-body">';
			html += '<p>';
			html += 'Вы действительно хотите удалить ' + formContent + ' ?';
			html += '</div>';
			html += '<div class="modal-footer">';
			html += '<button class="btn btn-default" type="button" data-modal="Cancel">Отмена</button>';
			html += '<button class="btn btn-primary" type="button" data-modal="OK">Удалить</button>';
			html += '</div>';  
			html += '</div>';  
			html += '</div>';  
			html += '</div>';  
		}

		$('body').append(html);
		$("#DelItem").modal();
		$("#DelItem").modal('show');

		$("#DelItem").find('[data-modal="Cancel"]').on('click',function(e){
			$("#DelItem").modal('hide');
			$('#DelItem').on('hidden.bs.modal', function (e) {
				console.log(e.target);
				$(this).remove();
			});
		});

		$("#DelItem").find('[data-modal="OK"]').on('click',function(e){
			$(that).parents('[data-item="target-delete"]').remove();
			$("#DelItem").modal('hide');
			$('#DelItem').on('hidden.bs.modal', function (e) {
				console.log(e.target);
				$(this).remove();
			});
		});

		$('#DelItem').on('hidden.bs.modal', function (e) {
			console.log(e.target);
			$(this).remove();
		});
	}
	btnDelete.on('click', doModal);

	//Order form with some data
	var OrderTrash = {
		data:[],
		testdata: function (model, price){
			this.model = model;
			this.price = price;
		},
		initialize: function () {
			var trash = $('[data-item="order-cards"]');
			this.getDataItems(trash);
		},
		getDataItems: function (trash) {
			var that = this;
			trash.on('submit',function(e){
				var item = trash.find('[data-item="product"]'),
				name = item.find('.product-item-vertical--name p a'),
				price = item.find('.product-item-vertical--price p');
				e.preventDefault();
			});
		}
	}
	/*init libs*/
	OrderTrash.initialize();
	var showInfo = function(e){
		var btn = e.relatedTarget;
		var item = $(btn).parents('.product-item-vertical');
		var name = item.find('.product-item-vertical--name p a').text();
		var who = item.find('.product-item-vertical--place a').clone();

		var cont = $(this).find('.from');

		var newName = $('<p>'+name+'</p>');
		cont.html('');
		cont.append(newName, who);

		//form submit
		var that = this;
		$(this).find('[data-btn="submit"]').on('click',function(e){
			$(that).find('form').submit();
		});
	}
	var btnSubmitModal = function(e){
		//form submit
		var that = this;
		$(this).find('[data-btn="submit"]').on('click',function(e){
			$(that).find('form').submit();
		});
	}
	$('#callSeller').on('show.bs.modal', showInfo);
	$('#changeStatusType').on('show.bs.modal', btnSubmitModal);

	//Fotorama
	var fotorama = $('.fotorama');
	fotorama.fotorama({
		with: '100%',
		allowfullscreen: true,
		thumbmargin: 10,
		fit: 'contain',
		clicktransition: 'slide',
		transition:'crossfade',
		transitionduration: 300,
		click:false,
		swipe:false,
		loop: true
	}).data('fotorama');

	var fAPI = fotorama.data('fotorama');

	$(".fotorama__arr--prev").html("<i class='fa fa-angle-left' aria-hidden='true'></i>");
	$(".fotorama__arr--next").html("<i class='fa fa-angle-right' aria-hidden='true'></i>");
	//$(".fotorama__fullscreen-icon").html("<i class='fa fa-times' aria-hidden='true'></i>");

	fotorama.on('click',function(e){
		var t = e.target;
		if(fotorama.hasClass('fotorama--fullscreen')) {
			if($(t).is('.fotorama__stage__frame')) {
				fotorama.data('fotorama').cancelFullScreen();
			}
		}
		if (t.tagName !== 'IMG') return;
		fotorama.data('fotorama').requestFullScreen();
	});
	fotorama.find('.fotorama__nav__shaft').on('click',function(e){
		fotorama.data('fotorama').requestFullScreen();
	});

	$(document).on('mouseover', '.fotorama__nav__frame', function () {
		var $fotorama = $(this).parents('.fotorama'); 
		$fotorama.data('fotorama').show({index: $('.fotorama__nav__frame', $fotorama).index(this)});
	});

});
