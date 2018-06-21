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
                    <div class="row">
                        <div class="file-field input-field col m6 s12">
                            <a class="waves-effect waves btn right btn-1" href="" style="margin-left:5px;">
                                <i class="material-icons left">search</i>Search</a>
        
                            <div class="file-path-wrapper">
                                <input placeholder="Search Guest" class="file-path validate myinput" type="text" required />
                            </div>
                        </div>
                        <div class="input-field col m2 s12">
                            <select>
                                <option value="" disabled selected>Floor</option>
                                <?php
                                    for($i = 1 ; $i <= 11 ; $i++){
                                        echo "<option value=" . $i . ">" . $i . "</option>";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                   
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
        <!-- modals -->
        <?php require('pages/modals/roomTypes/addRoomType.php') ?>
        <?php require('pages/modals/roomTypes/deleteRoomType.php') ?>
    </footer>


</body>

<section class="jsIncludes">
    <?php require('jsInclude.php') ?>
</section>

</html>