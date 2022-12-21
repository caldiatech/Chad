@extends('layouts._admin.base')

@section('content')



  <article id="dashboard">
    <h2 class="line">Dashboard</h2>

    <div id="module_box">
      <h3></h3>
      <ul>

        <li><a href="page-management.php"> Page Management </a> <span>Manage your Pages</span></li>

        <li><a href="photo-management.php"> Photos Management </a> <span>Manage your Photos</span></li>

        <li><a href="staff-management.php"> Staff Management </a> <span>Manage your Staffs</span></li>

        <li><a href="contact-management.php"> Contact Management </a> <span>Manage your Contacts</span></li>

      </ul>
      <h3>Communication</h3>
      <ul>

      <li><a href="newsletter-management.php"> Newsletter Management </a> <span>Manage your Newsletter</span></li>

      <li><a href="news-management.php"> News and Events Management </a> <span>Manage your News and Events</span></li>

         <li><a href="whats-new-management.php"> Whats New Management </a> <span>Manage your Whats New</span></li>

        <li><a href="blogs-management.php"> Blogs Management </a> <span>Manage your Blogs</span></li>

        <li><a href="calendar-management.php"> Calendar Management </a> <span>Manage your Calendar</span></li>

      </ul>


      <h3>Products</h3>
      <ul>
             <li><a href="products-management.php"> Products Management </a> <span>Manage your Products</span></li>
      </ul>

       <h3>Marketing</h3>
      <ul>
       <li><a href="social-management.php"> Social Media Management </a> <span>Manage your Social Media</span></li>
      </ul>

      <h3>ACM Settings</h3>
      <ul>

        <li><a href="settings-management.php"> Administrator Management </a> <span>Manage your Administrator</span></li>

        <li><a href="website-management.php"> Website Settings Management </a> <span>Manage your Website Settings</span></li>
      </ul>


    </div>
  </article>
@stop

@section('headercodes')
  {{ HTML::script('assets/js/cufon_avantgarde.js') }}
  <script>
    Cufon.replace('h2.line');
    Cufon.now();
</script>
@stop
