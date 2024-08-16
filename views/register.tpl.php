<?php require_once __DIR__ . '/inc/header.php' ?>


<header class="header d-flex justify-content-center">
        <div class="container">
            <div class="row h-100 align-items-center">
                <div class="col-md-5 d-none d-md-block mx-auto">
            
                
                <?php if(isset($_SESSION['success'])): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?php
                        echo $_SESSION['success'];
                        unset($_SESSION['success']);
                        ?>
                        
                    </div>
                <?php endif; ?>
                    <form method="post" class="header-form">
                            <?php if(isset($_SESSION['errors'])): ?>
                                <div data="aler" class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <?php
                                  
                                    echo($_SESSION['errors']);
                                    unset($_SESSION['errors']);
                                    
                                    ?>
                                </div>
                                
                            <?php endif; ?>
                        <div class="head">Try your <span class="text-primary">Free</span> trial today.</div>
                        <div class="body">
                            <div class="form-group">
                                <input name="name" type="text" class="form-control" placeholder="Name*">
                            </div>
                            <div class="form-group">
                                <input name="email" type="email" class="form-control" placeholder="Email*">
                            </div>
                            <div class="form-group">
                                <input name="password" type="password" class="form-control" placeholder="Password*">
                            </div>
                        </div>
                        <div class="footer">
                            <button type="submit" class="btn btn-primary btn-block">Get Started</button>
                        </div>
                    </form> 
                </div>
            </div>  
        </div>
</header>  



<?php require_once __DIR__ . '/inc/footer.php' ?>