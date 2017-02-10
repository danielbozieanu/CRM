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

        <div class="row">
            <div class="col-xs-12 col-sm-12">
                <div class="form-group">
                    <label for="nume">Account:</label>
                    <select disabled name="client" class="form-control">
                        <option><?php echo $this->ion_auth->user($projects['project_client'])->row()->first_name.' '.$this->ion_auth->user($projects['project_client'])->row()->last_name; ?></option>
                    </select>
                </div>
            </div>

            <div class="col-xs-12 col-sm-6">
                <div class="form-group">
                    <label for="project_account_phone">Phone:</label>
                    <input disabled id="project_account_phone" name="project_account_phone" class="form-control" value="<?php echo $this->ion_auth->user($projects['project_client'])->row()->phone; ?>">
                </div>
            </div>
            <div class="col-xs-12 col-sm-6">
                <div class="form-group">
                    <label for="project_account_email">Email:</label>
                    <input disabled id="project_account_email" name="project_account_email" class="form-control" value="<?php echo $this->ion_auth->user($projects['project_client'])->row()->email; ?>">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12 col-sm-6">
                <div class="form-group">
                    <label for="nume">Agency:</label>
                    <select disabled name="client" class="form-control">
                        <option><?php echo $this->ion_auth->user($projects['project_client'])->row()->company; ?></option>
                    </select>
                </div>
            </div>

            <div class="col-xs-12 col-sm-6">
                <div class="form-group">
                    <label for="project_final_client">Final client:</label>
                    <input id="project_final_client" name="project_final_client" class="form-control" value="<?php echo ($this->input->post('project_final_client') ? $this->input->post('project_final_client') : $projects['project_final_client']); ?>">
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="status">Developer:</label>

                <?php $userAsDeveloper = $this->ion_auth->user($developersToProject[0]['id_user'])->row(); ?>
                <input disabled class="form-control" type="text" value="<?php echo $userAsDeveloper->first_name; ?>">

        </div>

        <div class="row">
            <div class="col-xs-12 col-sm-6">
                <div class="form-group">
                    <label for="datepicker">Project start date:</label>
                    <div class="input-group date">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input id="datepicker" name="project_start_date" type="text" class="form-control pull-right" name="project_start_date" value="<?php echo ($this->input->post('project_start_date') ? $this->input->post('project_start_date') : $projects['project_created']); ?>"/>

                    </div>
                </div>
            </div>

            <div class="col-xs-12 col-sm-6">
                <div class="form-group">
                    <label for="project_estimation">Working days estimation:</label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="project_estimation" id="project_estimation" value="<?php echo ($this->input->post('project_estimation') ? $this->input->post('project_estimation') : $projects['project_estimate']); ?>">
                        <span class="input-group-addon">days</span>
                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-xs-12 col-sm-6">
                <div class="form-group">
                    <label for="project_value">Project Value:</label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="project_value" id="project_value" value="<?php echo ($this->input->post('project_value') ? $this->input->post('project_value') : $projects['project_value']); ?>">
                        <span class="input-group-addon"><i class="fa fa-euro"></i></span>
                    </div>
                </div>
            </div>

            <div class="col-xs-12 col-sm-6">
                <div class="form-group">
                    <label for="project_costs">Project Costs:</label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="project_costs" id="project_costs" value="<?php echo ($this->input->post('project_costs') ? $this->input->post('project_costs') : $projects['project_costs']); ?>">
                        <span class="input-group-addon"><i class="fa fa-euro"></i></span>
                    </div>
                </div>
            </div>
        </div>

        <?php if ($this->ion_auth->is_admin()): ?>

            <div class="form-group">
                <label for="status">Status:</label>
                <select name="status" class="form-control" >
                    <?php if ( $projects['project_status'] == 0 ): ?>
                        <option value="0">Pending</option>
                        <option value="1">Done</option>
                        <option value="-1">Canceled</option>
                    <?php elseif ( $projects['project_status'] == 1 ) : ?>
                        <option value="1">Done</option>
                        <option value="0">Pending</option>
                        <option value="-1">Canceled</option>
                    <?php else: ?>
                        <option value="-1">Canceled</option>
                        <option value="0">Pending</option>
                        <option value="1">Done</option>
                    <?php endif; ?>
                </select>
            </div>

        <?php endif; ?>

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

                <div class="form-group">
                    <label for="">Form url:</label>
                    <input class="form-control" type="text" value="<?php echo base_url().'feedback/'.$form['form_slug']; ?>" disabled>
                </div>

                </div>
                <?php foreach ($all_questions as $key => $question): ?>
                    <div class="box-group" id="accordion">
                        <div class="panel box box-primary">
                            <div class="box-header with-border">
                                <div class="col-xs-12 col-sm-6">
                                    <div class="form-group">
                                        <label for="question">
                                            <h4 class="box-title">
                                                <a href="#collapse<?php echo $key ?>" data-toggle="collapse" data-parent="#accordion">
                                                    <?php echo ($key+1).'.'.$question['question_label']; ?>
                                                </a>
                                            </h4>
                                        </label>
                                        <input disabled type="hidden" class="form-control" value="<?php echo $question['question_label']; ?>">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6">
                                    <div class="form-group">
                                        <label for="question">Question <?php echo $key+1; ?> type</label>

                                            <?php if( $question['question_type'] == 'radio' ) : ?>
                                                <span>Single choice</span>
                                            <?php elseif( $question['question_type'] == 'checkbox' ) : ?>
                                                <span>Multiple choices</span>
                                            <?php elseif( $question['question_type'] == 'textarea' ) : ?>
                                                <span>Text</span>
                                            <?php endif; ?>

                                    </div>
                                </div>
                            </div>
                        </div>

                    <div id="collapse<?php echo $key; ?>" class="panel-collapse collapse" aria-expanded="true">
                        <div class="box-body">
                            <div class="form-group">
                                <p>Answers</p>
                                <?php foreach($all_answers as $answer) : ?>
                                    <?php if ($question['question_id'] == $answer['ans_question']) : ?>
                                       <?php if($question['question_type'] == 'textarea'): ?>
                                        <blockquote>
                                            <p>
                                                <?php echo $answer['ans_value']; ?>
                                            </p>
                                        </blockquote>

                                        <?php else: ?>
                                            <label>
                                                <input disabled type="<?php echo $question['question_type']; ?>" <?php echo ($answer['ans_selected'] ? 'checked' :  ''); ?> >
                                                <?php echo $answer['ans_value']; ?>
                                            </label>
                                        <?php endif; ?>
                                        <br>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php elseif ($projects['project_status'] == 1):?>
                <div class="alert alert-warning alert-dismissible" style="margin-top:20px;">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-warning"></i> Alert!</h4>
                    Project done, but no form was generated.
                    <a href="<?php echo base_url().'form/add'; ?>">Do it now!</a>
                </div>
            <?php endif; ?>
        </div>

    </div>
</div>


