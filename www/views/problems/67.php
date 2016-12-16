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
                    <h1 class="title text-warning">Maximum path sum II</h1>
                    <hr />
                </div>
            </div>
        </div>

        <div class="col-md-6 col-md-offset-3">
            <div class="row ">
                <div class="col-xs-12 text-center">
                    <?php foreach($pyramid as $index=>$row) { ?>
                        <?php if($index > 20) { break; } ?>
                        <div class="grid monospace">
                            <?php foreach($row as $number) {
                                echo $number.' ';
                            } ?>
                        </div>
                    <?php } ?>
                    <div class="grid monospace">
                    . . . etc
                    </div>
                </div><!-- /.col-xs-12 -->
                <div class="col-xs-12 text-center">
                     The maximum total from top to bottom of the triangle above is <?php echo number_format(end($dynamic_pyramid)[0]); ?>
                </div><!-- /.col-xs-12 -->
            </div><!-- /.row -->
        </div><!-- /.col-md-6 col-md-offset-3 -->
    </div><!-- /.row -->
</div>

<?php
// Load page end
require_once APP_ROOT.'/inc/page_end.php';