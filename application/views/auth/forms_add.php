<?php echo validation_errors(); ?>


    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Add form</h3>
        </div>

        <!-- Form Begin -->
        <?php echo form_open('form/add'); ?>

        <div class="box-body">

            <div class="form-group">
                <label for="form_name" class="control-label">Form Name</label>
                <input type="text" name="form_name" class="form-control" id="form_name"><?php echo $this->input->post('form_name'); ?>
            </div>

            <div class="form-group">
                <label for="form_project">Select project</label>
                <select name="form_project" class="form-control">
                        <option value=""></option>
                        <?php
                        foreach($all_projects as $project)
                        {
                            $selected = ($project['project_id'] == $this->input->post('form_project')) ? ' selected="selected"' : null;

                            echo '<option value="'.$project['project_id'].'" '.$selected.'>'.$project['project_name'].'</option>';
                        }
                        ?>
                    </select>
            </div>
        </div>


            <div class="box-header">
                <h3 class="box-title">
                    Form questions
                </h3>
            </div>

        <div class="box-body">
            <div class="questions" id="questionsWrapper">

                <div id="app">
                    <div class="form-group" v-for="(question, index) in questions">
                        <label for="question1">Question</label>
                        <input type="text" placeholder="Question" class="form-control" name="question[]" v-bind:id="question.id" >
                        <select name="questiondNumber[]" id="">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                        </select>

                        <input v-for="(answer, index) in question.answers" type="text" placeholder="Answer" class="form-control" name="answers[]" >
                        <button v-on:click="addAnswer(question)" type="button" class="btn btn-app">
                            <i class="fa fa-plus"></i>
                            Add Answer
                        </button>
                    </div>

                    <button v-on:click="addQuestion" type="button" class="btn btn-app">
                        Add question
                    </button>

                </div>

            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-success">Generate form</button>
            </div>

        </div>

        <?php echo form_close(); ?>
    </div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.0.3/vue.js"></script>

<script id="jsbin-javascript">
    let app = new Vue({
        el: '#app',
        data: {
            questions: [],
            qCounter: 0
        },
        methods: {
            addQuestion: function (event) {
                console.log(this.qCounter);
                this.questions.push({id: this.qCounter, name: "Question", answers: []});
                this.qCounter += 1;

            },
            addAnswer: function(question) {
                console.log(question.id)
                this.questions.find(function(item, index) {
                    if(item.id === question.id) {
                        item.answers.push({name: ""});
                        return true;
                    }
                    return false;
                })
            }
        }
    })
</script>
