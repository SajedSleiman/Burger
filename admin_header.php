<header class="header">

   <section class="flex">

      <a href="dashboard.php" class="logo">Admin<span>Panel</span></a>

      <nav class="navbar">
         <a href="dashboardd.php">home</a>
         <a href="productss.php">products</a>
         <a href="orders.php">orders</a>
         <a href="admin_accountss.php">admins</a>
         <a href="user_accounts.php">users</a>
      </nav>

      <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
         <div id="user-btn" class="fas fa-user"></div>
      </div>
     
      <div class="profile">
         <p></p>
             <div class="flex-btn">
            <a href="admin_login.php" class="option-btn">login</a>
            <a href="register_admin.php" class="option-btn">register</a>
         </div>
          <form action="../admin/admin_logout.php" method="post">
         <input type="submit" value="Logout" class="delete-btn">
         </form>
      </div>

   </section>

</header>