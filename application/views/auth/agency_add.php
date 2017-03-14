<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Add new agency</h3>
    </div>

    <div class="box-body">
        <?php echo form_open('agency/add'); ?>

        <div class="form-group">
            <label for="agency_name">Agency Name</label>
            <input class="form-control" type="text" name="agency_name" value="<?php echo $this->input->post('agency_name'); ?>" class="form-control" id="agency_name" />
        </div>

        <div class="form-group">
            <label for="agency_type" class="control-label">Agency Type</label>
                <select name="agency_type" class="form-control">
                    <option value="">--- SELECT TYPE ---</option>
                    <?php
                    $agency_type_values = array(
                        'media'=>'Media',
                        'advertising'=>'Advertising',
                        'pr'=>'PR',
                        'comunicare'=>'Comunicare',
                        'digital'=>'Digital',
                    );

                    foreach($agency_type_values as $value => $display_text)
                    {
                        $selected = ($value == $this->input->post('agency_type')) ? ' selected="selected"' : "";

                        echo '<option value="'.$value.'" '.$selected.'>'.$display_text.'</option>';
                    }
                    ?>
                </select>
        </div>
        <div class="form-group">
            <label for="agency_start_date" class="control-label">Agency Start Date</label>
                <div class="input-group date">
                    <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                    </div>
                    <input id="datepicker" type="text" name="agency_start_date" value="<?php echo $this->input->post('agency_start_date'); ?>" class="form-control" id="agency_start_date" />
                </div>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-success">Save</button>
        </div>
    </div>
</div>
