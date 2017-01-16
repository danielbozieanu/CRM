<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<table border="1" width="100%">
    <tr>
        <th>ID</th>
        <th>Nume</th>
        <th>Client</th>
        <th>Client Email</th>
        <th>Echipa</th>
        <th>Status</th>
        <th>Actions</th>
    </tr>
    <?php foreach($proiecte as $p){ ?>
        <tr>
            <td><?php echo $p['id']; ?></td>
            <td><?php echo $p['nume']; ?></td>
            <td><?php echo $p['client']; ?></td>
            <td><?php echo $p['client_email']; ?></td>
            <td><?php echo $p['echipa']; ?></td>
            <td><?php echo $p['status']; ?></td>
            <td>
                <a href="<?php echo site_url('proiecte/edit/'.$p['id']); ?>">Edit</a> |
                <a href="<?php echo site_url('proiecte/remove/'.$p['id']); ?>">Delete</a>
            </td>
        </tr>
    <?php } ?>
</table>