<?php
    $lib = new Property(); $res = $lib->get();
?>

<li><a><i class="fa fa-bars"></i> Menu <span class="fa fa-chevron-down"></span></a>
    <ul class="nav child_menu" style="display: none">
        <li><a href="<?php echo site_url('frontmenu'); ?>"> Front Menu</a> </li>
        <li><a href="<?php echo site_url('adminmenu'); ?>"> Admin menu</a> </li>
    </ul>
</li>
<li><a><i class="fa fa-gear"></i> Configuration <span class="fa fa-chevron-down"></span></a>
    <ul class="nav child_menu" style="display: none">
        <li><a href="<?php echo site_url('admin'); ?>">Web Admin</a></li>
       <li><a href="<?php echo site_url('component'); ?>">Component Manager</a></li>
       <li><a href="<?php echo site_url('widget'); ?>">Widget List</a></li>
       <li><a href="<?php echo site_url('log'); ?>">History</a></li>
       <li><a href="<?php echo site_url('roles'); ?>">Role</a></li>
       <li><a href="<?php echo site_url('configuration'); ?>">Global Configuration</a></li>
       <li><a href="<?php echo $res['email_link']; ?>" target="_blank"> Web - Mail </a> </li>
    </ul>
</li>

<li><a id="blogout"><i class="fa fa-power-off"></i> log Out</a>