<br>
<div class="container">
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">
                Feedback survey
            </h3>
        </div>

        <?php echo validation_errors(); ?>
        <?php echo form_open('feedback/send/','id="feedbackForm"'); ?>

        <div class="box-body">

            <div class="form-group">
                <label for="form_name" class="control-label">Form Name</label>
                <input type="hidden" name="form_id" value="<?php echo $form['form_id']; ?>">
                <input type="hidden" name="form_slug" value="<?php echo $form['form_slug']; ?>">

                <input disabled type="text" name="form_name" class="form-control" value="<?php echo ($this->input->post('form_name') ? $this->input->post('form_name') : $form['form_name']); ?>">
            </div>

            <div class="form-group">
                <label for="form_project" class="control-label">Project</label>
                <select disabled name="form_project" class="form-control">
                    <?php
                    foreach($all_projects as $project)
                    {
                        if ( $form['form_project'] == $project['project_id']) {
                            $selected = ($project['project_id'] == $form['form_project']) ? ' selected="selected"' : null;

                            echo '<option value="' . $project['project_id'] . '" ' . $selected . '>' . $project['project_name'] . '</option>';
                        }
                    }
                    ?>
                </select>
            </div>

            <?php foreach ($all_questions as $key => $question): ?>
                        <div class="form-group">
                            <h2 class="box-title"><?php echo $question['question_label']; ?></h2>
                            <input type="hidden" name="qId[]" value="<?php echo $question['question_id']; ?>">
                        </div>
                <?php if ($question['question_type']=='radio') {  $radioAns++; } ?>
                <div class="form-group">
                <?php foreach($all_answers as $answer) : ?>
                    <?php if ($question['question_id'] == $answer['ans_question']) : ?>
                        <div class="<?php echo $question['question_type']; ?>">
<!--                            <input type="hidden" name="ansId[]" value="--><?php //echo $answer['ans_id']; ?><!--">-->
                            <label>
                                <?php if ( $question['question_type'] == 'radio' ) : ?>
                                <input type="<?php echo $question['question_type']; ?>" name="radios<?php echo $radioAns; ?>[]" value="<?php echo $answer['ans_id'] ?>">
                                <?php else: ?>
                                    <input type="hidden" name="<?php echo $question['question_id'] ?>">
                                <input type="<?php echo $question['question_type']; ?>" name="checked[]" value="<?php echo $answer['ans_id'] ?>">
                                <?php endif; ?>
                                <?php echo $answer['ans_value']; ?>
                            </label>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
                </div>
            <?php endforeach; ?>

            <input type="hidden" name="radiosCount" value="<?php echo $radioAns; ?>">
            <input type="hidden" name="minAnswers" value="<?php echo count($all_questions)-$radioAns; ?>">

            <div class="form-group">
                <button type="submit" class="btn btn-success">Save</button>
            </div>
        </div>


    </div>
    <?php echo form_close(); ?>
</div>

</div>


