<?php include("./includes/header.php") ?>

<div class="container mt-5">
    <div class="alerts-list">
        <h2 class="mb-4">Alerts</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Description</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td class="bg-danger text-light">There is a critical system update available. Please update your system as soon as possible.</td>
                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td class="bg-danger text-light">Scheduled maintenance will occur on 2024-09-01 between 1 AM and 3 AM. Expect downtime.</td>
                </tr>
                <tr>
                    <th scope="row">3</th>
                    <td class="bg-danger text-light">Your password will expire in 7 days. Please change your password before it expires.</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<?php include("./includes/footer.php") ?>