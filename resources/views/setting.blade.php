<!-- Main Content -->
<div class="main-content">
        <section class="section">
          <div class="section-header">
            <div class="section-header-back">
              <a href="{{ url ('home/dashboard') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1> Settings</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
              <div class="breadcrumb-item active"><a href="#">Settings</a></div>
              <!-- <div class="breadcrumb-item"> Settings</div> -->
            </div>
          </div>

          <form action="{{ route ('aksi_e_setting') }}" method="POST" enctype="multipart/form-data">
            @csrf
          <div class="section-body">
            <h2 class="section-title">All About Settings</h2>
            <p class="section-lead">
              You can adjust all settings here
            </p>

            <div id="output-status"></div>
            <div class="row">
              <!-- <div class="col-md-4">
                <div class="card">
                  <div class="card-header">
                    <h4>Jump To</h4>
                  </div>
                  <div class="card-body">
                    <ul class="nav nav-pills flex-column">
                      <li class="nav-item"><a href="#" class="nav-link active">General</a></li>
                      <li class="nav-item"><a href="#" class="nav-link">SEO</a></li>
                      <li class="nav-item"><a href="#" class="nav-link">Email</a></li>
                      <li class="nav-item"><a href="#" class="nav-link">System</a></li>
                      <li class="nav-item"><a href="#" class="nav-link">Security</a></li>
                      <li class="nav-item"><a href="#" class="nav-link">Automation</a></li>
                    </ul>
                  </div>
                </div>
              </div> -->
              <div class="col-md-8">
                <form id="setting-form">
                  <div class="card" id="settings-card">
                    <div class="card-header">
                      <h4>Settings</h4>
                    </div>
                    <div class="card-body">
                      <p class="text-muted">General settings such as, site title, site description, address and so on.</p>
                      <div class="form-group row align-items-center">
                        <label for="site-title" class="form-control-label col-sm-3 text-md-right">Nama Web</label>
                        <div class="col-sm-6 col-md-9">
                          <input type="text" name="nama_web" value ="<?= $setting->nama_web ?>" class="form-control" id="site-title">
                        </div>
                      </div>
                      <!-- <div class="form-group row align-items-center">
                        <label for="site-description" class="form-control-label col-sm-3 text-md-right">Site Description</label>
                        <div class="col-sm-6 col-md-9">
                          <textarea class="form-control" name="site_description" id="site-description"></textarea>
                        </div>
                      </div> -->
                      <div class="form-group row align-items-center">
                        <label class="form-control-label col-sm-3 text-md-right">Logo Dashboard</label>
                        <div class="col-sm-6 col-md-9">
                          <div class="custom-file">
                            <input type="file" name="logo_dashboard" class="custom-file-input" id="site-logo">
                            <label class="custom-file-label"></label>
                          </div>
                          <div class="form-text text-muted">The image must have a maximum size of 1MB</div>
                        </div>
                      </div>
                      <div class="form-group row align-items-center">
                        <label class="form-control-label col-sm-3 text-md-right">Logo Tab</label>
                        <div class="col-sm-6 col-md-9">
                          <div class="custom-file">
                            <input type="file" name="logo_tab" class="custom-file-input" id="site-favicon">
                            <label class="custom-file-label"></label>
                          </div>
                          <div class="form-text text-muted">The image must have a maximum size of 1MB</div>
                        </div>
                      </div>
                      <div class="form-group row align-items-center">
                        <label class="form-control-label col-sm-3 text-md-right">Logo Login</label>
                        <div class="col-sm-6 col-md-9">
                          <div class="custom-file">
                            <input type="file" name="logo_login" class="custom-file-input" id="site-favicon">
                            <label class="custom-file-label"></label>
                          </div>
                          <div class="form-text text-muted">The image must have a maximum size of 1MB</div>
                        </div>
                      </div>
                      <!-- <div class="form-group row">
                        <label class="form-control-label col-sm-3 mt-3 text-md-right">Google Analytics Code</label>
                        <div class="col-sm-6 col-md-9">
                          <textarea class="form-control codeeditor" name="google_analytics_code"></textarea>
                        </div>
                      </div> -->
                    </div>
                    <div class="card-footer bg-whitesmoke text-md-right">
                      <button type="submit" class="btn btn-primary" id="save-btn">Save Changes</button>
                      <!-- <button class="btn btn-secondary" type="button">Reset</button> -->
                    </div>
                  </div>
                </form>
              </div>
            </div>
  		    </div>
      	</section>
      </div>