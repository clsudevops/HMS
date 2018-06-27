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
                                    <p id="checkin" style="margin:30px 0px 5px 0px;"></p>
                                    <p id="checkout" style="margin:5px 0px;"></p>
                                </div>
                                <div class="extras">
                                    <h5 id="h5-extras">List of Extra's</h5>
                                    <div class="listofExtraContainer">
                                        <table class="highlight">
                                            <thead>
                                                <tr>
                                                    <th>Description</th>
                                                    <th>Quantity</th>
                                                    <th>Cost</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody id="addedExtraTable">
                                                 <!-- used js to populate this -->
                                            </tbody>
                                           
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col m5 s12 billing" style="padding-left:0px;">
                                <div class="card">
                                    <h5 class="billingheader">
                                        Bill
                                    </h5>
                                </div>
                            </div>
                            <div class="col m5 s12 billing" style="padding-right:0px;">
                                <div class="card">
                                    <h5 class="billingheader">
                                        Miscellaneous
                                    </h5>
                                </div>
                            </div>
                        </div>
                        <div class="col m4 s12">
                            <div style="margin-top:7.5px;">
                                <ul class="collapsible index-summaries ">
                                    <li class="active">
                                        <div class="collapsible-header"><i class="material-icons">extension</i>Extra's</div>
                                        <div class="collapsible-body">
                                            <div class="extraDivContainer">
                                                <table class="highlight" id="extraListTable">
                                                    <!-- used js to populate this -->
                                                </table>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                               
                                <ul class="collapsible index-summaries">
                                    <li class="active">
                                        <div class="collapsible-header"><i class="material-icons">restaurant_menu</i>Miscellaneous</div>
                                        <div class="collapsible-body">
                                            <!-- <table class="highlight" id="bedTypes"></table> -->
                                            
                                        </div>
                                    </li>
                                </ul>
                                <ul class="collapsible index-summaries">
                                    <li class="active">
                                        <div class="collapsible-header"><i class="material-icons">exit_to_app</i>Checkout Date</div>
                                        <div class="collapsible-body">
                                            <table class="highlight updateCheckoutTable" style="margin-top:10px;">
                                                <tr>
                                                    <td>Date:</td>
                                                    <td><input id="checkOutUpdate" placeholder="" type="text" class="datepicker" style="height:36px; line-height:36px;"></td>
                                                </tr>
                                                <tr>
                                                    <td>Time:</td>
                                                    <td><input id="checkOutUpdate" placeholder="" type="text" class="datepicker" style="height:36px; line-height:36px;"></td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td>
                                                        <a class="btn right btn-1" id="submitRoom" style="margin-left:5px; height:36px; line-height:36px;">
                                                            <i class="material-icons left" style="margin-right:10px;">
                                                                save
                                                            </i>
                                                            Save
                                                        </a>
                                                    </td>
                                                </tr>
                                            </table>
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