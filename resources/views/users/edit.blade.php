 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
     <div class="container-fluid">
       <div class="mb-2">
         <h1>個人資料</h1>
       </div>
     </div><!-- /.container-fluid -->
   </section>
   <!-- Main content -->
   <section class="content">
     <div class="container-fluid">
       <div class="row">
         <div class="col-md-3">
           <!-- Profile Image -->
           <div class="card card-primary card-outline">
             <div class="card-body box-profile">
               <div class="text-center">
                 <img class="profile-user-img img-fluid img-circle"
                   src="{{ asset('assets/dist/img/user4-128x128.jpg')}}" alt="User profile picture">
               </div>

               <h3 class="profile-username text-center">{{ $data['user']['name'] }}</h3>

               <p class="text-muted text-center">{{ $data['user']['team']."/".$data['user']['role'] }}</p>

               <ul class="list-group list-group-unbordered mb-3">
                 <li class="list-group-item">
                   <b>Followers</b> <a class="float-right">1,322</a>
                 </li>
                 <li class="list-group-item">
                   <b>Following</b> <a class="float-right">543</a>
                 </li>
                 <li class="list-group-item">
                   <b>Friends</b> <a class="float-right">13,287</a>
                 </li>
               </ul>

               <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>
             </div>
             <!-- /.card-body -->
           </div>
           <!-- /.card -->
         </div>
         <!-- /.col -->
         <div class="col-md-9">
           <div class="card">
             <div class="card-header">
               設定
             </div><!-- /.card-header -->
             <div class="card-body">
               <div id="settings">
                 <form class="form-horizontal">
                   <div class="form-group row">
                     <label for="inputName" class="col-sm-2 col-form-label">姓名</label>
                     <div class="col-sm-10">
                       <input type="text" name="name" class="form-control" id="inputName"
                         value="{{ $data['user']['name'] }}" placeholder="姓名">
                     </div>
                   </div>
                   <div class="form-group row">
                     <label for="inputEmail" class="col-sm-2 col-form-label">信箱</label>
                     <div class="col-sm-10">
                       <input type="email" name="email" class="form-control" id="inputEmail"
                         value="{{ $data['user']['email'] }}" placeholder="電子郵件">
                     </div>
                   </div>
                   <div class="form-group row">
                     <label for="inputTel" class="col-sm-2 col-form-label">電話</label>
                     <div class="col-sm-10">
                       <input type="text" name="tel" class="form-control" id="inputTel"
                         value="{{ $data['user']['tel'] }}" placeholder="電話">
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
                         <option value="1">啟用</option>
                         <option value="2">停用</option>
                       </select>
                     </div>
                   </div>
                   <div class="form-group row">
                     <label for="inputFile" class="col-sm-2 col-form-label">照片</label>
                     <div class="col-sm-10">
                       <input type="file" name="photofile" class="form-control-file" id="inputFile">
                     </div>
                   </div>

                   <!-- <div class="form-group row">
                     <div class="offset-sm-2 col-sm-10">
                       <div class="checkbox">
                         <label>
                           <input type="checkbox"> I agree to the <a href="#">terms and conditions</a>
                         </label>
                       </div>
                     </div>
                   </div> -->
                   <div class="form-group row">
                     <div class="offset-sm-2 col-sm-10">
                       <button type="submit" class="btn btn-danger">Submit</button>
                     </div>
                   </div>
                 </form>
               </div>
               <!-- /.tab-content -->
             </div><!-- /.card-body -->
           </div>
           <!-- /.card -->
         </div>
         <!-- /.col -->
       </div>
       <!-- /.row -->
     </div><!-- /.container-fluid -->
   </section>
   <!-- /.content -->
 </div>
 <!-- /.content-wrapper -->

<script>
    var teamsAry= <?=json_encode($data['teams']);?>;
    var rolesAry= <?=json_encode($data['roles']);?>;
    $(document).ready(function() {
        $("#inputTeam").change(function () {

            let team=$("#inputTeam").val();
            let option="";
            console.log(team);

            $("input[name='role']").html("");
            if(team!=""){
                if(team==1){ //無組別
                    Object.keys(rolesAry).forEach(key => {
                        console.log(key);
                    });
                    // rolesAry.array.forEach(element => {
                    //     if(element.id>=10){
                    //         role.push(element.id);
                    //         option += "<option value='"+ element.id +"'>" + element.role + "</option>";
                    //     }
                    // });
                }else if(team==2){ //策略中心
                    // rolesAry.array.forEach(element => {
                    //     if(element.id >= 5 && element.id <= 8){
                    //         option += "<option value='"+ element.id +"'>" + element.role + "</option>";
                    //     }
                    // });
                }else{
                    // rolesAry.array.forEach(element => {
                    //     if(element.multiple=='Y'){
                    //         option += "<option value='"+ element.id +"'>" + element.role + "</option>";
                    //     }
                    // });
                }
                $("input[name='role']").html(option);
            }else{
                $("input[name='role']").html(`
                <option value="">請選擇</option>
                `);
            }
            console.log(option);
        });
    });

</script>
