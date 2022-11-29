<!-- DELETE  -->
<!-- Designation -->
<!-- Add Service  -->
<div id="delete_services?id=<?php echo $row['id']; ?>" class="modal">
    <form class="modal-content animate" action="index.php?page=services" method="post">
        <div class="imgcontainer">
            <span onclick="document.getElementById('delete_services?id=<?php echo $row['id']; ?>').style.display='none'" class="close" title="Close Modal">&times;</span>
            <span class="lab la-servicestack" style="font-size:64px;"></span>
        </div>
        <div class="container">   
            <input type="hidden" name="id" value="<?php echo $row["id"]; ?>">
            <p>Are you sure to delete <strong><?php echo ucwords($row['serve_name']); ?></strong> from the list? This action cannot be undone.</p>
        </div>
        <div class="container" style="background-color:#f1f1f1">
            <button type="submit" name="delete_services_btn">Delete Service</button>
            <button type="button" onclick="document.getElementById('delete_services?id=<?php echo $row['id']; ?>').style.display='none'" class="cancelbtn" >Cancel</button>
        </div>
    </form>
</div>
<div id="delete_branch?id=<?php echo $row['id']; ?>" class="modal">
    <form class="modal-content animate" action="index.php?page=dashboard" method="post">
        <div class="imgcontainer">
            <span onclick="document.getElementById('delete_branch?id=<?php echo $row['id']; ?>').style.display='none'" class="close" title="Close Modal">&times;</span>
            <span class="lab la-servicestack" style="font-size:64px;"></span>
        </div>
        <div class="container">   
            <input type="hidden" name="id" value="<?php echo $row["id"]; ?>">
            <div class="input-group">
                <p>Are you sure to delete <strong><?php echo ucwords($row['bname']); ?></strong> from the list? This action cannot be undone.</p>
            </div>
        </div>
        <div class="container" style="background-color:#f1f1f1">
            <button type="submit" name="delete_branch_btn">Delete Service</button>
            <button type="button" onclick="document.getElementById('delete_branch?id=<?php echo $row['id']; ?>').style.display='none'" class="cancelbtn" >Cancel</button>
        </div>
    </form>
</div>
<div id="edit_designations?id=<?php echo $row['id']; ?>" class="modal">
    <form class="modal-content animate" action="index.php?page=users" method="post">
        <div class="imgcontainer">
            <span onclick="document.getElementById('edit_designations?id=<?php echo $row['id']; ?>').style.display='none'" class="close" title="Close Modal">&times;</span>
            <span class="las la-user-cog" style="font-size:64px;"></span>
        </div>
        <div class="container">  
            <input type="hidden" name="id" id="id" value="<?php echo $row['id']; ?>">
            <div class="input-group">
                <label>Designation</label>
                <input type="text" name="designation" value="<?php echo $row['designation_name']; ?>">
            </div> 
        </div>
        <div class="container" style="background-color:#f1f1f1">
            <button type="submit" name="update_designations_btn">Update Designation</button>
            <button type="button" onclick="document.getElementById('edit_designations?id=<?php echo $row['id']; ?>').style.display='none'" class="cancelbtn" >Cancel</button>
        </div>
    </form>
</div>

<!-- edit services -->
<div id="edit_services?id=<?php echo $row['id']; ?>" class="modal">
    <form class="modal-content animate" action="index.php?page=services" method="post">
        <div class="imgcontainer">
            <span onclick="document.getElementById('edit_services?id=<?php echo $row['id']; ?>').style.display='none'" class="close" title="Close Modal">&times;</span>
            <span class="lab la-servicestack" style="font-size:64px;"></span>
        </div>
        <div class="container">   
            <input type="hidden" name="id" value="<?php echo $row["id"]; ?>">
            <label for="">Service</label>
            <input type="text" name="service" id="" value="<?php echo ucwords($row['serve_name']); ?>">
            <label for="">Price</label>
            <input type="text" name="price" id="" value="<?php echo ucwords($row['price']); ?>">
        </div>
        <div class="container" style="background-color:#f1f1f1">
            <button type="submit" name="update_services_btn">Update Service</button>
            <button type="button" onclick="document.getElementById('edit_services?id=<?php echo $row['id']; ?>').style.display='none'" class="cancelbtn" >Cancel</button>
        </div>
    </form>
</div>

