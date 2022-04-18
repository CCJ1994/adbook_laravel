<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper kanban">

  <!-- Main content -->
  <div class="content p-3">
    <div class="card card-success h-100">
      <div class="card-header">
        <h3 class="card-title">
          {{ $data['name'] }}
        </h3>
      </div>
      <div class="card-body p-3 overflow-auto">
          @if ( !empty($data['bboard']))
          @foreach ( $data['bboard'] as $bboard)
          <div class="card card-danger card-outline">
          <div class="card-header">
            <h3 class="card-title">{{ $bboard['topic'] }}</h3>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
          {!! $bboard['content'] !!}
          </div>
        </div>
          @endforeach
          @else
            目前無公告
          @endif


      </div>
    </div>
  </div>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
  <!-- Control sidebar content goes here -->
  <div class="p-3">
    <h5>Title</h5>
    <p>Sidebar content</p>
  </div>
</aside>
<!-- /.control-sidebar -->
