<?php
if(!defined('includedie')){die(header( 'Location: '.$url ));}
echo '<div class="sidebar">';
echo 'Navigation:<br><br>';
echo '<a href="'.$url.'" title="Home" class="sidebarBox">Home</a>';
echo '<a href="'.$url.'/admin/admin.php" class="sidebarBox">Dashboard</a>';
if(is_admin($username)){
echo '<a href="'.$url.'/admin/admin-update.php" class="sidebarBox">Updates</a>';
echo '<a href="'.$url.'/admin/admin-options.php" class="sidebarBox">Options</a>';
echo '<a href="'.$url.'/admin/admin-navigation.php" class="sidebarBox">Navigation</a>';
}
echo '<a href="'.$url.'/admin/admin-content.php" class="sidebarBox">Content</a>';
if(is_admin($username)){
echo '<a href="'.$url.'/admin/admin-pages.php" class="sidebarBox">Pages</a>';
echo '<a href="'.$url.'/admin/admin-themes.php" class="sidebarBox">Themes</a>';
echo '<a href="'.$url.'/admin/admin-theme.php" class="sidebarBox">'.$currenttheme.' Options</a>';
echo '<a href="'.$url.'/admin/admin-users.php" class="sidebarBox">Manage Users</a>';}
echo '<a href="'.$url.'/admin/admin-account.php" class="sidebarBox">My Account</a>';
echo '</div>';
?>
