<!-- /.control-sidebar -->
@extends('layouts.layout')

@section('head')
@parent
<!-- SweetAlert2 -->
<link rel="stylesheet" href="{{ asset('assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
<!-- Toastr -->
<link rel="stylesheet" href="{{ asset('assets/plugins/toastr/toastr.min.css')}}">
@endsection

@section('title', $data['name'])

@section('content')

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
      <div class="card-header d-flex align-items-center">
        <h3 class="card-title">使用者清單</h3>
        <!-- Button trigger modal -->
        <button class="ml-2 btn btn-info btn-sm" data-toggle="modal" data-target="#exampleModal">
          <i class="fas fa-plus"></i>
          Add
        </button>
      </div>
      <div class="p-0 card-body">
        <table class="table text-center table-striped projects">
          <thead>
            <tr>
              <th style="width: 10%">照片</th>
              <th style="width: 10%">姓名</th>
              <th style="width: 10%">職位</th>
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
                @if (!empty($user['photofile']))

                <img alt="Avatar" class="table-avatar" src="{{ asset('/storage/images/'.$user['photofile']) }}">
                @else
                <img alt="Avatar" class="table-avatar" src="{{ asset('assets/dist/img/user4-128x128.jpg') }}">
                @endif
              </td>
              <td>
                {{ $user['name'] }}
              </td>
              <td>
                @foreach ($data['roles'] as $role)
                @if ($role['id']==$user['role'])
                {{ $role['role'] }}
                @endif
                @endforeach
              </td>
              <td>
                {{ $user['account'] }}
              </td>
              <td>
                @foreach ($data['teams'] as $team)
                @if ($team['id']==$user['team'])
                {{ $team['team'] }}
                @endif
                @endforeach
              </td>
              <td>
                {{ $user['tel'] }}
              </td>
              <td>
                @if ($user['status']!=0)
                啟用
                @endif
              </td>
              <td class="text-right project-actions">
                <a class="btn btn-primary btn-sm" href="{{ route('users.show', ['user'=> $user['id'] ] ) }}">
                  <i class="fas fa-folder">
                  </i>
                  View
                </a>
                @if ($user['role']!=13)
                <a class="btn btn-danger btn-sm" href="#">
                  <i class="fas fa-trash">
                  </i>
                  Delete
                </a>
                @endif
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


  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">新增使用者</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

          <form class="form-horizontal" action="{{ route('users.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group row">
              <label for="inputName" class="col-sm-2 col-form-label">姓名</label>
              <div class="col-sm-10">
                <input type="text" name="name" class="form-control" id="inputName" placeholder="姓名">
              </div>
            </div>
            <div class="form-group row">
              <label for="inputEmail" class="col-sm-2 col-form-label">信箱</label>
              <div class="col-sm-10">
                <input type="email" name="email" class="form-control" id="inputEmail" placeholder="電子郵件">
              </div>
            </div>
            <div class="form-group row">
              <label for="inputPwd" class="col-sm-2 col-form-label">密碼</label>
              <div class="col-sm-10">
                <input type="password" name="password" class="form-control" id="inputPwd" placeholder="密碼">
              </div>
            </div>
            <div class="form-group row">
              <label for="inputPwd2" class="col-sm-2 col-form-label">再輸入密碼</label>
              <div class="col-sm-10">
                <input type="password" name="password_confirmation" class="form-control" id="inputPwd2"
                  placeholder="密碼">
              </div>
            </div>
            <div class="form-group row">
              <label for="inputTel" class="col-sm-2 col-form-label">電話</label>
              <div class="col-sm-10">
                <input type="text" name="tel" class="form-control" id="inputTel" placeholder="電話">
              </div>
            </div>
            <div class="form-group row">
              <label for="inputTeam" class="col-sm-2 col-form-label">組別</label>
              <div class="col-sm-10">
                <select class="form-control" name="team" id="inputTeam">
                  <option value="">請選擇</option>
                  @foreach ($data['teams'] as $team)
                  <option value="{{ $team['id'] }}">{{ $team['team'] }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="form-group row">
              <label for="inputRole" class="col-sm-2 col-form-label">職稱</label>
              <div class="col-sm-10">
                <select class="form-control" name="role" id="inputRole">
                  <option value="">請選擇</option>
                </select>
              </div>
            </div>
            <div class="form-group row">
              <label for="inputStatus" class="col-sm-2 col-form-label">狀態</label>
              <div class="col-sm-10">
                <select class="form-control" name="status" id="inputStatus">
                  <option value="">請選擇</option>
                  <option value="0">停用</option>
                  <option value="1">啟用</option>

                </select>
              </div>
            </div>
            <div class="form-group row">
              <label for="inputFile" class="col-sm-2 col-form-label">照片</label>
              <div class="col-sm-10">
                <input type="file" name="photofile" class="form-control-file" id="inputFile">
              </div>
            </div>

            <div>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">取消</button>
              <input type="submit" class="btn btn-primary" value="新增">
            </div>
          </form>
        </div>
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
@endsection

@section('scripts')
@parent
<!-- SweetAlert2 -->
<script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<!-- Toastr -->
<script src="{{ asset('assets/plugins/toastr/toastr.min.js')}}"></script>
<script>
var teamsAry = <?=json_encode($data['teams']);?>;
var rolesAry = <?=json_encode($data['roles']);?>;
$(document).ready(function() {
  $("select[name='team']").change(function() {
    let team = $("select[name='team']").val();
    $("select[name='role']").html("");
    if (team != "") {
      if (team == 1) { //無組別
        Object.entries(rolesAry).forEach(([key, value]) => {
          if (value.id >= 9) {
            $("select[name='role']").append($('<option>', {
              value: value.id,
              text: value.role
            }));
          }
        });
      } else if (team == 2) { //策略中心
        Object.entries(rolesAry).forEach(([key, value]) => {
          if (value.id >= 5 && value.id <= 8) {
            $("select[name='role']").append($('<option>', {
              value: value.id,
              text: value.role
            }));
          }
        });
      } else {
        Object.entries(rolesAry).forEach(([key, value]) => {
          if (value.multiple == "Y") {
            $("select[name='role']").append($('<option>', {
              value: value.id,
              text: value.role
            }));
          }
        });
      }
    } else {
      $("select[name='role']").append($('<option>', {
        value: "",
        text: "請選擇"
      }));
    }
  });
});

var Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 5000
});
var errMsg="";
var hasErr = '<?=$errors->any();?>' ;
let errStr="";
if(hasErr){
  let errors = <?=json_encode($errors->all())?>;
  errStr='<ul class="mt-3 text-sm list-disc list-inside text-danger">';
  errors.forEach(element => {
    errStr += '<li>' + element + '</li>';
  });
  errStr += '</ul>';
  Toast.fire({
    icon: 'error',
    title: errStr
  })
}

</script>
@endsection