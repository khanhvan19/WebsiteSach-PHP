<div class="header row  bg-dark text-white">
    <div class="d-flex align-items-center justify-content-end">
        <div class="me-3 text-white">
            <img src="<?php echo '../img/avatar/' . $_SESSION['avatar'] . ''; ?>" 
            alt="avatar " height="38px " class="border border-2 border-primary rounded-circle ">
            <span>
                Hello
                <?php
                echo '<b>' . $_SESSION['adName'] . '</b>';
                ?>
            </span>
        </div>
        <div>
            <a href="?logout=yes" class="btn btn-outline-warning ">Logout</a>
        </div>
    </div>
    
</div>