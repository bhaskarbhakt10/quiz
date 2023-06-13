<?php
require_once  dirname(__FILE__, 3) . '/config.php';
?>
<script>
    // #debug 
    // $('.question-item').removeClass('d-none');
    // #debug 
    
    $('#total_ques').text($('.question-item:last-child').attr('data-quecount'));
    let quiz_container = $('.quiz-container');
    //detach all quiz - items expect first one 
    let quiz_items = $(quiz_container).find('.question-item:not(:first-child)');
    console.log(quiz_items);
    
    // #debug 
    quiz_items.detach();
    // #debug 
    
    
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
                    if($('#correction_div').length === 0){
                        $('<div class="correction_div" id="correction_div"></div>').insertAfter($('[data-questionid=' + question_id + ']'));
                    }
                    
                    let correction_payload = '';
                    correction_payload += "<p class='correct_option'> Correction option is: " + element.correct_option + ". " + $('[data-questionid=' + question_id + ']').find('input[data-value="' + element.correct_option + '"]').val() + "</p>"
                    correction_payload += "<p class='explaination'>" + element.explaination + "</p>";
                    $('#correction_div').append(correction_payload);
                } else {
                    // if ($('#next_question').length !== 0) {
                        $('[data-questionid=' + question_id + ']').closest('form').find('.quiz-container .buttons_wrap').append("<div class='next_question' id='next_question'><button class='btn btn-outline-primary next_question_btn'><i class='fa fa-arrow-right'></i></button></div>");
                    // }
                }
            },
        });

    }

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
        $('#current_question').text(parseInt(on_screen_question_id)+1);
        for (let index = 0; index < quiz_items.length; index++) {
            console.log(index);
            console.log(typeof(parseInt(on_screen_question_id) + 1));
            console.warn(typeof(parseInt($(quiz_items[index]).attr('data-quecount'))));
            if ((parseInt(on_screen_question_id) + 1) === parseInt($(quiz_items[index]).attr('data-quecount'))) {
                $(this).closest('form').find('.question-wrapper').append(quiz_items[index]);
                let question_wrapper_childrens = $(this).closest('form').find('.question-wrapper').children().toArray();
                question_wrapper_childrens.forEach(question_wrapper_children => {
                    if ($(question_wrapper_children).hasClass('d-none')) {
                        $(question_wrapper_children).removeClass('d-none');
                    }
                    else{
                        $(question_wrapper_children).remove();
                    }
                });
                $('[data-quecount="' + on_screen_question_id + '"]').detach();
                $(this).parent().remove();
            }
        }
    });
</script>