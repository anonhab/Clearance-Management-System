@include('partials.header')
@include('partials.sidebar')
<section class="home">
  <div class="container">
    <main>
      <h1>Dashboard</h1>
      <div class="insights">
        <!-- SALES -->
        <div class="sales">
          <span class="material-icons-sharp">analytics</span>
          <div class="middle">
            <div class="left">
              <h3>Total Employees</h3>
              <h1>{{ count($employees) }}</h1>
            </div>
          </div>
          <small class="text-muted">Last 24 hours</small>
        </div>

        <!-- EXPENSES -->
        <div class="expenses">
          <span class="material-icons-sharp">bar_chart</span>
          <div class="middle">
            <div class="left">
              <h3>Total Bosses</h3>
              <h1>{{ count($bosses) }}</h1> <!-- Assuming there is a $bosses array -->
            </div>
          </div>
          <small class="text-muted">Last 24 hours</small>
        </div>

        <!-- INCOME -->
        <div class="income">
          <span class="material-icons-sharp">stacked_line_chart</span>
          <div class="middle">
            <div class="left">
              <h3>Total Stakeholders</h3>
              <h1>{{ count($stakeholders) }}</h1> <!-- Assuming there is a $stakeholders array -->
            </div>
          </div>
          <small class="text-muted">Last 24 hours</small>
        </div>

        <!-- LOCATIONS -->
        <div class="income">
          <span class="material-icons-sharp">stacked_line_chart</span>
          <div class="middle">
            <div class="left">
              <h3>Total Locations</h3>
              <h1>{{ count($locations) }}</h1> <!-- Assuming there is a $locations array -->
            </div>
          </div>
          <small class="text-muted">Last 24 hours</small>
        </div>

        <!-- STAKEHOLDER LOCATIONS -->
        <div class="income">
          <span class="material-icons-sharp">stacked_line_chart</span>
          <div class="middle">
            <div class="left">
              <h3>Stakeholder Locations</h3>
              <h1>{{ count($stakeholderLocations) }}</h1> <!-- Assuming there is a $stakeholderLocations array -->
            </div>
          </div>
          <small class="text-muted">Last 24 hours</small>
        </div>
      </div>

    </main>
  </div>
</section>
</body>
<script src="./index.js"></script>
<script src="su/script.js"></script>

</html>