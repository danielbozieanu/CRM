<div class="box box-info">
    <div class="box-header with-border">
        <h3 class="box-title">
            Edit form
        </h3>
    </div>

    <?php echo validation_errors(); ?>
    <?php echo form_open('form/edit/'.$form['form_id'],['id'=>'form']); ?>

    <div class="box-body">

        <div class="form-group">
            <label for="form_name" class="control-label">Form Name</label>
            <input type="text" name="form_name" class="form-control" value="<?php echo ($this->input->post('form_name') ? $this->input->post('form_name') : $form['form_name']); ?>">
        </div>

        <div class="form-group">
            <label for="form_created" class="control-label">Form Created</label>
                <input type="text" name="form_created" value="<?php echo ($this->input->post('form_created') ? $this->input->post('form_created') : $form['form_created']); ?>" class="form-control" id="form_created" />
        </div>

        <?php if (!$form['form_status']) : ?>

        <?php foreach ($all_questions as $key => $question): ?>
        <div class="row">
            <div class="col-xs-12 col-sm-7">
                <div class="form-group">
                    <label for="question">Question <?php echo $key+1; ?></label>
                    <input type="hidden" name="qId[]" value="<?php echo $question['question_id']; ?>">
                    <input type="text" name="question[]" class="array form-control" value="<?php echo $question['question_label']; ?>">
                </div>
            </div>
            <div class="col-xs-12 col-sm-3">
                <div class="form-group">
                    <label for="question">Question <?php echo $key+1; ?> type</label>
                    <input type="hidden" name="qIdType[]" value="<?php echo $question['question_id']; ?>">
                    <select name="qType[]" id="" class="form-control">
                        <?php if( $question['question_type'] == 'radio' ) : ?>
                            <option value="radio">Single choice</option>
                            <option value="checkbox">Multiple choices</option>
                            <option value="textarea">Text</option>
                        <?php elseif ( $question['question_type'] == 'checkbox' ) : ?>
                            <option value="checkbox">Multiple choices</option>
                            <option value="radio">Single choice</option>
                            <option value="textarea">Text</option>
                        <?php else: ?>
                            <option value="textarea">Text</option>
                            <option value="checkbox">Multiple choices</option>
                            <option value="radio">Single choice</option>
                        <?php endif; ?>
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-2">
                <?php  echo anchor('#', 'Delete question', 'data-toggle="modal" data-target="#myModal" class="btn btn-danger" onclick="confirm_modal(\''.site_url('form/delete_question/'.$question['question_id'].'\',\'You want to delete question?\',\'Yes, delete question\',\'modal-danger\')" style="margin-top: 25px;"')) ?>
            </div>
        </div>


            <?php foreach($all_answers as $answer) : ?>
                <?php if ($question['question_id'] == $answer['ans_question']) : ?>
                    <div class="row">
                        <div class="col-xs-10">
                            <div class="form-group">
                                <label for="">Answer</label>
                                <input type="hidden" name="qIdAns[]" value="<?php echo $question['question_id']; ?>">
                                <input type="hidden" name="ansId[]" value="<?php echo $answer['ans_id']; ?>">
                                <input type="text" class="array form-control" name="answers[]" value="<?php echo $answer['ans_value']; ?>">
                            </div>
                        </div>

                        <div class="col-xs-2">
                            <?php  echo anchor('#', 'Delete answer', 'style="margin-top: 24px;"data-toggle="modal" data-target="#myModal" class="btn btn-warning" onclick="confirm_modal(\''.site_url('form/delete_answer/'.$answer['ans_id'].'/'.$question['question_id'].'\',\'You want to delete the answer?\',\'Yes, delete answer.\',\'modal-danger\')"')) ?>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
                <hr>
        <?php endforeach; ?>
        <?php else: ?>
            <div class="alert alert-info alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-info"></i> Alert!</h4>
                The form was sent, you cannot edit questions/answers anymore.
            </div>
        <?php endif; ?>


        <div class="form-group" style="clear:both;">
            <hr>
            <h4>Add new questions:</h4>
            <div id="app">
                <questions-list></questions-list>
            </div>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-success pull-left">Save</button>
            <a href=".." type="submit" class="btn btn-primary pull-right">Cancel</a>
        </div>
    </div>

</div>
    <?php echo form_close(); ?>
    </div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.0.3/vue.js"></script>

<script>
    // Question list component
    var lData = {
        qCounter: 0,
        questions: []
    }

    Vue.component('questions-list', {
        template: `
    <div>
      <question v-for="question in questions" :question="question" v-on:deleteQuestion="removeQuestion($event)"></question>
      <button type="button" class="btn btn-primary" v-on:click="addQuestion">Add question</button>
      <br>
      <br>
    </div>
  `,
        data: function() {
            return lData;
        },
        methods: {
            addQuestion: function() {
                this.questions.push({id: this.qCounter++, text: '', type: '', answers: []})
            },
            removeQuestion: function(question) {
                var questions = this.questions;
                questions.find(function(value, index) {
                    if(value.id == question.id) {
                        questions.splice(index, 1);
                        return true;
                    }
                    return false;
                })
            }
        }
    });

    // Question component
    var qData = {
        aCounter: 0
    }

    Vue.component('question', {
        props: ['question'],
        data: function() {
            return qData;
        },
        template: `
    <div class="form-group well">
        <h5>Question</h5>
        <div class="row">

          <div class="col-xs-6">
            <input name="newQuestion[]" type="text" class="form-control" placeholder="Question" v-model="question.text">
          </div>

          <div class="col-xs-4">
            <select name="newqType[]" class="form-control" v-model="question.type">
              <option value="">--- question type ---</option>
              <option value="radio">Single</option>
              <option value="checkbox">Multiple</option>
              <option value="textarea">Text</option>
            </select>
          </div>

          <div class="col-xs-2">
            <button type="button" class="btn btn-danger btn-block" v-on:click="deleteQuestion">Delete</button>
          </div>

        </div>


        <br>
            <div class="row">
                <div class="col-xs-2" v-if="question.type !== 'textarea'&&question.type !== ''">
                    <button type="button" class="btn btn-warning btn-block" v-on:click="addAnswer">Add answer</button>
                </div>
            </div>


        <h5 v-if="question.answers.length > 0">Answers</h5>
        <answer v-for="answer in question.answers" :answer="answer" :qId="question.id" v-on:deleteAnswer="removeAnswer($event)"></answer>
      </div>
  `,
        methods: {
            addAnswer: function() {
                this.question.answers.push({ id: this.aCounter++, text: '' });
            },
            removeAnswer: function(event) {
                var answers = this.question.answers;
                answers.find(function(value, index) {
                    if(value.id == event.id) {
                        answers.splice(index, 1);
                        return true;
                    }
                    return false;
                })
            },
            deleteQuestion: function() {
                this.$emit('deleteQuestion', this.question);
            }
        }
    });

    // Answer component
    Vue.component('answer', {
        props: ['answer', 'qId'],
        template: `
    <div class="form-group answer">
      <div class="row">
        <div class="col-xs-10">
          <input name="newAnswers[]" type="text" class="form-control" v-model="answer.text">
          <input  type="hidden" placeholder="Qid" class="form-control" name="newqid[]" v-bind:value="qId">
        </div>
        <div class="col-xs-2">
          <button type="button" class="btn btn-danger btn-block" v-on:click="removeAnswer">Remove answer</button>
        </div>
      </div>
    </div>
  `,
        methods: {
            removeAnswer: function() {
                this.$emit('deleteAnswer', this.answer);
            }
        }
    });

    // App bootstrap
    new Vue({
        el: '#app'
    });
</script>


<?php $this->load->view('templates/_parts/alert_modal'); ?>
