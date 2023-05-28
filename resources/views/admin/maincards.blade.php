<main class="mt-5 pt-3">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12 fw-bold">
          <h4>{{ Auth::user()?->name }} Dashboard</h4>
        </div>
      </div>
      <div class="row">
        <div class="col-md-3 mb-3">
          <div class="card bg-primary text-white h-100" style="background-image: url(../../assets/dashboardimages/yang1.png);">
           
            <div class="card-body py-5 fw-bold">Sports Teams</div>
            <div class="card-footer d-flex fw-bold">
              View Details
              <span class="ms-auto">
                <i class="bi bi-chevron-right"></i>
              </span>
            </div>
          </div>
        </div>
        <div class="col-md-3 mb-3">
          {{-- <a href="{{ route('addboardMember') }}"> --}}
            <div class="card bg-warning text-dark h-100 fw-bold" style="background-image: url(../../assets/dashboardimages/tff.png);">
              <div class="card-body py-5">Board Members</div>
              <div class="card-footer d-flex">
                View Details
                <span class="ms-auto">
                  <i class="bi bi-chevron-right"></i>
                </span>
              </div>
            </div>
          </a>
        </div>
        <div class="col-md-3 mb-3">
          <div class="card bg-success text-white h-100 fw-bold" style="background-image: url(../../assets/dashboardimages/board1.png);">
            <div class="card-body py-5">Pitches and Stadiums</div>
            <div class="card-footer d-flex">
              View Details
              <span class="ms-auto">
                <i class="bi bi-chevron-right"></i>
              </span>
            </div>
          </div>
        </div>
        <div class="col-md-3 mb-3">
          <div class="card bg-danger text-white h-100 fw-bold" style="background-image: url(../../assets/dashboardimages/refree.png);">
            <div class="card-body py-5">Referees</div>
            <div class="card-footer d-flex">
              View Details
              <span class="ms-auto">
                <i class="bi bi-chevron-right"></i>
              </span>
            </div>
          </div>
        </div>
      </div>
      
