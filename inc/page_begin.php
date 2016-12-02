<?php 
/* Full page begin file  */
if(!defined('APP_ROOT')) {
    exit('No direct script access allowed');
}

/* Extends clean page begin with menu options */
require_once APP_ROOT.'/inc/clean_page_begin.php';
?>
<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#siteNav">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span> 
        </button>
        <div class="navbar-header">
            <a class="navbar-brand" href="/"><?php echo SITE_BRAND; ?></a>
        </div>
        <div class="collapse navbar-collapse" id="siteNav">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="logout"><span class="fa fa-sign-out"></span>&nbsp;Logout</a></li>
            </ul>
        </div>
    </div>
</nav>