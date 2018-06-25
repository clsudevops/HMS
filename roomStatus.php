<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('cssInclude.php') ?>
</head>

<body>
    <header>
        <?php require('pages/layout/navbar.php') ?>
        <?php require('pages/layout/sidenav.php') ?>
    </header>
    
    <main>
        <div class="row">
            <div class="col s12 mycontainer">
                <div class="card-1">
                    <!-- query for roomtype -->
                    <div class="page-header valign-wrapper z-depth-1">
                        <h5>Account Information</h5>
                    </div>
                    <div class="row">
                        <div class="card col m8 s12"  style="padding:10px 20px;">
                            <div class="accountInformation">
                                <h5 id="h5-roomNo"></h5>
                                <p id="ratepernight"></p>
                                <p id="checkin"></p>
                                <p id="checkout"></p>
                            </div>
                            <div class="extras">
                                <h5 id="h5-extras">List of Extra's</h5>
                            </div>
                        </div>
                        <div class="col m4 s12">
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    <!-- Modal Structure -->
        
    </main>
    
    <footer>
        <?php require('pages/layout/footer.php') ?>
    </footer>


</body>

<section class="jsIncludes">
    <?php require('jsInclude.php') ?>
    <script type="text/javascript" src="includes/js/roomStatus.js"></script>
</section>

</html>