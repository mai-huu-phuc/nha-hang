<?php 
    include '../../../config/config.php';

    include '../../share/header.php';

    include '../../share/slide.php';
?>



 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Hải sản</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Quản lý bài viết</a></li>
              <li class="breadcrumb-item active">Hải sản</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <a href="./AddC.php" style="width:200px;" class="btn btn-primary">Thêm</a>
            <a id="deleteMulti" style="width:200px;" class="btn btn-danger">Xóa Nhiều</a>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table id="loadContent" class="row-border">
                    <thead>
                        <tr>
                            <th class="select-checkbox"><input id="checkBox" type="checkbox"></th>
                            <th>STT</th>
                            <th>Tiêu Đề</th>
                            <th>Loại Bài Viết</th>
                            <th>Khóa</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>

                    </tfoot>
                </table>
            </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>

<script type="text/javascript" src="./js/javascript.js"></script>
  


<script type="text/javascript ">  
    $( document ).ready(function() {
        let table2 = $('#loadContent').DataTable({});

        LoadDataSend();

        table2.on('click', 'button', function (e) {
            table2 = $('#loadContent').DataTable();

                let data = table2.row(e.target.closest('tr')).data();
                let messengerData = {
                    id: data["id"],
                }

                if (data["id"] != null) {
                if(confirm("Bạn có chắc muốn xóa: "+data["title"]))
                {
                    $.ajax({
                        type: "POST",
                        url: "./js/deleteC.php",
                        data: messengerData,
                        success: function (response) {
                            if (response == 1) {
                                LoadDataSend();
                            } else {
                                alert("Lỗi không thể thêm được");
                                console.log(response);
                            }
                        }, error: function (response) {
                            console.log(response.responseText);
                        }
                    });
                }               
            }
        });
        $("#deleteMulti").click(() => {
            if (confirm("bạn có chắc muốn thêm không")) {
                table2 = $('#loadContent').DataTable();
                let user_idArray=[];
                let testValue = table2.rows({ selected: true }).data();
                console.log(testValue);
                for (let i = 0; i < testValue.length; i++) {
                    user_idArray.push(testValue[i]["id"]);
                }
                let datasend = {
                 
                    idArray: user_idArray
                }
                if (user_idArray.length > 0) {
                    $.ajax({
                        type: "POST",
                        url: "./js/deleteMultiC.php",
                        data: datasend,

                        success: function (response) {
                            if (response == 1) {
                                LoadDataSend();
                            } else {
                                console.log(response);
                                alert("Lỗi không thể thêm được");
                            }
                        }, error: function (response) {
                            console.log(response.responseText);
                        }
                    });
                }else{
                    alert("Vui lòng chọn ");
                }
                
            }
        });
  
});

function LoadDataSend() {

    $.ajax({
        type: "POST",
        url: "./js/LoadC.php",
        success: function(response) {
       
            if ($.fn.dataTable.isDataTable('#loadContent')) {

                $('#loadContent').DataTable().clear().destroy();
                let stt = 0;
                table2 = $('#loadContent').DataTable({
                    language: {
                        emptyTable: "Không có dữ liệu",
                        sSearch: "Tìm kiếm",
                    },
                    oLanguage: {
                        oPaginate: {

                            "sLast": "Trang Cuối",
                            "sNext": "Trang Kế Tiếp",
                            "sPrevious": "Trang Sau",
                            "sFirst": "Trang Đầu",
                            "sLoadingRecords": "Đang tải vui lòng đợi...",
                            "sInfo": "_START_ đến _END_ của tổng _TOTAL_"
                        }
                    },
                    select: {
                        style: 'os',
                        selector: 'td:first-child',
                        style: 'multi',

                    },
                    data: response,
                    columnDefs: [{
                            orderable: false,
                            className: 'select-checkbox',
                            targets: 0
                        },
                        {
                            data: null,
                            defaultContent: '<button class="btn btn-danger"> Xóa </button>',
                            targets: -1
                        }
                    ],
                    order: [
                        [1, 'asc']
                    ],
                    columns: [{
                            data: null,
                            width: "10%",
                            render: function() { return null; }
                        },
                        {
                            data: null,
                            render: function() {
                                if (stt > response.length) {
                                    return null;
                                } else {
                                    stt = stt + 1;
                                    return stt;
                                }
                            },
                            width: "10%",
                        },
                        {
                            data: null,
                            render: function(data, type, row) {
                                var id_active = '';
                                if (row.nameTypeBaiViet != null) {
                                    id_active = row.nameTypeBaiViet;
                                }
                                return '<a href="./detailC.php?id='+row.id+'" >' + id_active + '<a >';
                            },
                            width: "20%",
                        },
                        {
                            data: null,
                            render: function(data, type, row) {
                                var nameActive = '';
                                if (row.isHidden != null) {
                                    nameActive = row.isHidden;
                                }
                                return '<b>' + nameActive + '</b>';
                            },
                        },
                        {
                            data: null,
                        },
                    ],
                });
            }
        },
        error: function(response) {
            console.log(response.responseText);
        }
    });
}

let countId = 1;
</script>
<?php 
    include '../../share/footer.php';
?>