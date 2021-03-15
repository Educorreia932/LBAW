<?php function site_header($user, $current_page) {?>
    <header class="navbar navbar-expand-md navbar-dark bg-dark py-2">
        <nav class="container-fluid flex-wrap flex-md-nowrap mx-0" aria-label="Main Navigation">
            <a class="navbar-brand p-0 me-md-3 mx-auto fs-4" aria-label="Trade-a-Bid" href="/">
                <img src="../static/logo.svg" width="60" height="60" alt="Trade-a-Bid">
                <span>Trade-a-Bid</span>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#siteHeader" aria-controls="siteHeader" aria-expanded="false" aria-label="Toggle Navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse ps-2 ps-md-0" id="siteHeader">
                <ul class="container-fluid navbar-nav flex-row flex-wrap m-0 p-0 mt-2 mt-md-0 pt-2 pt-md-0">
                    <li class="nav-item col-6 col-md-auto">
                        <?php if ($current_page == "page_home") { ?>
                            <a class="nav-link active" aria-current="page" href="/">Home</a>
                        <?php } else {?>
                            <a class="nav-link" href="/">Home</a>
                        <?php }?>
                    </li>
                    <div class="d-flex p-0 col-6 col-md-auto flex-column flex-md-row" id="headerAuctionSection">
                        <!-- <span class="d-block d-md-none text-secondary text-capitalize header-section-title">Auctions</span> -->
                        <li class="nav-item">
                            <?php if ($current_page == "page_search_auctions") { ?>
                                <a class="nav-link active" aria-current="page" href="search_results.php?subpage=auctions">Auctions</a>
                            <?php } else {?>
                                <a class="nav-link" href="search_results.php?subpage=auctions">Auctions</a>
                            <?php }?>
                        </li>
                        <li class="nav-item">
                            <?php if ($current_page == "page_search_users") { ?>
                                <a class="nav-link active" aria-current="page" href="search_results.php?subpage=users">Users</a>
                            <?php } else {?>
                                <a class="nav-link" href="search_results.php?subpage=users">Users</a>
                            <?php }?>
                        </li>
                        <li class="nav-item">
                            <?php if ($current_page == "page_create_auction") { ?>
                                    <a class="nav-link active" aria-current="page" href="create_auction.php">Sell Item</a>
                            <?php } else {?>
                                    <a class="nav-link" href="create_auction.php">Sell Item</a>
                            <?php }?>
                        </li>
                    </div>
                </ul>

                <hr class="d-md-none text-white-50">

                <ul class="navbar-nav flex-row ms-md-auto me-md-4">
                    <?php if ($user != NULL) { ?>
                        <li class="d-none d-md-flex nav-item dropdown px-1">
                            <button class="btn hover-scale position-relative align-middle me-1" type="button" data-bs-toggle="modal" data-bs-target="#notifications-modal">
                                <i class="bi bi-bell position-absolute top-50 start-50 translate-middle text-center text-white" style="font-size:xx-large;"></i>
                                <span class="position-absolute top-50 start-50 translate-middle text-center text-white"  style="font-size:small; font-weight: bold;">42</span>
                            </button>
                        
                            <button class="btn btn-dark dropdown-toggle" type="button" id="user-dropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <span><?=htmlentities($user)?></span>
                                <i class="bi bi-person-circle" style="font-size: 1.2rem;"></i>
                            </button>
                        
                            <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="user-dropdown">
                                <li><a class="dropdown-item" href="dashboard.php">Dashboard</a></li>
                                <li><a class="dropdown-item" href="user_profile.php">Profile</a></li>
                                <li><a class="dropdown-item" href="settings.php">Settings</a></li>
                                <li><a class="dropdown-item" href="">Sign out</a></li>
                            </ul>
                        </li>
                        <div class="d-flex d-md-none flex-wrap flex-row w-100">
                            <li class="nav-item col-12 d-flex justify-content-between">
                                <div>
                                    <i class="bi bi-person-circle navbar-text" style="font-size: 1.2rem;"></i>
                                    <span class="navbar-text"><?=htmlentities($user)?></html></span>
                                </div>
                                <button class="btn hover-scale position-relative align-middle me-1" type="button" data-bs-toggle="modal" data-bs-target="#notifications-modal">
                                    <i class="bi bi-bell position-absolute top-50 start-50 translate-middle text-center text-muted" style="font-size:xx-large;"></i>
                                    <span class="position-absolute top-50 start-50 translate-middle text-center text-muted"  style="font-size:small; font-weight: bold;">42</span>
                                </button>
                            </li>
                            <li class="nav-item col-6"><a class="nav-link" href="settings.php">Settings</a></li>
                            <li class="nav-item col-6"><a class="nav-link" href="user_profile.php">Profile</a></li>
                            <li class="nav-item col-6"><a class="nav-link" href="">Sign out</a></li>
                            <li class="nav-item col-6"><a class="nav-link" href="dashboard.php">Dashboard</a></li>
                        </div>
                    <?php } else { ?>
                        <li class="nav-item col-6 col-md-auto">
                            <a class="nav-link px-2" href="signin.php">Sign in</a>
                        </li>
                        <li class="nav-item col-6 col-md-auto">
                            <a class="d-inline-block d-md-block nav-link border border-white rounded-3 px-2" href="signup.php">Sign up</a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </nav>

        <div class="modal fade" tabindex="-1" role="dialog" id="notifications-modal">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Notifications</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                    <?php
                        notification_entry_outbid("Hades STEAM Key", "17.86");
                        echo "<hr>";
                        notification_entry_user_follow("stonefree");
                        echo "<hr>";
                        notification_entry_outbid("Hollow Knight STEAM Key", "12.24");
                        echo "<hr>";
                        notification_entry_user_auction("Jotaro Kujo", "Stand Disk", "950.00");
                    ?>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-danger">Report</button>
                    </div>
                </div>
            </div>
        </div>
    </header>
<?php } ?>


<?php function notification_entry_user_auction($user, $auction, $start_bid) { ?>
    <div class="d-flex justify-content-between">
        <span>Followed user <a href="user_profile.php" class="link-dark"><?= $user ?></a> created a new auction for <a href="auction.php" class="link-dark"><?= $auction ?></a> with a starting bid of <strong class="fw-bold"><?= $start_bid ?>€</strong></span>
        <button class="btn hover-scale ms-1">
            <i class="bi bi-eye" style="font-size:x-large;"></i>
        </button>
    </div>
<?php } ?>

<?php function notification_entry_user_follow($user) { ?>
    <div class="d-flex justify-content-between">
        <span>User <a href="user_profile.php" class="link-dark"><?= $user ?></a> just started following you!</span>
        <button class="btn hover-scale ms-1">
            <i class="bi bi-eye" style="font-size:x-large;"></i>
        </button>
    </div>
<?php } ?>


<?php function notification_entry_outbid($auction, $ammount) { ?>
    <div class="d-flex justify-content-between">
        <span>You were outbid on <a href="auction.php" class="link-dark"><?= $auction ?></a> auction for <strong class="fw-bold"><?= $ammount ?>€</strong></span>
        <button class="btn hover-scale ms-1">
            <i class="bi bi-eye" style="font-size:x-large;"></i>
        </button>
    </div>
<?php } ?>
