<?php
require_once 'config/db.php';

// Check if user is logged in as admin
if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] != 'admin') {
    header("Location: login.php");
    exit();
}

// Get statistics
$total_shops = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as count FROM shops"))['count'];
$total_products = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as count FROM products"))['count'];
$total_sales = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(total_amount) as total FROM sales"))['total'] ?? 0;
$total_customers = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as count FROM customers"))['count'];

// Get recent shops
$recent_shops = mysqli_query($conn, "SELECT * FROM shops ORDER BY created_at DESC LIMIT 5");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - ZEROMAN</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background: #f8f9fa;
        }
        
        .sidebar {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            color: white;
        }
        
        .sidebar .nav-link {
            color: rgba(255,255,255,0.8);
            padding: 15px 25px;
            margin: 5px 0;
            border-radius: 10px;
        }
        
        .sidebar .nav-link:hover {
            color: white;
            background: rgba(255,255,255,0.1);
        }
        
        .sidebar .nav-link.active {
            background: rgba(255,255,255,0.2);
            color: white;
        }
        
        .main-content {
            padding: 30px;
        }
        
        .stat-card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
            transition: all 0.3s;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }
        
        .stat-icon {
            font-size: 40px;
            color: #667eea;
        }
        
        .table-container {
            background: white;
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
            margin-top: 30px;
        }
        
        .btn-action {
            padding: 5px 10px;
            margin: 0 2px;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 px-0">
                <div class="sidebar p-3">
                    <div class="text-center mb-4">
                        <h3>ZEROMAN</h3>
                        <p class="mb-0">Admin Panel</p>
                    </div>
                    <hr class="bg-white">
                    <nav class="nav flex-column">
                        <a class="nav-link active" href="dashboard_admin.php">
                            <i class="fas fa-dashboard me-2"></i>Dashboard
                        </a>
                        <a class="nav-link" href="manage_shops.php">
                            <i class="fas fa-store me-2"></i>Manage Shops
                        </a>
                        <a class="nav-link" href="all_sales.php">
                            <i class="fas fa-chart-line me-2"></i>All Sales
                        </a>
                        <a class="nav-link" href="reports.php">
                            <i class="fas fa-file-alt me-2"></i>Reports
                        </a>
                        <a class="nav-link" href="settings.php">
                            <i class="fas fa-cog me-2"></i>Settings
                        </a>
                        <hr class="bg-white">
                        <a class="nav-link" href="logout.php">
                            <i class="fas fa-sign-out-alt me-2"></i>Logout
                        </a>
                    </nav>
                </div>
            </div>
            
            <!-- Main Content -->
            <div class="col-md-9 col-lg-10 main-content">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2>Dashboard</h2>
                    <div>
                        <span class="me-3">
                            <i class="fas fa-user me-2"></i><?php echo $_SESSION['username']; ?>
                        </span>
                    </div>
                </div>
                
                <!-- Statistics Cards -->
                <div class="row">
                    <div class="col-md-3 mb-4">
                        <div class="stat-card">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h6 class="text-muted">Total Shops</h6>
                                    <h2 class="mb-0"><?php echo $total_shops; ?></h2>
                                </div>
                                <div class="stat-icon">
                                    <i class="fas fa-store"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-3 mb-4">
                        <div class="stat-card">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h6 class="text-muted">Total Products</h6>
                                    <h2 class="mb-0"><?php echo $total_products; ?></h2>
                                </div>
                                <div class="stat-icon">
                                    <i class="fas fa-boxes"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-3 mb-4">
                        <div class="stat-card">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h6 class="text-muted">Total Sales</h6>
                                    <h2 class="mb-0">$<?php echo number_format($total_sales, 2); ?></h2>
                                </div>
                                <div class="stat-icon">
                                    <i class="fas fa-dollar-sign"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-3 mb-4">
                        <div class="stat-card">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h6 class="text-muted">Total Customers</h6>
                                    <h2 class="mb-0"><?php echo $total_customers; ?></h2>
                                </div>
                                <div class="stat-icon">
                                    <i class="fas fa-users"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Recent Shops -->
                <div class="table-container">
                    <h4 class="mb-4">Recently Registered Shops</h4>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Shop Name</th>
                                    <th>Owner</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Registered Date</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while($shop = mysqli_fetch_assoc($recent_shops)): ?>
                                <tr>
                                    <td>#<?php echo $shop['id']; ?></td>
                                    <td><?php echo $shop['shop_name']; ?></td>
                                    <td><?php echo $shop['owner_name']; ?></td>
                                    <td><?php echo $shop['email']; ?></td>
                                    <td><?php echo $shop['phone']; ?></td>
                                    <td><?php echo date('d M Y', strtotime($shop['created_at'])); ?></td>
                                    <td>
                                        <span class="badge bg-success">Active</span>
                                    </td>
                                    <td>
                                        <a href="view_shop.php?id=<?php echo $shop['id']; ?>" class="btn btn-sm btn-info btn-action">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="edit_shop.php?id=<?php echo $shop['id']; ?>" class="btn btn-sm btn-primary btn-action">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="delete_shop.php?id=<?php echo $shop['id']; ?>" class="btn btn-sm btn-danger btn-action" onclick="return confirm('Are you sure?')">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <!-- Quick Actions -->
                <div class="row mt-4">
                    <div class="col-md-6">
                        <div class="table-container">
                            <h4 class="mb-3">Quick Actions</h4>
                            <div class="d-grid gap-3">
                                <a href="add_shop.php" class="btn btn-primary">
                                    <i class="fas fa-plus-circle me-2"></i>Add New Shop
                                </a>
                                <a href="generate_report.php" class="btn btn-info">
                                    <i class="fas fa-file-pdf me-2"></i>Generate Sales Report
                                </a>
                                <a href="system_settings.php" class="btn btn-secondary">
                                    <i class="fas fa-cog me-2"></i>System Settings
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="table-container">
                            <h4 class="mb-3">System Status</h4>
                            <div class="mb-3">
                                <div class="d-flex justify-content-between">
                                    <span>Database</span>
                                    <span class="badge bg-success">Connected</span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="d-flex justify-content-between">
                                    <span>Server Uptime</span>
                                    <span>99.9%</span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="d-flex justify-content-between">
                                    <span>Backup Status</span>
                                    <span class="badge bg-success">Last backup: Today</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>