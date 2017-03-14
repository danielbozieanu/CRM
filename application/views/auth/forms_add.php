<?php if (validation_errors()): ?>
<div class="callout callout-danger" id="form-messages">
    <h3 style="margin-top: 0;">Pay attention!</h3>

    <h4>There are some errors:</h4>
    <p><?php echo validation_errors(); ?></p>

</div>
<?php endif; ?>

    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Add form</h3>
        </div>

        <!-- Form Begin -->
        <?php echo form_open('form/add', ['id'=>'form']); ?>

        <div class="box-body">

            <div class="form-group">
                <label for="form_name" class="control-label">Form Name</label>
                <input required type="text" name="form_name" class="form-control" id="form_name" value="<?php echo $this->input->post('form_name'); ?>">
            </div>

        </div>

            <div class="box-header">
                <h3 class="box-title">
                    Form questions
                </h3>
            </div>

        <div class="box-body">
            <div id="app">
                <questions-list></questions-list>
            </div>

            <div class="form-group">
                <button type="submit" id="submit" class="btn btn-success">Generate form</button>
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
      <question v-for="question in questions" :question="question" v-on:deleteQuestion="removeQuestion($event)" ></question>
      <button type="button" class="btn btn-primary" v-on:click="addQuestion">Add question</button>
      <br>
      <br>
    <pre>{{questions}}</pre>
    </div>
  `,
        data: function() {
            return lData;
        },
        methods: {
            addQuestion: function() {
                this.questions.push({id: this.qCounter++, text: '', type: '', count: 0, answers: []})
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
            <input name="question[]" type="text" class="form-control" placeholder="Question" v-model="question.text">
            <input name="qidScore[]" type="hidden" v-bind:value="question.id">
          </div>

          <div class="col-xs-4">
            <select required name="qType[]" class="form-control" v-model="question.type">
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


        <h5 v-if="question.answers.length > 0" class="col-xs-6">Answers</h5>
        <h5 v-if="question.answers.length > 0" class="col-xs-6">Scores</h5>
        <answer v-for="(answer, index) in question.answers" :answer="answer" :qId="question.id" :aCount="index" score="answer:aCounter" v-on:deleteAnswer="removeAnswer($event)"></answer>
      </div>
  `,
        methods: {
            addAnswer: function() {
                this.question.answers.push({ id: this.aCounter++, text: '' });
                this.question.count++;
            },
            removeAnswer: function(event) {
                var answers = this.question.answers;
                answers.find(function(value, index) {
                    if(value.id == event.id) {
                        answers.splice(index, 1);
                        return true;
                    }
                    return false;
                });
                this.question.count--;
            },
            deleteQuestion: function() {
                this.$emit('deleteQuestion', this.question);
            }
        }
    });

    // Answer component
    Vue.component('answer', {
        props: ['answer', 'qId', 'aCount'],
        template: `
    <div class="form-group answer">
      <div class="row">
        <div class="col-xs-6">
          <input name="answers[]" type="text" class="form-control" v-model="answer.text">
          <input  type="hidden" placeholder="Qid" class="form-control" name="qid[]" v-bind:value="qId">
          <input type="hidden" name="answersScore[]" v-bind:value="aCount">
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
