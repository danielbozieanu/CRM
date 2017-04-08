
<div class="row">
    <div class="col-md-12">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Add new project</h3>
            </div>
            <?php echo validation_errors(); ?>
            <?php echo form_open('projects/add', ['id'=>'form']); ?>
                <div class="box-body">
                    <div class="row">
                        <div class="col-xs-12 col-md-6">
                            <div class="form-group">
                                <label for="project_name">Project name</label>
                                <input required id="project_name" class="form-control" name="project_name" value="<?php echo $this->input->post('project_name'); ?>"/>
                            </div>
                        </div>

                        <div class="col-xs-12 col-md-6">
                            <div class="form-group">
                                <label for="project_status">Project status</label>
                                <select required class="form-control" name="project_status" id="project_status">
                                    <option value="">--- SELECT STATUS ---</option>
                                    <option value="0">Pending</option>
                                    <option value="1">Done</option>
                                    <option value="-1">Canceled</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-6">
                            <div class="form-group">
                                <label for="project_client">Account</label>
                                <select required id="project_client" name="project_client" class="form-control">
                                    <option value="">--- SELECT ACCOUNT ---</option>
                                    <?php foreach ( $clients as $client): ?>
                                        <option value="<?php echo $client->id; ?>">
                                            <?php echo $client->first_name.' '.$client->last_name; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-6">
                            <div class="form-group">
                                <label for="project_final_client">Final client</label>
                                <input required id="project_final_client" name="project_final_client" class="form-control" type="text" value="<?php echo $this->input->post('project_final_client'); ?>">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <label for="select_developer"  class="col-xs-12">Select developer:</label>
                        <div class="col-xs-12">
                            <div class="form-group">
                                <select required id="select_developer" name="developerToProject" class="form-control">
                                    <option value="">--- SELECT DEVELOPER ---</option>
                                    <?php foreach ($developers as $developer) : ?>
                                    <option value="<?php echo $developer['id']; ?>"><?php echo $developer['first_name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                    </div>

                   <div class="row">
                       <div class="col-xs-12 col-sm-6">
                           <div class="form-group">
                               <label for="datepicker">Start project date</label>
                               <div class="input-group date">
                                   <div class="input-group-addon">
                                       <i class="fa fa-calendar"></i>
                                   </div>
                                   <input required id="datepicker" name="project_start_date" type="text" class="form-control pull-right" name="project_start_date" value="<?php echo $this->input->post('project_start_date'); ?>"/>
                               </div>
                           </div>
                       </div>

                       <div class="col-xs-12 col-sm-6">
                           <div class="form-group">
                               <label for="project_estimation">Working days estimation</label>
                               <div class="input-group">
                                   <input required type="text" class="form-control" name="project_estimation" id="project_estimation" value="<?php echo $this->input->post('project_estimation'); ?>">
                                   <span class="input-group-addon">days</span>
                               </div>
                           </div>
                       </div>
                   </div>

                   <div class="row">
                       <div class="col-xs-12 col-sm-6">
                           <div class="form-group">
                               <label for="project_value">Project Value</label>
                               <div class="input-group">
                                   <input type="text" class="form-control" name="project_value" id="project_value" value="<?php echo $this->input->post('project_value'); ?>">
                                   <span class="input-group-addon"><i class="fa fa-euro"></i></span>
                               </div>
                           </div>
                       </div>

                       <div class="col-xs-12 col-sm-6">
                           <div class="form-group">
                               <label for="project_costs">Project Costs</label>
                               <div class="input-group">
                                   <input type="text" class="form-control" name="project_costs" id="project_costs" value="<?php echo $this->input->post('project_value'); ?>">
                                   <span class="input-group-addon"><i class="fa fa-euro"></i></span>
                               </div>
                           </div>
                       </div>
                   </div>

                </div>
            <div class="box-footer">
                <button type="submit" class="btn btn-success">Save</button>
            </div>
            <?php echo form_close(); ?>

        </div>
    </div>
</div>