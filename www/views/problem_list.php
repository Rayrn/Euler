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
                    <h1 class="title text-warning">List of problems</h1>
                    <hr />
                </div>
            </div>
        </div>

        <div class="col-md-6 col-md-offset-3">
            <div class="row ">
                <div class="col-xs-12">
                    <ul class="list-group ul-striped">
                        <?php foreach($problems as $problem) { ?>
                            <li class="list-group-item">
                                <a href="/problems/<?php echo $problem['filename']; ?>" class="text-warning">
                                    Problem <?php echo $problem['filename']; ?>
                                    <i class="fa fa-chevron-right pull-right"></i>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </div><!-- /.col-xs-12 -->
            </div><!-- /.row -->
        </div><!-- /.col-md-6 col-md-offset-3 -->
    </div><!-- /.row -->
</div>

<?php
// Load page end
require_once APP_ROOT.'/inc/page_end.php';