var addQuestion = document.getElementById('addQuestion');
var questionsWrapper = document.getElementById('questionsWrapper');


var questionsCounter = 0;
var inputHtml = '';
inputHtml += '<div class="form-group question">';
inputHtml += '<label for="question" class="control-label">Question</label>';
inputHtml += '<input type="text" name="question[]" class="form-control" placeholder="Question label">';
inputHtml += '<a class="btn btn-app">';
inputHtml += '<i class="fa fa-plus"></i>';
inputHtml += 'Add answer';
inputHtml += '</a>';
inputHtml += '</div>';

addQuestion.addEventListener('click', function () {

    var node = document.createElement("div");
    node.innerHTML = inputHtml;
    questionsWrapper.appendChild(node);

});

var questions = document.querySelector("#questionsWrapper").children;

for (var i = 0; i < questions.length; i++) {
    questions[i].children[3].addEventListener('click', function (e) {
        e.preventDefault();
        var inputHtml = '';
        inputHtml += '<div class="form-group question">';
        inputHtml += '<label for="question" class="control-label">Answer</label>';
        inputHtml += '<input type="text" name="question[]" class="form-control" placeholder="Answer">';
        inputHtml += '</div>';
        var qnode = document.createElement("div");
        qnode.innerHTML = inputHtml;
        this.parentNode.childNodes[5].appendChild(qnode);
    });
}

