<?php
    $contact_id='';
    if(isset($_GET['delete_contact_id'])){
        $contact_id = $_GET['delete_contact_id'];
    }
    if(isset($_POST['delete'])){
        $delete_id = $_POST['delete_id'];
        $delete_contact = mysqli_query($conn, "delete from contacts where contact_id = '$delete_id'");
        echo"<script>location.href='index.php'</script>";

    }
    mysqli_close($conn);
?>
<html>
<div class="modal" id="delete_contact_id" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <form action="index.php?delete_contact_id=<?php echo  $contact_id; ?>" method="post">
        <input type="hidden" name="delete_id" value="<?php echo  $contact_id; ?>">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" id=close" onclick="$('#delete_contact_id').fadeOut();">&times;</button>
                <center><h4 class="modal-title">Delete</h4></center>
            </div>
            <div class="modal-body">
                <center><p>Are you sure you want to delete</p></center>
            </div>
            <div class="modal-footer">
                <center><button type="submit" name="delete"   class="btn btn-primary" ></span> Yes</button></center>
            </div>
        </div>
        </form>
    </div>
</div>
<html>