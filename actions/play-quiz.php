<?php
require_once dirname(__FILE__, 2) . '/config.php';
require_once ROOT_PATH_CLASS . 'class.quiz.php';
if (isset($_POST)) {
    if (isset($_POST['question_id']) && isset($_POST['selected_option'])) {
        $question_id = $_POST['question_id'];
        $selected_option = $_POST['selected_option'];
        $response_array = array();
        $quiz = new Quiz();
        $correction = $quiz->check_answer_is_correct($question_id, $selected_option);
        if ($correction !== true) {
            $response_array['correct_ans'] = false;
            $response_array['correction'] = $correction;
        } else {
            $response_array['correct_ans'] = true;
        }
        echo json_encode($response_array);
    }
}
