    <section class="clean-block clean-form dark h-100">
        <div class="container" style="max-width: 500px;">
            <div class="block-heading" style="padding-top: 10px;">
                <h2 class="text-primary">Add to Wish List<br></h2>
            </div>
            <form action="wishcommands.php" method="post" enctype="multipart/form-data" role="form">
                <div class="form-group mb-3"><label class="form-label">Title</label><input class="form-control" type="text" id="Title" placeholder="Title for your wish" name="Title" required></div>
                <div class="form-group mb-3"><label class="form-label">Keyword 1*</label><input class="form-control" type="text" id="txtKeyword1" placeholder="Keyword" name="txtKeyword1" required></div>
                <div class="form-group mb-3"><label class="form-label">Keyword 2</label><input class="form-control" type="text" id="txtKeyword2" placeholder="Keyword" name="txtKeyword2"></div>
                <div class="form-group mb-3"><label class="form-label">Keyword 3</label><input class="form-control" type="text" id="txtKeyword3" placeholder="Keyword" name="txtKeyword3"></div>
                <div class="form-group mb-3"><label class="form-label">Keyword 4</label><input class="form-control" type="text" id="txtKeyword4" placeholder="Keyword" name="txtKeyword4"></div>

                <div class="form-group mb-3"><button class="btn btn-primary d-block w-100" type="submit" name="AddToWishlist" id="AddToWishlist"><i class="fas fa-save"></i>&nbsp;Add to Wishlist</button></div>
            </form>
        </div>
    </section>