<ul class="nav nav-tabs">
    <li><?php echo anchor("reports/agency", 'By Agency'); ?></li>
    <li><?php echo anchor("reports/client", 'By Client'); ?></li>
    <li class="active"><?php echo anchor("reports/developer", 'By Developer'); ?></li>
    <li><?php echo anchor("reports/daterange", 'By Date Range'); ?></li>

</ul>
<br>
<div class="form-group">
    <div class="row">
        <div class="col-xs-12">
            <label for="">Select developer</label>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-4">
            <!--            <input type="text" name="" id="clientSelect" class="form-control" />-->
            <select name="" id="developerSelect" class="form-control">
                <option value="000">---</option>
                <?php foreach ($developers as $developer): ?>
                    <option value="<?php echo $developer['id']; ?>"><?php echo $developer['first_name'] . ' ' . $developer['last_name']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-xs-12 col-sm-4">
            <div class="input-group">
                <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                </div>
                <input type="text" class="form-control pull-right" id="daterangeSelect">
            </div>
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
            The developer was not selected.
        </div>
    </div>
</section>

<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery-2.2.3.min.js"></script>

<script>
    var availableTags = [];

    $('#filterButton').click(function (e) {


        var reports = [];

        $('#reports-wrapper').empty();

        $.ajax({
            type: 'POST',
            url: '/reports/get_developer_data/' + $('#developerSelect').val() + '/'  + $('#daterangeSelect').val().split(" - ")[0] + '/' + $('#daterangeSelect').val().split(" - ")[1],
            error: function () {
                $('#reports-wrapper').empty();

                var errorHtml = '';

                errorHtml += '<div class="alert alert-warning alert-dismissible">';
                errorHtml += '<button type="button" class="close" data-dismiss="warning" aria-hidden="true">×</button>';
                errorHtml += '<h4><i class="icon fa fa-info"></i> Alert!</h4>';
                errorHtml += 'There is no data to display!';
                errorHtml += '</div>';

                $('#reports-wrapper').append(errorHtml);
            },
            success: function (data) {

                for (var i = 0; i < data.length; i++) {

                    reports.push({
                        answer_value: data[i].answers,
                        question_label: data[i].question_label,
                        score: data[i].scores,
                        total: data[i].total,
                    });

                }


//                console.log(reports);

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
                                    data: reports[i].total
                                }
                            ]
                        }
                    });
                }
            }
        });
    })


</script>
