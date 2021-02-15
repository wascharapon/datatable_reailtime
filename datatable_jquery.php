<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>datatable_realtime</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- นำเข้า  CSS จาก Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Mitr:wght@300;400&display=swap" rel="stylesheet">
    <!-- นำเข้า  CSS จาก dataTables -->
    <link rel="stylesheet" type="text/css"
        href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap5.min.css">
    <!-- นำเข้า  Javascript จาก  Jquery -->
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <!-- นำเข้า  Javascript  จาก   dataTables -->
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js">
    </script>
    <script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap5.min.js"></script>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous">
    </script>
    
</head>
<style>
    body {
        overflow-x: hidden;
        font-family: 'Mitr', sans-serif;
    }

    .td_date {
        font-size: 100%;
    }

    td {
        vertical-align: middle;
    }

    input {
        margin-top: 4%;
    }

    table {}

</style>
    <script>
        $(async function() {
            let response = await get_data_table();
            setInterval(function() {
                    get_data_table();
                }, 5000);
        });

        function get_data_table() {
            $.ajax({
                type: 'GET',
                url: 'http://localhost:8000/api/withdraw',      //api ดึงข้อมูลจากฐานข้อมูล
                data: {
                    get_param: 'value'
                },
                dataType: 'json',
                success: function(data) {
                    var t = $('#table_withdraw').DataTable();
                    t.clear();
                    $.each(data, function(index, element) {
                        var id = element.id;
                        var status = element.status;
                        var created_at_time = element.created_at;
                        //ข้อมูลจากฐานข้อมูล
                        t.row.add([
                            id,
                            status,
                            created_at_time
                        ]).draw(false);
                    });
                }
            });

        }

    </script>
    <body>
    <nav class="navbar fixed-top navbar-dark bg-primary text-center">
        <a class="navbar-brand" href="#"><label>&nbsp;</label></a>
        </div>
    </nav>
    <br><br>

    <div class="d-flex flex-column bd-highlight  mt-2 bt-2 text-center">
        <div class="p-2 bd-highlight">
            <div class="container">
                <div class="row">
                    <div class="col-sm ">
                        <table id="table_withdraw" class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th id="id_withdraw">ลำดับ</th>
                                    <th id="date_withdraw">วันที่</th>
                                    <th id="status_withdraw">สถานะ</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <nav class="navbar fixed-bottom navbar-dark bg-primary">
        <div class="container-fluid">
            <a type="button" class="btn btn-block text-white" href="{{ route('login_facebook') }}"
                class="btn btn-light "><i class="fa fa-facebook-square"
                    style="vertical-align:text-bottom;font-size:160%; "></i><label
                    style="vertical-align:top;">&nbsp;เข้าสู่ระบบ </label></a>
        </div>
    </nav>
</body>
</html>
