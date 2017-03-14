<div class="box box-warning">
    <div class="box-header with-border">
        <h3 class="box-title">Edit agency</h3>
    </div>

    <?php echo form_open('agency/edit/'.$agency['id'], array("id"=>"form")); ?>
        <div class="box-body">

        <div class="form-group">
            <label for="agency_name" class="control-label">Agency Name</label>
                <input type="text" name="agency_name" value="<?php echo ($this->input->post('agency_name') ? $this->input->post('agency_name') : $agency['agency_name']); ?>" class="form-control" id="agency_name" />
        </div>

        <div class="form-group">
            <label for="agency_type" class="control-label">Agency Type</label>
                <select name="agency_type" class="form-control">
                    <option value="">--- SELECT TYPE ---</option>
                    <?php
                    $agency_type_values = array(
                        '1'=>'tip1',
                        '2'=>'tip2',
                        '3'=>'tip3',
                    );

                    foreach($agency_type_values as $value => $display_text)
                    {
                        $selected = ($value == $agency['agency_type']) ? ' selected="selected"' : "";

                        echo '<option value="'.$value.'" '.$selected.'>'.$display_text.'</option>';
                    }
                    ?>
                </select>
        </div>

        <div class="form-group">
            <label for="datepicker">Select date</label>
            <div class="input-group date">
                <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                </div>
                <input required="" id="datepicker" name="project_start_date" type="text" class="form-control pull-right" value="<?php echo ($this->input->post('agency_start_date') ? $this->input->post('agency_start_date') : $agency['agency_start_date']); ?>" aria-required="true">

            </div>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-success">Save</button>
        </div>
    <?php echo form_close(); ?>

</div>