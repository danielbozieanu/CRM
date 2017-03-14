<div class="form-group">
    <div class="row">
        <div class="col-xs-12">
            <label for="">Select agency</label>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-10">
            <select name="" id="agencySelect" class="form-control">
                <option value="">--- select agency ---</option>
                <?php foreach ($agencies as $agency): ?>
                    <option value="<?php echo $agency['id']; ?>"><?php echo $agency['agency_name'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="col-xs-12 col-sm-2">
            <button id="filterButton" class="btn">Filter</button>
        </div>
    </div>
</div>

<section class="content">
    <div id="reports-wrapper" class="row">
        <div class="alert alert-info alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-info"></i> Alert!</h4>
            The agency was not selected or there is no data to display.
        </div>
    </div>
</section>

<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery-2.2.3.min.js"></script>

<script>

    $('#filterButton').click(function (e) {


        var reports = [];

        $('#reports-wrapper').empty();

        $.ajax({
            type: 'POST',
            url: '/reports/get_agency_data/' + $('#agencySelect').val(),
            error: function () {
                $('#reports-wrapper').empty();

                var errorHtml = '';

                errorHtml +=  '<div class="alert alert-warning alert-dismissible">';
                errorHtml += '<button type="button" class="close" data-dismiss="warning" aria-hidden="true">×</button>';
                errorHtml += '<h4><i class="icon fa fa-info"></i> Alert!</h4>';
                errorHtml += 'There is no data to display!';
                errorHtml += '</div>';

                $('#reports-wrapper').append(errorHtml);
            },
            success: function (data) {

                for (var i = 0; i < data.length; i++) {
                    reports.push({
                        answer_value: data[i].answer_value,
                        question_label: data[i].question_label,
                        score: data[i].score.slice(data[i].answer_value.length, data[i].score.length - data[i].answer_value.length)
                    });
                }


                for (var i = 0; i < reports.length; i++) {

                    var htmlContent = '';

                    htmlContent += '<div class="col-xs-4">';
                    htmlContent += '<div class="box box-primary">';
                    htmlContent += '<div class="box-header with-border">';
                    htmlContent += '<h3 class="box-title" style="font-size: 14px; width: 90%">' + (i + 1) + '.' + reports[i].question_label + '</h3>';
                    htmlContent += '<div class="box-tools pull-right">';
                    htmlContent += '<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>';
                    htmlContent += '</div>';
                    htmlContent += '</div>';
                    htmlContent += '<div class="box-body">';
                    htmlContent += '<div class="chart">';
                    htmlContent += '<canvas id="myChart' + i + '" width="100" height="100" style="width:100px;"></canvas>';
                    htmlContent += '</div>';
                    htmlContent += '</div>';
                    htmlContent += '</div>';


                    //Append new chart
                    $('#reports-wrapper').append(htmlContent);

                    //Render chart
                    var ctx = document.getElementById("myChart" + i).getContext("2d");
                    var myBar = new Chart(ctx, {
                        type: 'pie',
                        data: {
                            labels: reports[i].answer_value,
                            datasets: [
                                {
                                    backgroundColor: ["#FF6384",
                                        "#36A2EB",
                                        "#FFCE56",
                                        "#743123",
                                        "#aba231",
                                        "#128a73",
                                        "#947321",
                                        "#bdef13"
                                    ],
                                    data: reports[i].score
                                }
                            ]
                        }
                    });
                }
            }
        });
    })


</script>



