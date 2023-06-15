<?php
require_once  dirname(__FILE__, 3) . '/config.php';
?>
<script>
    $(function() {
        // #debug 
        // $('.question-item').removeClass('d-none');
        // #debug 

        $('#total_ques').text($('.question-item:last-child').attr('data-quecount'));
        let quiz_container = $('.quiz-container');
        //detach all quiz - items expect first one 
        // let quiz_items_all = $(quiz_container).find('.question-item').length;
        let quiz_items = $(quiz_container).find('.question-item:not(:first-child)');
        let last_quiz_item = quiz_items.toArray().pop();
        let last_quiz_id = $(last_quiz_item).attr('data-questionid');



        // console.warn(quiz_items_all);
        // #debug 
        quiz_items.detach();
        // #debug 


        //modal
        let correctionmodal = $('#correctionmodal');

        //check one value is only checked
        $(document.body).on('change', '.option_value input', function() {
            let this_value = $(this);
            let this_checkbox_name = $(this_value).attr('name');
            console.log($('[name=' + this_checkbox_name + ']'));
            if ($(this_value).is(':checked')) {
                console.log($('[name=' + this_checkbox_name + ']').prop('checked', false));
                $(this_value).prop('checked', true);
                $('#correction_div').remove();
            }
        })

        //submit btn
        // let submit_btn = $(quiz_container).find('');

        async function isRequired(chekbox_name, this_btn) {
            console.log($('[name=' + chekbox_name + ']').length);
            console.log();
            let value;
            if ($('[name=' + chekbox_name + ']').length !== 0) {
                if ($('[name=' + chekbox_name + ']').prop('required') === true) {
                    if (($('[name=' + chekbox_name + ']')).is(':checked')) {
                        value = $('[name=' + chekbox_name + ']:checked').data('value');
                    } else {
                        $('<div class="validation-div" id="validation"></div>').insertAfter($(this_btn).parent());
                        if ($('#validation').length !== 0) {
                            $('#validation').append('Required');
                            setTimeout(() => {
                                $('#validation').remove();
                            }, 5000);
                        }

                    }
                } else {
                    value = $('[name=' + chekbox_name + ']').data('valeu');
                }
            }
            return value;

        }

        async function ajax_call(option_to_send, question_id) {
            let data = {
                'selected_option': option_to_send,
                'question_id': question_id
            };
            $.ajax({
                'url': "<?php echo ROOT_URL_ACTION . 'play-quiz.php'; ?>",
                'data': data,
                'type': 'POST',
                'success': function(response) {
                    let response_obj = JSON.parse(response);
                    console.log(response_obj);
                    if (response_obj.correct_ans === false) {
                        const element = response_obj.correction
                        if ($('#correction_div').length === 0) {
                            $('<div class="correction_div" id="correction_div"></div>').insertAfter($('[data-questionid=' + question_id + ']'));
                        }

                        let correction_payload = '';
                        correction_payload += "<p class='correct_option'> Correction answer is: " + $('[data-questionid=' + question_id + ']').find('input[data-value="' + element.correct_option + '"]').val() + "</p>"
                        correction_payload += "<p class='explaination'>" + element.explaination + "</p>";

                        /*If mobile screen width is mobile i.e  600 or less than*/
                        if ($(window).width() <= 600) {

                            if (correctionmodal.length !== 0 && correctionmodal.length === 1) {
                                console.log(correctionmodal);
                                let target_body = $(correctionmodal).find('.mobile-correction-main');
                                let target_body_inside = $(correctionmodal).find('.mobile-correction-main>*');
                                target_body.append(correction_payload);
                                if (target_body_inside.length !== 0) {
                                    $(target_body_inside).remove();
                                }
                                $(correctionmodal).modal('show');
                            }
                        } else {
                            $('#correction_div').append(correction_payload);
                        }
                        /*If mobile screen width is mobile i.e  600 or less than*/

                        /**
                         * 
                         * Find correct answer and select corect ans
                         * 
                         */
                        let form = $(document.body).find('form');
                        if ($(form).is(':visible')) {
                            let target_checkbox_group = $(form).find('.question-item input[type="checkbox"]');
                            $(target_checkbox_group).prop('checked', false);
                            // check_correct_ans();
                        }
                        /** check correct ans  */
                        $('input[data-value=' + element.correct_option + ']').prop('checked', true);

                        /*
                        /** 
                         * 
                        // add next button after checking the question 
                        if($('.next_question_btn').length === 0) {
                        $('[data-questionid=' + question_id + ']').closest('form').find('.quiz-container .buttons_wrap').append("<div class='next_question' id='next_question'><button class='btn btn-outline-primary next_question_btn'><i class='fa fa-arrow-right'></i></button></div>");
                        }
                        */


                    } else {
                        if ($('.next_question_btn').length === 0) {
                            $('[data-questionid=' + question_id + ']').closest('form').find('.quiz-container .buttons_wrap').append("<div class='next_question' id='next_question'><button class='btn btn-outline-primary next_question_btn'><i class='fa fa-arrow-right'></i></button></div>");
                            particles();
                        }
                    }
                },
            });

        }
        /***
         * 
         * To replace on sleected option
         * uncomment the following line and comment the next line to it
         * 
         */
        // $(document.body).on('change', 'input[type=checkbox]', function(e) {
        $(document.body).on('click', 'button.submit_btn', function(e) {
            e.preventDefault();
            let this_btn = $(this);
            let chekbox_name = $(this).closest('form').find('input[type="checkbox"]').prop('name');
            const selected_option = isRequired(chekbox_name, this_btn);
            let option_to_send;
            let question_id = $(this).closest('form').find('[data-questionid]').attr('data-questionid');
            selected_option.then(function(value) {
                option_to_send = value;
                if (option_to_send !== undefined || option_to_send !== '' || option_to_send !== null) {
                    ajax_call(option_to_send, question_id);
                }
            });
        })


        $(document.body).on('click', '.next_question_btn', function(e) {
            e.preventDefault();
            let on_screen_question_id = $(this).closest('form').find('[data-quecount]').attr('data-quecount');
            incrementFlag(quiz_items.length + 1);
            for (let index = 0; index < quiz_items.length; index++) {
                console.log('rrr', index);
                // let quiz_questions = quiz_items.length;
                // console.log(typeof(parseInt(on_screen_question_id) + 1));
                // console.warn(typeof(parseInt($(quiz_items[index]).attr('data-quecount'))));
                if ((parseInt(on_screen_question_id) + 1) === parseInt($(quiz_items[index]).attr('data-quecount'))) {
                    $(this).closest('form').find('.question-wrapper').append(quiz_items[index]);
                    let question_wrapper_childrens = $(this).closest('form').find('.question-wrapper').children().toArray();
                    question_wrapper_childrens.forEach(question_wrapper_children => {
                        if ($(question_wrapper_children).hasClass('d-none')) {
                            $(question_wrapper_children).removeClass('d-none');
                        } else {
                            $(question_wrapper_children).remove();
                        }
                    });
                    $('[data-quecount="' + on_screen_question_id + '"]').detach();
                    $(this).parent().remove();
                }
            }
        });
    })
    let thanks = $('#finish-section');
    thanks.detach();
    let start_question_flag = 0;

    function incrementFlag(quiz) {
        start_question_flag = start_question_flag + 1;
        if (start_question_flag === quiz) {
            $('.main-content-area>*').remove();
            $('.main-content-area').append(thanks);
            if ($(thanks).hasClass('d-none')) {
                $(thanks).removeClass('d-none');
                start_continous_confetti();
            }
        }

    }


    /*
    $(document.body).on('hidden.bs.modal', '#correctionmodal', function() {
        let form = $(document.body).find('form');
        $('.next_question_btn').trigger('click');
        if ($(form).is(':visible')) {
        }
    });
    */


    function particles() {
        confetti({
            particleCount: 100,
            spread: 70,
            origin: {
                y: 1
            },
        });
    }

    function start_continous_confetti() {
        tsParticles.load("tsparticles", {
            "fullScreen": {
                "zIndex": 1
            },
            "emitters": [{
                    "position": {
                        "x": 0,
                        "y": 30
                    },
                    "rate": {
                        "quantity": 5,
                        "delay": 0.15
                    },
                    "particles": {
                        "move": {
                            "direction": "top-right",
                            "outModes": {
                                "top": "none",
                                "left": "none",
                                "default": "destroy"
                            }
                        }
                    }
                },
                {
                    "position": {
                        "x": 100,
                        "y": 30
                    },
                    "rate": {
                        "quantity": 5,
                        "delay": 0.15
                    },
                    "particles": {
                        "move": {
                            "direction": "top-left",
                            "outModes": {
                                "top": "none",
                                "right": "none",
                                "default": "destroy"
                            }
                        }
                    }
                }
            ],
            "particles": {
                "color": {
                    "value": [
                        "#ffffff",
                        "#FF0000"
                    ]
                },
                "move": {
                    "decay": 0.05,
                    "direction": "top",
                    "enable": true,
                    "gravity": {
                        "enable": true
                    },
                    "outModes": {
                        "top": "none",
                        "default": "destroy"
                    },
                    "speed": {
                        "min": 10,
                        "max": 50
                    }
                },
                "number": {
                    "value": 0
                },
                "opacity": {
                    "value": 1
                },
                "rotate": {
                    "value": {
                        "min": 0,
                        "max": 360
                    },
                    "direction": "random",
                    "animation": {
                        "enable": true,
                        "speed": 30
                    }
                },
                "tilt": {
                    "direction": "random",
                    "enable": true,
                    "value": {
                        "min": 0,
                        "max": 360
                    },
                    "animation": {
                        "enable": true,
                        "speed": 30
                    }
                },
                "size": {
                    "value": {
                        "min": 0,
                        "max": 2
                    },
                    "animation": {
                        "enable": true,
                        "startValue": "min",
                        "count": 1,
                        "speed": 16,
                        "sync": true
                    }
                },
                "roll": {
                    "darken": {
                        "enable": true,
                        "value": 25
                    },
                    "enable": true,
                    "speed": {
                        "min": 5,
                        "max": 15
                    }
                },
                "wobble": {
                    "distance": 30,
                    "enable": true,
                    "speed": {
                        "min": -7,
                        "max": 7
                    }
                },
                "shape": {
                    "type": [
                        "circle",
                        "square",
                        "triangle",
                        "polygon"
                    ],
                    "options": {
                        "polygon": [{
                                "sides": 5
                            },
                            {
                                "sides": 6
                            }
                        ]
                    }
                }
            }
        });
    }
</script>