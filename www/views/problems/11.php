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
                    <h1 class="title text-warning">Largest product in a grid</h1>
                    <hr />
                </div>
            </div>
        </div>

        <div class="col-md-6 col-md-offset-3">
            <div class="row text-center">
                <div class="col-xs-12">
                    <div class="grid monospace">
                        <!-- Print Grid with sequence highlighted -->
                        <?php foreach($grid as $i=>$row) {
                            foreach($row as $j=>$number) { ?>
                                <span id="<?php echo "$i-$j"; ?>"><?php echo $number; ?></span>
                            <?php } ?>
                            <br/>
                        <?php } ?>
                    </div>
                </div><!-- /.col-xs-12 -->
                <div class="col-xs-12">
                    <h3>
                        <?php echo implode(' * ', $largeSet['set']), ' = ', number_format($largeSetTotal); ?>
                    </h3>
                </div><!-- /.col-xs-12 -->
            </div><!-- /.row -->
        </div><!-- /.col-md-6 col-md-offset-3 -->
    </div><!-- /.row -->
</div>

<script type="text/javascript">
    <?php foreach($largeSet['xy'] as $xy) { ?>
        var id = '<?php echo $xy; ?>';
        $('#'+id).addClass('highlight-red');
    <?php } ?>
</script>

<?php
// Load page end
require_once APP_ROOT.'/inc/page_end.php';