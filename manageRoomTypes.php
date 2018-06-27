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
            <div class="col s12">
                <div class="card-1">
                    <div class="page-header valign-wrapper z-depth-1">
                        <h5>Manage Room Types</h5>
                    </div>
                    <div class="row" style="margin-top:20px;">
                        <div class="col s12 m6">
                            <div class="file-field input-field col m12 s12" style="padding-left:0px; padding-right:0px;">
                                <a class="btn right btn-1" id="searchRoomType" style="margin-left:5px; height:36px; line-height:36px;">
                                    <i class="material-icons left">search</i>Search</a>
            
                                <div class="file-path-wrapper">
                                    <input style="height:36px; line-height:36px;" placeholder="Search Room Type" id="search" class="file-path validate myinput" type="text"/>
                                </div>
                            </div>
                            <table class="z-depth-2 highlight roomTypeTable">
                                <thead>
                                    <tr>
                                        <th>Type</th>
                                        <th>Adult</th>
                                        <th>Children</th>
                                        <th style="width:23%;">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="roomTypeTable">
                                    
                                </tbody>
                            </table>
                        </div>

                        <div class="col s12 m6">
                            <div class="input-field col s12 m12" style="margin-bottom:0px;">
                                <label>Name:</label>
                                <input name="typeName" style="height:36px; line-height:36px;" id="typeName" type="text" class="validate" required>
                            </div>
                            <div class="input-field col s12 m4" style="margin-bottom:0px;">
                                <label>Max Adult:</label>
                                <input name="maxAdult" style="height:36px; line-height:36px;" id="maxAdult" type="number" class="validate" required>
                            </div>
                            <div class="input-field col s12 m4" style="margin-bottom:0px;">
                                <label>Max Children:</label>
                                <input name="maxChildren" style="height:36px; line-height:36px;" id="maxChildren" type="number" class="validate" required>
                            </div>
                            <div class="input-field col s12 m4">
                                <a class="btn right btn-1" id="submitRoomType" style="margin-left:5px; height:36px; line-height:36px;">
                                    <i class="material-icons left" style="margin-right:10px;">
                                        send
                                    </i>
                                    Submit
                                </a>
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
        <!-- modals -->
    </footer>
    
</body>

<section class="jsIncludes">
    <?php require('jsInclude.php') ?>
    <script type="text/javascript" src="includes/js/manageRoomTypes.js"></script>
</section>

</html>