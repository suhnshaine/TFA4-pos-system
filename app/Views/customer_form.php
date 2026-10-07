<!DOCTYPE html>
<html>

<head>
    <title>Customer Accounts</title>
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

        <h1>Customer Form</h1>
        <?php if (isset($validation)): ?>

            <div class="validation-errors">
                <?= $validation->listErrors() ?>
            </div>

        <?php endif; ?>
        <form method="post" action="<?= isset($customer) ? site_url('customers/update/' . $customer['id']) : site_url('customers/create') ?>">

            <div class="form-group">
                <label>Full Name</label>
                <input
                    type="text"
                    name="full_name"
                    placeholder="Full Name"
                    value="<?= $customer['full_name'] ?? '' ?>">

                <br><br>
            </div>

            <div class="form-group">
                <label>Email</label>
                <input
                    type="email"
                    name="email"
                    placeholder="Email"
                    value="<?= $customer['email'] ?? '' ?>">

                <br><br>
            </div>

            <div class="form-group">
                <label>Phone</label>
                <input
                    type="text"
                    name="phone"
                    placeholder="Phone"
                    value="<?= $customer['phone'] ?? '' ?>">

                <br><br>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Save</button>
                <a href="<?= site_url('customers') ?>" class="btn btn-edit">
                    Cancel
                </a>
            </div>

        </form>

    </div>
</body>

</html>