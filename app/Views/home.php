<!DOCTYPE html>
<html>

<head>
    <title>POS System</title>
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
            <h1>Welcome</h1>
        </div>
        <p>Welcome to the POS System Version 4.</p>

    </div>
</body>

</html>