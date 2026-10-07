<!DOCTYPE html>
<html>

<head>
    <title>User Accounts</title>
    <link rel="stylesheet" href="/css/style.css">
</head>

<body>

    <div class="container">

        <h1>POS System</h1>

        <nav>
            <a href="/">Home</a> 
            <a href="/about">About</a> 
            <a href="/customers">Customers</a> 
            <a href="/users">Users</a>
            <?php if (session()->get('logged_in')): ?>
                <a href="<?= site_url('logout') ?>" class="btn btn-edit">
                    Logout
                </a>
            <?php endif; ?>
        </nav>

        <div class="page-header">
            <h1>User Accounts</h1>
            <a href="<?= site_url('users/new') ?>" class="btn btn-primary">
                Add New User
            </a>
        </div>

        <table border="1" cellpadding="10">
            <tr>
                <th>Username</th>
                <th>Full Name</th>
                <th>Avatar</th>
                <th>Actions</th>
            </tr>

            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= esc($user['username']) ?></td>
                    <td><?= esc($user['full_name']) ?></td>
                    <td>

                        <?php
                        $avatar =
                            !empty($user['avatar'])
                            ? base_url('uploads/thumbs/' . $user['avatar'])
                            : base_url('uploads/placeholder.png');
                        ?>

                        <img src="<?= $avatar ?>" alt="Avatar" class="avatar">

                    </td>
                    <td>
                        <a href="<?= 'users/edit/' . $user['id'] ?>" class="btn btn-edit">
                            Edit
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>

        </table>

    </div>
</body>

</html>