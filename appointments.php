<!-- edit appointments -->
<div id="edit_appointment?id=<?php echo $row['Id']; ?>" class="modal">
    <form class="modal-content animate" action="index.php?page=portal" method="post">
        <div class="imgcontainer">
            <span onclick="document.getElementById('edit_appointment?id=<?php echo $row['Id']; ?>').style.display='none'" class="close" title="Close Modal">&times;</span>
            <span class="lab la-servicestack" style="font-size:64px;"></span>
        </div>
        <div class="container">   
            <div class="input-group">
                <input type="hidden" name="app_id" value="<?php echo $row["Id"]; ?>">
            </div>
            <div class="input-group">
                <label for="">Select Action</label>
                <select name="action" id="">
                    <option value="" selected disabled></option>
                    <option value="approved">Approve</option>
                    <option value="declined">Decline</option>
                </select>
            </div>
        </div>
        <div class="container" style="background-color:#f1f1f1">
            <button type="submit" name="update_appointment_btn">Update Appointment</button>
            <button type="button" onclick="document.getElementById('edit_appointment?id=<?php echo $row['Id']; ?>').style.display='none'" class="cancelbtn" >Cancel</button>
        </div>
    </form>
</div>

<!-- edit bookings -->
<div id="edit_bookings?id=<?php echo $row['Id']; ?>" class="modal">
    <form class="modal-content animate" action="index.php?page=portal" method="post">
        <div class="imgcontainer">
            <span onclick="document.getElementById('edit_bookings?id=<?php echo $row['Id']; ?>').style.display='none'" class="close" title="Close Modal">&times;</span>
            <span class="las la-user-cog" style="font-size:64px;"></span>
        </div>
        <div class="container">  
            <input type="hidden" name="app_id" id="id" value="<?php echo $row['Id']; ?>">
            <?php
                get_appointments();
            ?>
            <div class="input-group">
                <label for="">Staff</label>
                <input type="text" name="scheduled" id="" value="<?php echo $row['fname']. ' ' .$row['lname']; ?>">
            </div>
            <div class="input-group">
                <label for="">Service</label>
                <input type="text" name="scheduled" id="" value="<?php echo $row['serve_name']; ?>">
            </div>
            <div class="input-group">
                <label for="">Branch</label>
                <input type="text" name="scheduled" id="" value="<?php echo $row['bname']; ?>">
            </div>
            <div class="input-group">
                <label for="">Special Request</label>
                <input type="text" name="scheduled" id="" value="<?php echo $row['speciality']; ?>">
            </div>
            <div class="input-group">
                <label for="">Date</label>
                <input type="text" name="scheduled" id="schedule_upd" value="<?php echo $row['appointment_date']; ?>">
            </div>
            <div class="input-group">
                <label for="">Time</label>
                <input type="time" name="schedule_time" id="">
            </div>
            <div class="input-group">
                <label for="">Select Action</label>
                <select name="action" id="">
                    <option value="" selected disabled></option>
                    <option value="cancel appointment">Cancel Appointment</option>
                    <option value="reschedule appointment">Reschedule Appointment</option>
                </select>
            </div>
        </div>
        <div class="container" style="background-color:#f1f1f1">
            <button type="submit" name="update_bookings_btn">Update Booking</button>
            <button type="button" onclick="document.getElementById('edit_bookings?id=<?php echo $row['Id']; ?>').style.display='none'" class="cancelbtn" >Cancel</button>
        </div>
    </form>
</div>