<h2 align="center">Enter User Detail</h2>

<?php echo validation_errors(); ?>

<?php echo form_open('Employe/register') ?>
<div align="center">
    <div class="col-lg-6">
    <label class="">Name</label>
    <input type="text" class="form-control" name="email"/>
    <label>dob</label>
    <input type="text" class="form-control" name="password"/>
    <label>Gender</label>
    <input type="radio" class="form-control" name="sex" value="Male"/>Male
    <input type="radio" class="form-control" name="sex" value="Female"/>Female
    <br>
    <label>Experince Month</label>
    <input type="text" class="form-control" name="experince_month"/>
    <label>Current Location</label>
    <input type="text" class="form-control" name="current_location"/>
    <label>Prefered Location</label>
    <input type="text" class="form-control" name="prefred_location"/>
    <label>Industry</label>
    <input type="text" class="form-control" name="industry"/>
    <label>Function Area</label>
    <input type="text" class="form-control" name="function_area"/>
    <br>
    <input type="submit" value="Register" />
    </div>
    </div>

</form>