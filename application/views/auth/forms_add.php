<?php if (!$all_done_projects): ?>
<div class="alert alert-warning alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4><i class="icon fa fa-check"></i>Alert!</h4>
    There are no done projects.
</div>

<?php else: ?>


<?php if (validation_errors()): ?>
<div class="callout callout-danger">
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

            <div class="form-group">
                <label for="form_project">Select project</label>
                <select required name="form_project" class="form-control">
                        <option value="">--- SELECT PROJECT ---</option>
                        <?php
                        if ($all_done_projects)
                            foreach($all_done_projects as $project)
                            {
                                if ( $project['project_status'] == 1 ){
                                    $selected = ($project['project_id'] == $this->input->post('form_project')) ? ' selected="selected"' : null;
                                    echo '<option value="'.$project['project_id'].'" '.$selected.'>'.$project['project_name'].'</option>';
                                }

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
            <div id="app">
                <div v-for="(question, index) in questions">
                    <div class="row">
                        <div class="col-xs-12 col-sm-6">
                            <div class="form-group">
                                <label for="question1">Question</label>
                                <input type="text" placeholder="Question" class="form-control req" name="question[]" v-bind:id="question.id" >
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <div class="form-group">
                                <label for="question_type">Question Type</label>
                                <select required v-model="question.type" name="qType[]" class="form-control">
                                    <option value="">--- question type ---</option>
                                    <option value="radio">Single choice</option>
                                    <option value="checkbox">Multiple choices</option>
                                    <option value="textarea">Text</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                    <input v-for="(answer, index) in question.answers" type="text" placeholder="Answer" class="form-control" name="answers[]" >
                    <input v-for="(answer, index) in question.answers" type="hidden" placeholder="Qid" class="form-control" name="qid[]" v-bind:value="question.id">
                    </div>
                    <button v-show="question.type!='textarea'&&question.type!=''"  v-on:click="addAnswer(question)" type="button" class="btn btn-app">
                        <i class="fa fa-plus"></i>
                        Add Answer
                    </button>

            </div>

                <button v-on:click="addQuestion" type="button" class="btn btn-app">
                    Add question
                </button>

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
            qCounter: 0,
            questionType: ''
        },
        methods: {
            addQuestion: function (event) {

                this.questions.push({id: this.qCounter, name: "Question" ,answers: [], type: ''});
                this.qCounter += 1;

            },
            addAnswer: function(question) {

                this.questions.find(function(item, index) {
                    if(item.id === question.id) {
                        item.answers.push({name: ""});
                        return true;
                    }
                    return false;
                })
            },

        }
    })
</script>

<?php endif; ?>
