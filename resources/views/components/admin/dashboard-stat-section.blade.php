<div>
    <!-- Info boxes -->
    <div class="row">
      <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box">
          <span class="info-box-icon bg-info elevation-1"><i class="fas fa-briefcase"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Business</span>
            <span class="info-box-number">
              {{ $stats['businessTotal'] }}
              {{-- <small>%</small> --}}
            </span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      <div class="col-12 col-sm-6 col-md-3">
        <a href="javascript:void(0)" style="cursor: pointer">
          <div class="info-box mb-3">
            <span class="info-box-icon bg-danger elevation-1"><i class="fab fa-pagelines"></i></span>
  
            <div class="info-box-content">
              <span class="info-box-text">Product</span>
              <span class="info-box-number">{{ $stats['productTotal'] }}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
        </a>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->

      <!-- fix for small devices only -->
      <div class="clearfix hidden-md-up"></div>

      <div class="col-12 col-sm-6 col-md-3">
        <a href="{{ route('administrator.owner.view') }}" style="cursor: pointer">
          <div class="info-box mb-3">
            <span class="info-box-icon bg-success elevation-1"><i class="fas fa-user-tie"></i></span>
  
            <div class="info-box-content">
              <span class="info-box-text">Seller</span>
              <span class="info-box-number">{{ $stats['sellerTotal'] }}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
        </a>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      <div class="col-12 col-sm-6 col-md-3">
        <a href="javascript:void(0)" style="cursor: pointer">
          <div class="info-box mb-3">
            <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>
  
            <div class="info-box-content">
              <span class="info-box-text">Total Client</span>
              <span class="info-box-number">{{ $stats['buyerTotal'] }}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
        </a>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
</div>