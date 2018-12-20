<?php
    $contact_id='';
    if(isset($_GET['view_contact_id'])){
        $contact_id = $_GET['view_contact_id'];
    }    
    $view_contact = mysqli_query($conn, "select * from contacts where contact_id = '$contact_id'");
?>
<html>
<div class="modal" id="view_contact" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <?php while ($row = mysqli_fetch_array($view_contact)) { ?>
                <button type="button" class="close" id="close" onclick="$('#view_contact').fadeOut()">&times;</button>
                <center><h4 class="modal-title" ><strong><?php echo $row['First_Name']. "  " .  $row['Last_Name']; ?></strong></h4></center>
            </div>
            <div class="modal-body">
                <div class="row">
					
                    <div class="col-sm-12">
                        <table class="table table-responsive table-bordered table-condensed table-hover table-striped">
                            <tr>
                                <td>Home Address</td>
                                <td class="value"><?php echo $row['Home_Phone_Number'] ?></td>
                            </tr>
                            <tr>
                                <td>City</td>
                                <td class="value"><?php echo $row['City'] ?></td>
                            </tr>
                            <tr>
                                <td>State</td>
                                <td class="value"><?php echo $row['State']; ?></td>
                            </tr>
                            <tr>
                                <td>Zipcode</td>
                                 <td class="value"><?php echo $row['ZIpcode']; ?></td>
                            </tr>
                           

                        </table>
                    </div>
                </div>
            </div>          
            <?php } ?>   
            <div class="modal-footer">
                <center><button type="button" onclick="$('#view_contact').fadeOut();" class="btn btn-primary" ><span class="glyphicon glyphicon-ok"></span> Ok</button></center>
            </div>
        </div>
    </div>
</div>
</html>