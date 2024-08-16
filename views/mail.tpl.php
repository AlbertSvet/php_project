<?php require_once __DIR__ . '/inc/header.php'; ?>

<section class="section" id="contact">
        <div class="container text-center">
            <h6 class="display-4 has-line">
                <p>
                    Добро пожаловать, <span style="font-size: 22px;" class="text-danger"><?= $_SESSION['user']['name']; ?>!</span>
                </p>
            </h6>
            <p class="mb-5 pb-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
            
            <form  id="form">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="form-group pb-1">
                        
                            <input 
                            data="inp"
                            name="name"
                            type="name" 
                            class="form-control" 
                            required placeholder="Name"
                            value="<?= h($_SESSION['user']['name']) ?>"
                            >            
                        </div>
                        <div class="form-group pb-1">
                            <input 
                            data="inp"
                            name="email"
                            type="email" 
                            class="form-control" 
                            required placeholder="Email"
                            value=" <?php echo $_SESSION['user']['email'] ?>"
                            >          
                        </div>
                      
                    </div>
                    <div class="col-md-6">
                        <textarea name="message" data="inp" cols="" rows="7" class="form-control" required placeholder="Message"></textarea>
                    </div>
                </div>
                <button class="btn btn-primary btn-block">Отправить</button>
            
            </form>
        </div>
    </section>

<?php require_once __DIR__ . '/inc/footer.php'; ?>