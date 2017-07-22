<?php
$all_users = $crud->GetAll();
?>
<table class="table-striped table">
    <thead>
    <tr>
        <th>RFID Tag</th>
        <th>IRC Name</th>
        <th>Admin</th>
        <th>Active</th>
        <th>Edit</th>
        <th>Delete</th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach($all_users AS $user){
        ?>
        <tr>
            <td><?php echo $user['key']; ?></td>
            <td><?php echo $user['ircName']; ?></td>
            <td><?php echo $user['isAdmin']; ?></td>
            <td><?php echo $user['isActive']; ?></td>
            <td><a href="admin.php?action=edit&key=<?php echo $user['key']; ?>">Edit</a></td>
            <td><a href="admin.php?action=delete&rowid=<?php echo $user['rowid']; ?>">Delete</a></td>
        </tr>
        <?php
    }
    ?>
    </tbody>
</table>

