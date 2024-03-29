<!-- /.control-sidebar -->
@extends('layouts.layout')

@section('head')
@parent
<!-- SweetAlert2 -->
<link rel="stylesheet" href="{{ asset('assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
@endsection

@section('title', $data['title'])

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper kanban">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="mb-2 row">
        <div class="col-sm-6">
          <h1 class="m-0">{{ $data['title'] }}</h1>
        </div><!-- /.col -->
        <!-- Search Form -->
        <div class="col-sm-6">
          <div id="users_search" class="input-group">
            <input type="search" class="form-control" placeholder="輸入關鍵字">
            <div class="input-group-append">
              <button id="search_btn" type="button" class="btn btn-default">
                <i class="fa fa-search"></i>
              </button>
            </div>
          </div>
          <div class="sidebar-search-results" style="z-index:5;">
            <div class="list-group">
              <div id="result-item" class="overflow-auto" style="max-height:500px;">
                <div id="loading" class="text-center list-group-item d-none">
                  <div class="spinner-border" role="status">
                    <span class="visually-hidden"></span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <div class="pb-3 content">

    <!-- Default box -->
    <div class="card h-100">
      <div class="card-header d-flex align-items-center">
        <h3 class="card-title">使用者清單</h3>
        @if (Auth::user()->role==13)
        <!-- Button trigger modal -->
        <button class="ml-2 btn btn-info btn-sm" data-toggle="modal" data-target="#addModal">
          新增
          <i class="fas fa-plus"></i>
        </button>
        @endif
      </div>
      <div class="overflow-auto card-body">
        <table class="table text-center table-striped projects">
          <thead>
            <tr>
              <th style="width: 10%">照片</th>
              <th style="width: 10%">姓名</th>
              <th style="width: 10%">職位</th>
              <th style="width: 20%">信箱</th>
              <th style="width: 20%">組別</th>
              <th style="width: 10%">電話</th>
              <th style="width: 8%">狀態</th>
              @if (Auth::user()->role == 13)
              <th style="width: 20%"></th>
              @endif
            </tr>
          </thead>
          <tbody>
            @if (!empty($data['users']['data']))
            @foreach ($data['users']['data'] as $user )
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
                {{ $user['email'] }}
              </td>
              <td>
                @foreach ($data['teams'] as $key => $team)
                @if ( $key ==$user['team'])
                {{ $team }}
                @endif
                @endforeach
              </td>
              <td>
                {{ $user['tel'] }}
              </td>
              <td>
                @if ($user['status']!=0)
                啟用
                @else
                停用
                @endif
              </td>
              @if (Auth::user()->role == 13)
              <td class="project-actions">
                <a class="btn btn-primary btn-sm" href="{{ route('users.show', ['user'=> $user['id'] ] ) }}">
                  查看
                  <i class="fas fa-eye"></i>
                </a>
              </td>
              @endif
            </tr>
            @endforeach
            @else
            <tr>
              <td colspan="8">目前無使用者</td>
            </tr>
            @endif
          </tbody>
        </table>
      </div>
      <!-- /.card-body -->
      <!-- pagination -->
      @if (!empty($data['users']['data']))
      <div class="card-tools">
        <ul class="mt-3 pagination pagination-sm justify-content-center">
          @foreach ($data['users']['links'] as $page)
          @if ( $page['label']=='pagination.previous' && !empty($page['url']) )
          <li class="page-item"><a href="{{ $page['url'] }}" class="page-link">&laquo;</a></li>
          @elseif ( $page['label']=='pagination.next' && !empty($page['url']) )
          <li class="page-item"><a href="{{ $page['url'] }}" class="page-link">&raquo;</a></li>
          @elseif ( is_numeric($page['label']) )
          <li class="page-item"><a href="{{ $page['url'] }}" class="page-link">{{ $page['label'] }}</a></li>
          @endif
          @endforeach
        </ul>
      </div>
      @endif
      <!-- /pagination -->
    </div>
    <!-- /.card -->
  </div>


  <!-- Modal -->
  <div class="modal fade" id="addModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">新增使用者</h5>
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
                  <option value="0">請選擇</option>
                  @foreach ($data['teams'] as $key => $team)
                  <option value="{{ $key }}">{{ $team }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="form-group row">
              <label for="inputRole" class="col-sm-2 col-form-label">職稱</label>
              <div class="col-sm-10">
                <select class="form-control" name="role" id="inputRole">
                  <option value="0">請選擇</option>
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
            <div class="text-right">
              <input type="submit" class="btn btn-primary" value="新增">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">取消</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection

@section('scripts')
@parent
<!-- SweetAlert2 -->
<script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('assets/dist/js/adbook.js') }}"></script>
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
        value: "0",
        text: "請選擇"
      }));
    }
  });

  const searchIpt = $('#users_search input');
  const searchBtn = $('#search_btn');
  const searchPath = 'users';
  $(searchBtn).click(function() {
    if (searchBtn.find("i").hasClass("fa-times")) {
      searchBtn.html('<i class="fa fa-search"></i>');
      $('.sidebar-search-results').hide();
      $('#loading').hide();
      searchIpt.val('');
    } else {
      search(searchPath);
    }
  });
  $(searchIpt).keyup(function(event) {
    if (event.keyCode == 13) {
      search(searchPath);
    } else if (searchIpt.val() == "") {
      $(".sidebar-search-results .list-group").html(
        '<div id="loading" class="text-center list-group-item d-none"> <div class = "spinner-border" role = "status" ><span class = "visually-hidden"> </span> </div> </div>'
      );
    } else {
      searchBtn.html('<i class="fa fa-search"></i>');
    }
  });

});
var Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 5000
});
var errMsg = "";
var hasErr = '<?=$errors->any();?>';
let errStr = "";
if (hasErr) {
  let errors = <?=json_encode($errors->all())?>;
  errStr = '<ul class="mt-3 text-sm list-disc list-inside text-danger">';
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
