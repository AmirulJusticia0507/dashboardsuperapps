<?php
include 'theme/header.php';
// Simulasikan autentikasi session, ganti dengan kode sesi yang sesuai di aplikasi Anda
// Contoh: $_SESSION['user_role'] = 'Superadmin';
$_SESSION['user_role'] = 'Superadmin';

// Dapatkan peran pengguna dari data sesi
$userRole = isset($_SESSION['user_role']) ? $_SESSION['user_role'] : 'Customer'; // Default role jika tidak ada sesi

// Fungsi untuk mengatur hak akses berdasarkan peran
function getAuthorizedPages($role) {
    switch ($role) {
        case 'Superadmin':
            return ['home', 'customers', 'products', 'orders', 'order_details', 'categories', 'payments', 'shipping', 'transactions', 'user_management', 'settings', 'logout'];
        case 'Cashier':
            return ['home', 'orders', 'order_details', 'payments', 'logout'];
        case 'Customer':
            return ['home', 'logout'];
        default:
            return ['not_found'];
    }
}

$requestedPage = isset($_GET['page']) ? $_GET['page'] : 'home';
$authorizedPages = getAuthorizedPages($userRole);

if (!in_array($requestedPage, $authorizedPages)) {
    $requestedPage = 'not_found';
}
?>


<aside class="main-sidebar">
    <section class="sidebar">
        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li class="<?php echo ($requestedPage === 'home') ? 'active' : ''; ?>">
                <a href="<?php echo $_SERVER['SCRIPT_NAME']; ?>">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>
            <li class="treeview <?php echo (in_array($requestedPage, ['products', 'orders', 'order_details', 'categories', 'payments', 'shipping', 'transactions'])) ? 'active' : ''; ?>">
                <a href="#">
                    <i class="fa fa-shopping-cart"></i>
                    <span>Store</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="<?php echo ($requestedPage === 'products') ? 'active' : ''; ?>"><a href="<?php echo $_SERVER['SCRIPT_NAME']; ?>?page=products"><i class="fa fa-circle-o"></i> Products</a></li>
                    <li class="<?php echo ($requestedPage === 'orders') ? 'active' : ''; ?>"><a href="<?php echo $_SERVER['SCRIPT_NAME']; ?>?page=orders"><i class="fa fa-circle-o"></i> Orders</a></li>
                    <li class="<?php echo ($requestedPage === 'order_details') ? 'active' : ''; ?>"><a href="<?php echo $_SERVER['SCRIPT_NAME']; ?>?page=order_details"><i class="fa fa-circle-o"></i> Order Details</a></li>
                    <li class="<?php echo ($requestedPage === 'categories') ? 'active' : ''; ?>"><a href="<?php echo $_SERVER['SCRIPT_NAME']; ?>?page=categories"><i class="fa fa-circle-o"></i> Categories</a></li>
                    <li class="<?php echo ($requestedPage === 'payments') ? 'active' : ''; ?>"><a href="<?php echo $_SERVER['SCRIPT_NAME']; ?>?page=payments"><i class="fa fa-circle-o"></i> Payments</a></li>
                    <li class="<?php echo ($requestedPage === 'shipping') ? 'active' : ''; ?>"><a href="<?php echo $_SERVER['SCRIPT_NAME']; ?>?page=shipping"><i class="fa fa-circle-o"></i> Shipping</a></li>
                    <li class="<?php echo ($requestedPage === 'transactions') ? 'active' : ''; ?>"><a href="<?php echo $_SERVER['SCRIPT_NAME']; ?>?page=transactions"><i class="fa fa-circle-o"></i> Transactions</a></li>
                </ul>
            </li>
            <li class="<?php echo ($requestedPage === 'settings') ? 'active' : ''; ?>">
                <a href="<?php echo $_SERVER['SCRIPT_NAME']; ?>?page=settings">
                    <i class="fa fa-cog"></i> <span>Settings</span>
                </a>
            </li>
            <li>
                <a href="<?php echo $_SERVER['SCRIPT_NAME']; ?>?page=logout">
                    <i class="fa fa-sign-out"></i> <span>Sign Out</span>
                </a>
            </li>
            <!-- Add other menu items here -->
        </ul>
    </section>
</aside>

<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Dashboard
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
        </ol>
    </section>

    <section class="content">
        <!-- Your content goes here -->
    </section>
</div>

<?php include 'theme/footer.php'; ?>
