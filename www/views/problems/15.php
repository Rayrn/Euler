<?php
/* Login Form Display */
if(!defined('APP_ROOT')) {
    exit('No direct script access allowed');
}

// Load page head
require_once APP_ROOT.'/inc/page_begin.php';
?>

<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <div class="panel-heading">
               <div class="panel-title text-center">
                    <h1 class="title text-warning">Lattice Paths</h1>
                    <hr />
                </div>
            </div>
        </div>

        <div class="col-md-6 col-md-offset-3">
            <div class="row ">
                <div class="col-xs-12">
                    Number of paths in a <?php echo "$size x $size";?> grid: <?php echo number_format($paths); ?>
                </div><!-- /.col-xs-12 -->
            </div><!-- /.row -->
        </div><!-- /.col-md-6 col-md-offset-3 -->
    </div><!-- /.row -->
</div>

<?php
// Load page end
require_once APP_ROOT.'/inc/page_end.php';