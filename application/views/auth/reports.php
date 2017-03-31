<ul class="nav nav-tabs">
    <li class="active"><?php echo anchor("reports/agency", 'By Agency'); ?></li>
    <li><a href="#tab_2" >Tab 2</a></li>
    <li><a href="#tab_3" >Tab 3</a></li>
</ul>
<br>
<div class="form-group">
    <label for="">Select form</label>
    <select name="" id="" class="form-control">
        <?php foreach ($forms as $form): ?>
            <option value="<?php echo $form['form_id']; ?>"><?php echo $form['form_name'] ?></option>
        <?php endforeach; ?>
    </select>
</div>

<div id="reports" class="row">
</div>

<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery-2.2.3.min.js"></script>

<script>

    var data1 = 0;
    $.ajax({
        type: 'POST',
        url: '/reports/get_data/44',
        success: function (data) {
            data1 = data;

            for (var i = 0; i < data1.length; i++) {

                var htmlContent = '';

                htmlContent += '<div class="col-xs-4">';
                htmlContent += '<div class="box box-primary">';
                htmlContent += '<div class="box-header with-border">';
                htmlContent += '<h3 class="box-title" style="font-size: 14px; width: 90%">' + (i + 1) + '.' + data1[i].question + '</h3>';
                htmlContent += '<div class="box-tools pull-right">';
                htmlContent += '<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>';
//           htmlContent += '<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>';
                htmlContent += '</div>';
                htmlContent += '</div>';
                htmlContent += '<div class="box-body">';
                htmlContent += '<div class="chart">';
                htmlContent += '<canvas id="myChart' + i + '" width="100" height="100" style="width:100px;"></canvas>';
                htmlContent += '</div>';
                htmlContent += '</div>';
                htmlContent += '</div>';


                //Append new chart
                $('#reports').append(htmlContent);

                //Render chart
                var ctx = document.getElementById("myChart" + i).getContext("2d");
                var myBar = new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: data[i].choices,
                        datasets: [
                            {
                                backgroundColor: ["#FF6384",
                                    "#36A2EB",
                                    "#FFCE56",
                                    "#743123",
                                    "#128a73",
                                    "#947321",
                                    "#bdef13"
                                ],
                                data: data[i].scores
                            }
                        ]
                    }
                })
                console.log('After')
            }
        }
    });


    function getRandomColor() {
        var letters = '0123456789ABCDEF';
        var color = '#';
        for (var i = 0; i < 6; i++) {
            color += letters[Math.floor(Math.random() * 16)];
        }
        return color;
    }

</script>



