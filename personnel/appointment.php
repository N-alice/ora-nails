

<!-- edit appointment -->
<div id="edit_app?id=<?php echo $row['Id']; ?>" class="modal">
    <form class="modal-content animate" action="index.php?page=portal" method="post">
        <div class="imgcontainer">
            <span onclick="document.getElementById('edit_app?id=<?php echo $row['Id']; ?>').style.display='none'" class="close" title="Close Modal">&times;</span>
            <span class="las la-user-cog" style="font-size:64px;"></span>
        </div>
        <div class="container">  
            <input type="hidden" name="app_id" id="id" value="<?php echo $row['Id']; ?>">
            <?php
                get_appointments();
            ?>
            <div class="input-group">
                <label for="">Select Action</label>
                <select name="action" id="">
                    <option value="" selected disabled></option>
                    <option value="confirm">Confirm Appointment</option>
                    <option value="attended">Attended Appointment</option>
                    <option value="cancel">Decline Appointment</option>
                    <option value="reschedule">Reschedule Appointment</option>
                </select>
            </div>
        </div>
        <div class="container" style="background-color:#f1f1f1">
            <button type="submit" name="update_appointment_btn">Update Booking</button>
            <button type="button" onclick="document.getElementById('edit_app?id=<?php echo $row['Id']; ?>').style.display='none'" class="cancelbtn" >Cancel</button>
        </div>
    </form>
</div>