<?php echo validation_errors(); ?>
<div class="box box-warning">
    <div class="box-header with-border">
        <h2>View/edit project</h2>
    </div>

    <div class="box-body">
        <?php echo form_open('projects/edit/'.$projects['project_id']); ?>
        <div class="form-group">
            <label for="nume">Project name:</label>
            <input name="nume" class="form-control" value="<?php echo ($this->input->post('nume') ? $this->input->post('nume') : $projects['project_name']); ?>">
        </div>

        <div class="form-group">
            <label for="nume">Client:</label>
            <select disabled name="client" class="form-control">
                <option><?php echo ($this->input->post('project_client') ? $this->input->post('project_client') : $this->ion_auth->user($projects['project_client']))->row()->first_name;  ?></option>
            </select>
        </div>

        <?php if ($this->ion_auth->is_admin()): ?>

            <div class="form-group">
                <label for="status">Status</label>
                <select name="status" class="form-control" >
                    <?php if ( $projects['project_status'] == 0 ) : ?>
                        <option value="0">In work</option>
                        <option value="1">Done</option>
                    <?php else: ?>
                        <option value="1">Done</option>
                        <option value="0">In work</option>
                    <?php endif; ?>
                </select>
            </div>

        <?php endif; ?>

        <div class="form-group">
            <label for="status">Developers team:</label>
            <ol>
                <?php foreach($developersToProject as $developer): ?>
                    <?php $userAsDeveloper = $this->ion_auth->user($developer->id_user)->row(); ?>
                    <li>
                        <?php echo $userAsDeveloper->first_name; ?>
                    </li>
                <?php endforeach; ?>
            </ol>
        </div>

        <?php if ($this->ion_auth->is_admin()): ?>
            <div class="form-group">
                <button class="btn btn-success" type="submit">Save</button>
            </div>
        <?php endif; ?>

        <?php echo form_close(); ?>

        <div class="project-form">

            <?php if ( $form && $projects['project_status'] == 1) : ?>
                <div class="box-header with-border">
                    <h1 class="box-title">Form assigned to this project</h1>
                </div>
                <?php foreach ($all_questions as $key => $question): ?>
                    <div class="row">
                        <div class="col-xs-12 col-sm-6">
                            <div class="form-group">
                                <label for="question">Question <?php echo $key+1; ?></label>
                                <input disabled type="text" class="form-control" value="<?php echo $question['question_label']; ?>">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <div class="form-group">
                                <label for="question">Question <?php echo $key+1; ?> type</label>
                                <select disabled name="qType[]" id="" class="form-control">
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
                    <div class="form-group">
                    <p>Answers</p>
                    <?php foreach($all_answers as $answer) : ?>
                        <?php if ($question['question_id'] == $answer['ans_question']) : ?>
                            <label>
                                <input disabled type="<?php echo $question['question_type']; ?>" <?php echo ($answer['ans_selected'] ? 'checked' :  ''); ?> >
                                <?php echo $answer['ans_value']; ?>
                            </label>
                            <br>
                        <?php endif; ?>
                    <?php endforeach; ?>
                    </div>
                <?php endforeach; ?>
            <?php elseif ($projects['project_status'] == 1):?>
                <div class="alert alert-warning alert-dismissible" style="margin-top:20px;">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-warning"></i> Alert!</h4>
                    Project done, but no form was generated.
                    <a href="">Do it now!</a>
                </div>
            <?php endif; ?>
        </div>

    </div>
</div>
