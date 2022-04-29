<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="mb-2 row">
        <div class="col-sm-6">
          <h1 class="m-0">{{ $data['name'] }}</h1>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <div class="content">

    <!-- Default box -->
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">使用者清單</h3>

      </div>
      <div class="card-body p-0">
        <table class="table table-striped projects text-center">
          <thead>
            <tr>
              <th style="width: 10%">照片</th>
              <th style="width: 10%">姓名</th>
              <th style="width: 10%">身份</th>
              <th style="width: 20%">帳號</th>
              <th style="width: 20%">組別</th>
              <th style="width: 10%">電話</th>
              <th style="width: 8%">狀態</th>
              <th style="width: 20%">功能</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($data['users'] as $user )
            <tr>
              <td>
                {{ $user['photofile'] }}
              </td>
              <td>
                {{ $user['name'] }}
              </td>
              <td>
                {{ $user['role'] }}
              </td>
              <td>
                {{ $user['account'] }}
              </td>
              <td>
                {{ $user['team'] }}
              </td>
              <td>
                {{ $user['tel'] }}
              </td>
              <td>
                @if ($user['status']!=0)
                啟用
                @endif
              </td>
              <td class="project-actions text-right">
                <a class="btn btn-info btn-sm" href="{{ route('users.show', ['user'=> $user['id'] ] ) }}">
                  <i class="fas fa-pencil-alt">
                  </i>
                  Edit
                </a>
                <a class="btn btn-danger btn-sm" href="#">
                  <i class="fas fa-trash">
                  </i>
                  Delete
                </a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->

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