<?php

if (!array_key_exists('level', $_GET) || !array_key_exists('HTTP_REFERER', $_SERVER)) {
    require_once ROOT_PATH_QUIZ . 'select-level.php';
} else {
    $level = (int)$_GET['level'];
    $questions_and_answers = $quiz->get_questions_by_level($level);
}
//main
if ($questions_and_answers->num_rows > 0) {
?>
    <div class="question-wrapper">
        <?php
        $count = 0;
        while ($row = $questions_and_answers->fetch_assoc()) {
           ?>
           <div class="question-item" data-queCount="<?php echo $count = $count +1 ?>" >
                <div class="question">
                    <h2>
                        <?php echo  $row['Question'];?>
                    </h2>
                </div>
                <div class="options-wrapper">
                    <?php 
                    $options = $row['Options'];
                    $options_array = explode(',',$options);
                    $option_count = 0 ;
                    foreach($options_array as $option){
                        ?>
                        <div class="" data-optCount = "<?php echo $option_count = $option_count + 1 ?>">
                            <div>
                                <span><?php echo  chr(65 + $option_count); ?>. </span>
                                <input type="radio" name="" id="<?php echo $option;?>" value="<?php echo $option; ?>">
                                <label for="<?php echo $option;?>"><?php echo $option ?></label>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
           </div>
           <?php
        }
        ?>
    </div>
<?php
}
