

<div class="nav-mobile-wrap">  
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"></button>
    </div>

    
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div  class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

      <ul class="nav navbar-nav">
        <li>

          <a href="#"  data-toggle="collapse" data-target="#bs-example-navbar-collapse-2">Account <b class="caret"></b> <i class="glyphicon glyphicon-cog"></i></a>

          <div  class="collapse" id="bs-example-navbar-collapse-2">
            <ul class="sub-nav">
              <li><a href="<?=$ROOT_URL?>dashboard/account-settings.html">Account Settings</a></li>
              <li><a href="<?=$ROOT_URL?>dashboard/subscription.html">My Subscription</a></li>
            </ul>
          </div>

        </li>
  
        <li><a href="<?=$ROOT_URL?>dashboard.html">dashboard  <i class="glyphicon glyphicon-dashboard"></i></a></li>
        <li><a href="<?=$ROOT_URL?>dashboard/calendar.html">calendar  <i class="glyphicon glyphicon-calendar"></i></a></li>
        <li><a href="<?=$ROOT_URL?>dashboard/games.html">my games  <i class="glyphicon glyphicon-record"></i></a></li>
        <li><a href="<?=$ROOT_URL?>dashboard/favorites.html">favorites  <i class="glyphicon glyphicon-thumbs-up"></i></a></li>
        <li><a href="<?=$ROOT_URL?>dashboard/invitations.html">invitations  <i class="glyphicon glyphicon-envelope"></i></a></li>
        <li><a href="<?=$ROOT_URL?>dashboard/profile.html">my profile  <i class="glyphicon glyphicon-user"></i></a></li>

        <li><a href="<?=$ROOT_URL?>logout.php">Logout  <i class="glyphicon glyphicon-off"></i></a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
</div>
