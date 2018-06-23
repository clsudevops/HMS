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
                    <div class="page-header valign-wrapper z-depth-1">
                        <h5>Guest Masterlist</h5>
                    </div>
                    <div class="row" style="margin-bottom:10px;">
                        <div class="file-field input-field col m6 s12">
                            <a class="btn right btn-1" id="searchGuest" style="margin-left:5px;">
                                <i class="material-icons left">search</i>Search</a>
        
                            <div class="file-path-wrapper">
                                <input placeholder="Search Guest" id="search" class="file-path validate myinput" type="text"/>
                            </div>
                        </div>
                    </div>
                    <table class="z-depth-2 centered highlight responsive-table guesttable">
                        <thead>
                            <tr>
                                <th>Guest ID</th>
                                <th>Name</th>
                                <th>Mobile</th>
                                <th>Room No</th>
                                <th>Floor</th>
                                <th>Checkin Date</th>
                                <th>Checkout Date</th>
                            </tr>
                        </thead>
                        <tbody id="guestTable">
                            
                        </tbody>
                    </table>
                    <!-- <ul class="pagination right">
                        <li class="disabled"><a href="#!"><i class="material-icons">chevron_left</i></a></li>
                        <li class="active"><a href="#!">1</a></li>
                        <li class="waves-effect"><a href="#!">2</a></li>
                        <li class="waves-effect"><a href="#!">3</a></li>
                        <li class="waves-effect"><a href="#!">4</a></li>
                        <li class="waves-effect"><a href="#!">5</a></li>
                        <li class="waves-effect"><a href="#!"><i class="material-icons">chevron_right</i></a></li>
                    </ul> -->
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
    <script type="text/javascript" src="includes/js/guest.js"></script>
</section>

</html>