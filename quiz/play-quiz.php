<?php
$play_quiz = false;
if (!array_key_exists('level', $_GET) || !array_key_exists('HTTP_REFERER', $_SERVER)) {
    require_once ROOT_PATH_QUIZ . 'select-level.php';
} else {
    $play_quiz = true;
    $level = (int)$_GET['level'];
    $questions_and_answers = $quiz->get_questions_by_level($level);
}

?>
<div class="main main-play-area">
    <?php
    //main
    if ($play_quiz === true) {
        if ($questions_and_answers->num_rows > 0) {
    ?>
            <form action="" novalidate>
                <div class="quiz-container play-quiz" id="play-quiz-main">

                    <!-- header logo  -->
                    <div class="quiz-logo">
                        <img src="<?php echo ASSETS_URL ?>images/divine-logo.png" alt="" class="img-fluid w-30 w-d15">
                    </div>
                    <!-- header logo  -->

                    <div class="quiz-subheader text-center mx-lg-0 my-lg-2  ">
                        <img src="<?php echo ASSETS_URL ?>images/heading.png" alt="" class="img-fluid w-80 w-d40 ">
                    </div>

                    <div class="count d-none">
                        <span id="current_question">1</span>/<span id="total_ques"></span>
                    </div>
                    <div class="question-wrapper">
                        <?php
                        $count = 0;
                        while ($row = $questions_and_answers->fetch_assoc()) {
                            $count = $count + 1;
                        ?>
                            <div class="question-item <?php echo ($count !== 1) ? 'd-none' : ''; ?>" data-queCount="<?php echo $count; ?>" data-questionid="<?php echo $row['Question_ID'] ?>">
                                <div class="question">
                                    <h2>
                                        <?php echo $row['Question']; ?>
                                    </h2>
                                </div>
                                <div class="options-wrapper">
                                    <div class="row">
                                        <?php
                                        $options = $row['Options'];
                                        $options_array = explode(',', $options);
                                        $option_count = 0;
                                        foreach ($options_array as $option) {
                                            if (!empty($option)) {
                                        ?> <div class="col-sm-12 col-md-12 col-lg-6">
                                                    <div class="option_value" data-optCount="<?php echo $option_count = $option_count + 1 ?>">
                                                        <div class="option_value_inner">
                                                            <div class="checkbox-container">
                                                                <span><?php echo chr(65 + $option_count - 1); ?>. </span>
                                                                <input class="form-check-input mx-0 my-0 checkbox" type="checkbox" name="question_<?php echo $count; ?>" id="<?php echo $option; ?>" value="<?php echo $option; ?>" data-value="<?php echo chr(65 + $option_count - 1); ?>" <?php echo ($option_count === 1) ? 'required' : ''; ?>>
                                                            </div>
                                                            <label class="checkbox-label" for="<?php echo $option; ?>"><?php echo $option ?></label>
                                                        </div>
                                                    </div>
                                                </div>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                    <div class="buttons_wrap">
                        <div class="quiz-submit">
                            <button class="btn btn-primary submit_btn">Submit</button>
                        </div>
                    </div>
            <?php
        }
    }
            ?>
            <div class="quiz-footer">
                <div class="py-2">
                    <div class="quiz-jesus-img">
                        <img src="<?php echo ASSETS_URL ?>images/jesus.png" alt="" class="img-fluid">
                    </div>
                </div>
                <div class="duk-website row">
                    <a href="www.divineuk.org">www.divineuk.org</a>
                </div>
            </div>
                </div>
</div>
</form>


<script>
    let checkbox = document.querySelectorAll('.checkbox');
    for (let index = 0; index < checkbox.length; index++) {
        const element = checkbox[index];

        element.addEventListener('change', function() {
        if (element.checked) {
            let closest_container=element.parentNode;
            let target_label=closest_container.querySelector('.checkbox-label');
            console.log(target_label);
            element.style.backgroundColor = 'red'; // Change to your desired background color
        } else {
            element.style.backgroundColor = ''; // Reset the background color
        }
    });
        
    }

  
</script>