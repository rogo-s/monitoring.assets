<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Information assets</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style-dash.css">
</head>
<body>
<div class="row">
    <!-- Kotak 1: Total Device Type -->
    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <?php
                // Query untuk mendapatkan total device type
                $totalDeviceTypeQuery = "SELECT COUNT(DISTINCT dvt.dvt_name) as total FROM tbl_non_device dn
                LEFT JOIN tbl_dvt dvt ON dn.dvt_id = dvt.dvt_id";
                $totalDeviceTypeResult = $db->query($totalDeviceTypeQuery);
                $totalDeviceType = $totalDeviceTypeResult->fetch_assoc()['total'];

                echo "<h5>Total Device Type</h5>";
                echo "<p>{$totalDeviceType}</p>";
                ?>
            </div>
        </div>
    </div>

    <!-- Kotak 2: Total Brand -->
    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <?php
                // Query untuk mendapatkan total brand
                $totalBrandQuery = "SELECT COUNT(DISTINCT br.brand_name) as total FROM tbl_non_device dn
                LEFT JOIN tbl_brand br ON dn.brand_id = br.brand_id";
                $totalBrandResult = $db->query($totalBrandQuery);
                $totalBrand = $totalBrandResult->fetch_assoc()['total'];

                echo "<h5>Total Brand</h5>";
                echo "<p>{$totalBrand}</p>";
                ?>
            </div>
        </div>
    </div>

    <!-- Kotak 3: Informasi Status (Active, Repair, Non-Active) -->
    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <?php
                echo "<h5>Total Status</h5>";
                
                // Query untuk mendapatkan total status
                $totalStatusQuery = "SELECT 
                                    COUNT(*) as total,
                                    COUNT(CASE WHEN sts.status_device = 'Active' THEN 1 END) as totalActive,
                                    COUNT(CASE WHEN sts.status_device = 'Repair' THEN 1 END) as totalRepair,
                                    COUNT(CASE WHEN sts.status_device = 'Non-Active' THEN 1 END) as totalNonActive
                                    FROM tbl_non_device dn
                                    LEFT JOIN tbl_status sts ON dn.status_id = sts.status_id";
                $totalStatusResult = $db->query($totalStatusQuery);
                $totalStatus = $totalStatusResult->fetch_assoc();

                echo "<p>Total: {$totalStatus['total']}</p>";
                echo "<p>Active: {$totalStatus['totalActive']}, Repair: {$totalStatus['totalRepair']}, Non-Active: {$totalStatus['totalNonActive']}</p>";
                ?>
            </div>
        </div>
    </div>

    <!-- Kotak 6: Total Vendor -->
    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <?php
                // Query untuk mendapatkan total vendor
                $totalVendorQuery = "SELECT COUNT(DISTINCT rp.vendor_name) as total FROM tbl_non_device dn
                                    LEFT JOIN tbl_repair rp ON dn.serial_number = rp.serial_number";
                $totalVendorResult = $db->query($totalVendorQuery);
                $totalVendor = $totalVendorResult->fetch_assoc()['total'];

                echo "<h5>Total Vendor</h5>";
                echo "<p>{$totalVendor}</p>";
                ?>
            </div>
        </div>
    </div>
</div>

</body>
</html>