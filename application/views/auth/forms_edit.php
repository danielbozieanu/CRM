<div class="box box-info">
    <div class="box-header with-border">
        <h3 class="box-title">
            Edit form
        </h3>
    </div>

    <?php echo validation_errors(); ?>
    <?php echo form_open('form/edit/'.$form['form_id']); ?>

    <div class="box-body">

        <div class="form-group">
            <label for="form_name" class="control-label">Form Name</label>
            <input type="text" name="form_name" class="form-control" value="<?php echo ($this->input->post('form_name') ? $this->input->post('form_name') : $form['form_name']); ?>">
        </div>

        <div class="form-group">
            <label for="form_project" class="control-label">Form Project</label>
                <select disabled name="form_project" class="form-control">
                    <?php
                    foreach($all_done_projects as $project)
                    {
                        if ( $form['form_project'] == $project['project_id']) {
                            $selected = ($project['project_id'] == $form['form_project']) ? ' selected="selected"' : null;

                            echo '<option value="' . $project['project_id'] . '" ' . $selected . '>' . $project['project_name'] . '</option>';
                        }
                    }
                    ?>
                </select>
        </div>
        <div class="form-group">
            <label for="form_created" class="control-label">Form Created</label>
                <input type="text" name="form_created" value="<?php echo ($this->input->post('form_created') ? $this->input->post('form_created') : $form['form_created']); ?>" class="form-control" id="form_created" />
        </div>

        <?php if (!$form['form_status']) : ?>

        <?php foreach ($all_questions as $key => $question): ?>
        <div class="row">
            <div class="col-xs-12 col-sm-6">
                <div class="form-group">
                    <label for="question">Question <?php echo $key+1; ?></label>
                    <input type="hidden" name="qId[]" value="<?php echo $question['question_id']; ?>">
                    <input type="text" name="question[]" class="form-control" value="<?php echo $question['question_label']; ?>">
                </div>
            </div>
            <div class="col-xs-12 col-sm-6">
                <div class="form-group">
                    <label for="question">Question <?php echo $key+1; ?> type</label>
                    <input type="hidden" name="qIdType[]" value="<?php echo $question['question_id']; ?>">
                    <select name="qType[]" id="" class="form-control">
                        <?php if( $question['question_type'] == 'radio' ) : ?>
                            <option value="radio">Single choice</option>
                            <option value="checkbox">Multiple choices</option>
                            <option value="text">Text</option>
                        <?php elseif ( $question['question_type'] == 'checkbox' ) : ?>
                            <option value="checkbox">Multiple choices</option>
                            <option value="radio">Single choice</option>
                            <option value="text">Text</option>
                        <?php else: ?>
                            <option value="text">Text</option>
                            <option value="checkbox">Multiple choices</option>
                            <option value="radio">Single choice</option>
                        <?php endif; ?>
                    </select>
                </div>
            </div>
        </div>
            <?php foreach($all_answers as $answer) : ?>
                <?php if ($question['question_id'] == $answer['ans_question']) : ?>
                    <div class="form-group">
                    <label for="answer">Answer</label>
                    <input type="hidden" name="qIdAns[]" value="<?php echo $question['question_id']; ?>">
                    <input type="hidden" name="ansId[]" value="<?php echo $answer['ans_id']; ?>">
                    <input type="text" class="form-control" name="answers[]" value="<?php echo $answer['ans_value']; ?>">
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>

        <?php endforeach; ?>
        <?php else: ?>
            <div class="alert alert-info alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-info"></i> Alert!</h4>
                The form was sent, you cannot edit questions/answers anymore.
            </div>
        <?php endif; ?>

        <div class="form-group">
                <button type="submit" class="btn btn-success">Save</button>
        </div>
    </div>


</div>
    <?php echo form_close(); ?>
    </div>
