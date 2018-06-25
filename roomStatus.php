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
                        <div class="col m8 s12">
                            <div class="card" style="padding:20px 20px 10px 20px;">
                                <div class="accountInformation">
                                    <h5 id="h5-roomNo"></h5>
                                    <p id="ratepernight"></p>
                                    <p id="checkin" style="margin:5px 0px;"></p>
                                    <p id="checkout" style="margin:5px 0px;"></p>
                                </div>
                                <div class="extras">
                                    <h5 id="h5-extras">List of Extra's</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col m4 s12">
                            <div style="margin-top:7.5px;">
                                <ul class="collapsible index-summaries ">
                                    <li class="active">
                                        <div class="collapsible-header"><i class="material-icons">filter_vintage</i>Extra's</div>
                                        <div class="collapsible-body">
                                            <table class="highlight extraListTable" style="max-height:200px; min-height:200px;">
                                                <!-- used js to populate this -->
                                            </table>
                                        </div>
                                    </li>
                                </ul>
                                <ul class="collapsible index-summaries">
                                    <li class="active">
                                        <div class="collapsible-header"><i class="material-icons">exit_to_app</i>Checkout Date</div>
                                        <div class="collapsible-body">
                                            <table class="highlight">
                                                <tr id="checkingOut"><td style="width:196px">Today's Checkout</td><td id="todaysCheckoutCount"></td></tr>
                                                <tr id="penalty"><td style="width:196px">Penalty</td><td id="penaltyCount"></td></tr>
                                            </table>
                                        </div>
                                    </li>
                                </ul>
                                <ul class="collapsible index-summaries ">
                                    <li class="active">
                                        <div class="collapsible-header"><i class="material-icons">event_available</i>Available</div>
                                        <div class="collapsible-body">
                                            <table class="highlight" id="bedTypes"></table>
                                        </div>
                                    </li>
                                </ul>
                            </div>
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