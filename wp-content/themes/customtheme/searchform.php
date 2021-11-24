
<section class="page-wrap">
    <div class="row py-5">
        <div class="d-flex align-items-center col-8 col-md-8 text-center text-md-left">
         <h1 class="Honepage-h1 py-4"><?php the_title();?></h1>
    </div>

    <div class="col-md-4 pt-3 text-right mb-3 mb-md-0 d-none d-md-block">
        <div class="w-100 d-none d-md-block" style="margin-left: auto;">
            <form action="/" method="GET">
                <div class="d-flex">
                    <input id="search" class="bg primary p-2 pl-3 border-dark" name="s" placeholder="Search..." autocomplete="off" value="<?php the_search_query();?>" required>
                    <button type="submit" class="btn btn-primary border-dark border-left-0 flex-grow-5">
                        <span class="sr-only">Search</span>
                        <span class="dashicons dashicons-search"></span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</sectione>