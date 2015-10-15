<div class="row">
    <?php form_open('Job/add'); ?>

    <div class="col-lg-12 ">
        <h3 class="page-header">Post Job</h3>
        <div class="panel">
            <div class="panel-body">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="control-label">Job Title/Designation</label>
                        <input type="text" name="title" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label class="control-label">No of vacancies</label>
                        <input type="text" name="no_of_vacancy" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Job Description</label>
                        <textarea name="description" class="form-control"/></textarea>
                    </div>
                    <div class="form-group">
                        <label class="control-label">keywords</label>
                        <input type="text" name="keyword" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Work Experience</label><br>
                        <select class="form-control half-formcontrol"  name="exp_min"></select><select class="form-control half-formcontrol" name="exp_max"></select>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="control-label">CTC</label><br>
                        <select class="form-control half-formcontrol"  name="ctc_min"></select><select class="form-control half-formcontrol"  name="ctc_max"></select>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Location</label>
                        <select class="form-control" name="location">
                            <?php echo $location; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Industry</label>
                        <select class="form-control" name="industry"></select>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Function Area</label>
                        <select class="form-control" name="functional_area"></select>
                        <input type="hidden" name="auth_id" value="<?php echo $auth_id ?>"/>
                    </div>

                </div>
            </div>
            <div class="panel-footer">
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" name="submit" value="Save" >
                </div>
            </div>
        </div>
    </div>
</form>
</div>
