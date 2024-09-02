<?php include("./includes/header.php");
include("./classes/class.user.php");

$userobj = new User();
$users = $userobj->fetchUser("staff");

?>

<div class="container mt-5">
    <div class="user-list">
        <h2 class="mb-4">Staff List</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>User Name</th>
                    <th>View Details</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user) { ?> <tr>
                        <td><?php echo ($user['user_id']); ?></td>
                        <td><?php echo ($user['user_name']); ?></td>
                        <td><a href="./staffdetails.php?user_id=<?php echo ($user['user_id']) ?>" class="btn btn-primary">View</a></td>
                    </tr><?php } ?>
            </tbody>
        </table>
    </div>
</div>
<?php include("./includes/footer.php") ?>