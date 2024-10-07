<?php

$pageName  = "Dashboard";
include($_SERVER['DOCUMENT_ROOT'] . "/user/layout/header.php");

// Ofofonobs Developer WhatsAPP +2348114313795


// Bank Script Developer - Use For Educational Purpose Only

// Other scripts Available

if (!$_SESSION['acct_no']) {
    header("location:../login.php");
    die;
}
if (@!$_COOKIE['firstVisit']) {
    setcookie("firstVisit", "no", time() + 3600);
    toast_alert('success', 'Welcome Back ' . $fullName . " !", 'Close');
}

unset($_SESSION['wire_transfer'], $_SESSION['dom_transfer']);

?>

<div class="content-body">
    <div class="container">
        <div class="page-title">
            <div class="row align-items-center justify-content-between">
                <div class="col-xl-4">
                    <div class="page-title-content">

                        <?php 
$theDate = date("H"); 
if($theDate < 12) 
echo "<h3>Hi, Good morning $fullName </h3>"; 
else if($theDate < 18) 
echo "<h3>Hi, Good afternoon  $fullName </h3>"; 
else 
echo "<h3>Hi, Good evening $fullName </h3>"; 
?>

                    </div>
                </div>

            </div>
        </div>
        <div class="row">

            <div class="col-xl-6 col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Summary</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                <div class="stat-widget d-flex align-items-center">
                                    <div class="widget-icon me-3 bg-primary"><span><i class="ri-wallet-line"></i></span>
                                    </div>
                                    <div class="widget-content">
                                        <h3><?= $currency ?><?php echo number_format($acct_balance, 2, '.', ','); ?>
                                        </h3>
                                        <p>Total Balance</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                <div class="stat-widget d-flex align-items-center">
                                    <div class="widget-icon me-3 bg-secondary"><span><i
                                                class="ri-wallet-2-line"></i></span></div>
                                    <div class="widget-content">
                                        <h3><?= $currency ?><?php echo number_format($loan_balance, 2, '.', ','); ?>
                                        </h3>
                                        <p>Loan Balance</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Stats</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                <div class="stat-widget d-flex align-items-center">
                                    <div class="widget-icon me-3 bg-success"><span><i
                                                class="ri-wallet-3-line"></i></span></div>
                                    <div class="widget-content">
                                        <?php
                                $user_id = userDetails('id');

                                $sql2="SELECT SUM(amount) FROM transactions WHERE user_id =:user_id AND trans_type='Wire transfer'";
                                $stmt = $conn->prepare($sql2);
                                $stmt->execute([
                                    'user_id'=>$user_id
                                ]);
                                $total = $stmt->fetch(PDO::FETCH_NUM);
                        $wire = $total[0];
                                
                                    ?>
                                        <h3><?= $currency ?><?php echo number_format($wire, 2, '.', ','); ?>
                                        </h3>

                                        <p>Wire Transfer</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                <div class="stat-widget d-flex align-items-center">
                                    <div class="widget-icon me-3 bg-danger"><span><i
                                                class="ri-wallet-3-line"></i></span></div>
                                    <div class="widget-content">
                                        <?php
                                $user_id = userDetails('id');

                                $sql2="SELECT SUM(amount) FROM transactions WHERE user_id =:user_id AND trans_type='Domestic transfer'";
                                $stmt = $conn->prepare($sql2);
                                $stmt->execute([
                                    'user_id'=>$user_id
                                ]);
                                $total = $stmt->fetch(PDO::FETCH_NUM);
                        $dom = $total[0];
                                
                                    ?>
                                        <h3><?= $currency ?><?php echo number_format($dom, 2, '.', ','); ?>
                                        </h3>
                                        <p>Domestic Transfer</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class=" col-xxl-4 col-xl-4 col-lg-6 col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Account Details</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="total-balance">
                                    <p>Account Number</p>
                                    <h2><?= $row['acct_no']; ?></h2>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                <div class="balance-stats active">
                                    <p>Currency</p>



                                    <h3><?= $row['acct_currency']; ?></h3>

                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                <div class="balance-stats">
                                    <p>Account type</p>
                                    <h3><?= $row['acct_type'] ?></h3>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                <div class="balance-stats">
                                    <p>Status</p>
                                    <h3> <?php
                            echo $userStatus
                            ?></h3>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                <div class="balance-stats">
                                    <p>Account Limit</p>
                                    <!-- <h3><?= $currency ?><?php echo number_format($limit_remain, 2, '.', ','); ?></h3> -->
                                    <h3><?= $currency ?><?= $row['limit_remain'] ?></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-8 col-lg-6 col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Recent Transaction</h4>
                    </div>
                    <div class="card-body">
                        <div class="invoice-content">
                            <ul>
                               <?php 
                                $user_id = userDetails('id');

                                $sql2="SELECT * FROM transactions WHERE user_id =:user_id ORDER BY trans_id DESC LIMIT 3";
                                $wire = $conn->prepare($sql2);
            $wire->execute([
                'user_id' => $user_id
            ]);
                                $sn = 1;

            while ($result = $wire->fetch(PDO::FETCH_ASSOC)) {


                $amount = $result['amount'];
                                   
                                   
                                    ?>

                                <li class="d-flex justify-content-between active">
                                    <div class="d-flex align-items-center">

                                        <div class="invoice-info">
                                            <h5 class="mb-0"><?= $result['trans_type'] ?></h5>
                                            
                                            <p><?= $result['created_at'] ?></p>

                                        </div>
                                    </div>
                                    <div class="text-end">
                                        
                                             <?php
                        if ($result['transaction_type'] === 'credit') {
                        ?>
<h5 class="mb-2 text-success">
                                            +<?= $currency ?><?php echo number_format($amount, 2, '.', ','); ?>
                                            </h5>
                                             <?php
                        } else {
                        ?>
                        <h5 class="mb-2 text-danger">
                         -<?= $currency ?><?php echo number_format($amount, 2, '.', ','); ?>
                         </h5>
                         <?php
                        }
                        ?>
                        
                                        <?= $result['trans_status'] ?>
                                    </div>
                                </li>




                                <?php

                            }


                             
                            ?>




                            </ul>
                        </div>
                    </div>
                </div>
            </div>

          

        </div>
    </div>
</div>


<?php 
include($_SERVER['DOCUMENT_ROOT'] . "/user/layout/footer.php");


?>