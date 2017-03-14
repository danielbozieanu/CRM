<br>
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-12">
            <div class="text-center" style="margin-top: 20px; margin-bottom: 20px;">
                <img src="<?php echo base_url(); ?>assets/img/low-logo.png" alt="">
                <h6 style="color: black; margin-top: 5px;">customer satisfaction survey</h6>
            </div>
        </div>
    </div>
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">
                Feedback form
            </h3>
        </div>

        <?php echo validation_errors(); ?>
        <?php echo form_open('feedback/send/', 'id="feedback-form"'); ?>

        <div class="box-body">


            <input type="hidden" name="project_id" value="<?php echo $project['project_id']; ?>">
            <input type="hidden" name="form_slug" value="<?php echo $project['form_slug']; ?>">


            <div class="form-group">
                <label for="form_project" class="control-label">Project name:</label>
                <select disabled name="form_project" class="form-control">
                    <option value=""><?php echo $project['project_name']; ?></option>
                </select>
            </div>

            <div class="form-group">
                <label for="project_account" class="control-label">Account:</label>
                <input class="form-control" type="text" disabled
                       value="<?php echo $this->ion_auth->user($project['project_client'])->row()->first_name . ' ' . $this->ion_auth->user($project['project_client'])->row()->last_name; ?>">
            </div>

            <div class="form-group">
                <label for="project_account" class="control-label">Developer:</label>
                <input class="form-control" type="text" disabled
                       value="<?php echo $this->ion_auth->user($developer->id_user)->row()->first_name . ' ' . $this->ion_auth->user($developer->id_user)->row()->last_name; ?>">
            </div>

            <div class="row">
                <div class="col-xs-12 col-sm-6">
                    <div class="form-group">
                        <label for="project_start_date" class="control-label">Project start date:</label>
                        <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input disabled="" id="datepicker" name="project_start_date" type="text"
                                   class="form-control pull-right" value="<?php echo $project['project_created'] ?>">

                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6">
                    <div class="form-group">
                        <label for="project_start_date" class="control-label">Finish date:</label>
                        <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input disabled="" id="datepicker" name="project_start_date" type="text"
                                   class="form-control pull-right" value="<?php echo $project['project_finished'] ?>">

                        </div>
                    </div>
                </div>
            </div>

            <?php foreach ($all_project_questions as $key => $question): ?>
                <div class="form-group">
                    <h4 class="box-title"><span><?php echo $key + 1; ?>
                            .</span><?php echo $question['question_label']; ?></h4>
                    <input type="hidden" name="qId[]" value="<?php echo $question['id']; ?>">
                </div>
                <?php if ($question['question_type'] == 'textarea'): ?>
                    <?php $textareas++; ?>
                    <input type="hidden" name="textareasQid[]" value="<?php echo $question['id']; ?>">
                    <textarea rows="4" class="form-control" required name="textAreas[]" id=""
                              placeholder="Please type your answer here..."></textarea>
                <?php endif; ?>

                <?php if ($question['question_type'] == 'radio') {
                    $radioAns++;
                } ?>
                <div class="form-group">
                    <div class="row">
                    <?php foreach ($all_answers as $answer) : ?>
                        <?php if ($question['id'] == $answer['answer_question']) : ?>


                            <?php if ($question['question_type'] == 'radio') : ?>

                               <div class="col-xs-12 col-sm-4">
                                   <input required type="<?php echo $question['question_type']; ?>"
                                          name="radios<?php echo $radioAns; ?>[]" value="<?php echo $answer['id'] ?>"
                                          class="flat-red" id="answer<?php echo $answer['id'] ?>">

                                <input type="hidden" name="ansId[]" value="<?php echo $answer['answer_answer']; ?>">

                            <?php elseif ($question['question_type'] == 'checkbox'): ?>
                                <input type="hidden" name="<?php echo $question['id'] ?>">

                               <div class="col-xs-12 col-sm-4">
                                <input required type="<?php echo $question['question_type']; ?>" name="checked[]"
                                       value="<?php echo $answer['id'] ?>" class="flat-red"
                                       id="answer<?php echo $answer['id'] ?>">

                                <input type="hidden" name="ansId[]" value="<?php echo $answer['answer_answer']; ?>">


                            <?php endif; ?>
                            <label for="answer<?php echo $answer['id'] ?>"
                                   class="ansText"><?php echo $answer['answer_value']; ?></label>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            <?php endforeach; ?>

            <input type="hidden" name="radiosCount" value="<?php echo $radioAns; ?>">
            <input type="hidden" name="minAnswers" value="<?php echo count($all_project_questions) - $radioAns; ?>">

            <div class="form-group">
                <br>
                <button type="submit" class="btn btn-success">Send</button>
            </div>
        </div>

                </div>
    </div>
    <?php echo form_close(); ?>
</div>

</div>


