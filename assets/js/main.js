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

// Reports list
var rData = {
    questions: []
}
Vue.component('reports-list', {
    template: `
        <div>
        <report v-for="question of questions" :report="question"></report>
</div>
    `,
    data: function() {
        return rData;
    },
    beforeMount: function () {
        axios.get('/crm/reports/get_data', { headers: { 'Content-Type': 'application/json' } })
            .then((res) => this.questions = res.data)
    }
});

// Report
Vue.component('report', {
    props: ['report'],
    template: `
<div class="row">
    <div class="col-md-6">
        <!--<canvas id="myChart" width="400" height="400"></canvas>-->
    </div>
</div>
    `
});

// App bootstrap
new Vue({
    el: '#app'
});


