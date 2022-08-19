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
      <div class="mb-2">
        <h1>{{ $data['title'] }}</h1>
      </div>
    </div><!-- /.container-fluid -->
  </div>

  <!-- Main content -->
  <div class="pb-3 content">

    <!-- Default box -->
    <div class="card h-100">
      <div class="card-header d-flex align-items-center">
        <h3 class="card-title">客戶清單</h3>
        <!-- Button trigger modal -->
        <button class="ml-2 btn btn-info btn-sm" data-toggle="modal" data-target="#addModal">
          新增
          <i class="fas fa-plus"></i>
        </button>
      </div>
      <div class="overflow-auto card-body">
        <table class="table text-center table-striped">
          <thead>
            <tr>
              <th>公司名稱</th>
              <th class="col-2">聯絡人</th>
              <th class="col-1"></th>
            </tr>
          </thead>
          <tbody>
            @if ( !empty($data['customers']['data']) )
            @foreach ( $data['customers']['data'] as $customer)
            @if ($customer['id']!=0)
            <tr>
              <td class="text-left align-middle">{{ $customer['name'] }}</td>
              <td class="align-middle">{{ $customer['contact'] }}</td>
              <td class="align-middle">
                <a class="btn btn-primary btn-sm" href="{{ route('customers.show',['customer'=>$customer['id']]) }}">
                  編輯
                  <i class="fas fa-pencil-alt"></i>
                </a>
              </td>
            </tr>
            @endif
            @endforeach
            @else
            <tr>
              <td colspan="5">目前無{{ $data['title'] }}</td>
            </tr>
            @endif
          </tbody>
        </table>
      </div>
      <!-- /.card-body -->
      <!-- pagination -->
      @if (!empty($data['customers']['data']))
      <div class="card-tools">
        <ul class="mt-3 pagination pagination-sm justify-content-center">
          @foreach ($data['customers']['links'] as $page)
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
    <!-- Modal -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">新增{{ $data['title'] }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">

            <form class="form-horizontal" action="{{ route('bboards.store') }}" method="post"
              enctype="multipart/form-data">
              @csrf
              <div class="form-group">
                <label for="topic">公告主題</label>
                <input type="text" id="topic" name="topic" class="form-control" value="">
              </div>
              <div class="form-group">
                <label for="msg_date">公告時間</label>
                <input type="date" id="msg_date" name="msg_date" class="form-control" value="">
              </div>
              <div class="form-group">
                <label for="content">公告內容</label>
                <textarea id="content" name="content" class="form-control" rows="4"></textarea>
              </div>
              <div class="form-group">
                <label for="status">狀態</label>
                <select id="status" name="status" class="form-control custom-select">
                  <option value="1">顯示</option>
                  <option value="2">隱藏</option>
                </select>
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
  </div>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

@endsection

@section('scripts')
@parent
<!-- SweetAlert2 -->
<script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script>
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
