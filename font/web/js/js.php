<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(() => {
        var st = <?php if (isset($_GET['st'])) {
                        echo "'" . $_GET['st'] . "'";
                    } else {
                        echo "''";
                    } ?>;
        var act = "";
        $('#add-province-but').click(function() {
            province_add();
        });
        getReport()
        addReport()
        if (<?php echo "'" . $_SESSION['type'] . "'" ?> == 'B2') {
            $('#high').empty();
            $('#high1').empty();
        }
        if (<?php echo "'" . $_SESSION['type'] . "'" ?> == 'A2') {
            if (st == 'local') {
                province_fetch();
            } else if (st == 'official') {
                official_fetch();
            } else if (st == 'resident') {
                resident_fetch();
            }
        } else if (<?php echo "'" . $_SESSION['type'] . "'" ?> == 'A3') {
            if (st == 'local') {
                district_fetch();
            } else if (st == 'official') {
                official_fetch();
            } else if (st == 'resident') {
                resident_fetch();
            }
        } else if (<?php echo "'" . $_SESSION['type'] . "'" ?> == 'B1') {
            if (st == 'local') {
                commune_fetch();
            } else if (st == 'official') {
                official_fetch();
            } else if (st == 'resident') {
                resident_fetch();
            }
        } else if (<?php echo "'" . $_SESSION['type'] . "'" ?> == 'A1') {
            if (st == 'local') {
                tw_fetch();
            } else if (st == 'official') {
                official_fetch();
            } else if (st == 'resident') {
                resident_fetch();
            }
        }
        // lấy status và action để hiển thị chức năng
        let searchParams = new URLSearchParams(window.location.search);
        if (searchParams.has('act')) {
            act = searchParams.get('act');
        }
        // kiểm tra điều kiện để chọn hiển thị thông tin bảng của từng chức năng

        $('div.add-div').hide();
        $('#add-button').click(function() {
            $('div.add-div').toggle();
        });
    })

    function province_add() {
        $('#add-province-but').click(() => {
            $.ajax({
                url: "http://localhost/php/address/addCity",
                method: "POST",
                data: {

                    user_id: <?php echo $_SESSION['user_id'] ?>,
                    city_id: $('#province-id').val(),
                    city_name: $('#province-name').val()
                },

                success: function(data) {
                    console.log(data);
                }
            })
        });
    }

    function province_fetch() {
        var cty;
        $.ajax({
            url: "http://localhost/php/address/cityFromUser",
            method: "POST",
            data: {
                user_id: <?php echo $_SESSION['user_id'] ?>,
            },

            success: function(data) {
                cty = JSON.parse(data);
                district_from_city(cty);
            }
        })
    }

    function tw_fetch() {
        var cty;
        $.ajax({
            url: "http://localhost/php/address/cityFromUser",
            method: "POST",
            data: {
                user_id: <?php echo $_SESSION['user_id'] ?>,
            },

            success: function(data) {
                cty = JSON.parse(data);
                var s = "";
                for (i = 0; i < cty.length; i++) {
                    s += '<tr><td>' + cty[i].name + '</td><td>' + cty[i].city_id + '</td></tr>';
                }
                $('#tw-table').html(s);

            }
        })
    }

    function district_from_city(cty) {
        console.log(cty);
        $.ajax({
            url: "http://localhost/php/address/districtFromCity",
            method: "POST",
            data: {
                city_id: cty[0].city_id,
            },

            success: function(data) {
                dataJson = JSON.parse(data);
                var s = "";
                for (i = 0; i < dataJson.length; i++) {
                    s += '<tr><td>' + cty[0].name + '</td><td>' + dataJson[i].district_id + '</td><td>' + dataJson[i].name + '</td></tr>';
                }
                $('#province-table').html(s);
            }
        })
    }

    function district_fetch() {
        var dis;
        $.ajax({
            url: "http://localhost/php/address/districtFromUser",
            method: "POST",
            data: {
                user_id: <?php echo $_SESSION['user_id'] ?>,
            },

            success: function(data) {
                dis = JSON.parse(data);
                commune_from_district(dis);
                console.log(dis);
            }
        })
    }

    function commune_from_district(dis) {
        $.ajax({
            url: "http://localhost/php/address/communeFromDistrict",
            method: "POST",
            data: {
                district_id: dis[0].district_id,
            },

            success: function(data) {
                dataJson = JSON.parse(data);
                var s = "";
                console.log(data);
                for (i = 0; i < dataJson.length; i++) {
                    s += '<tr><td>' + dis[0].name + '</td><td>' + dataJson[i].commune_id + '</td><td>' + dataJson[i].name + '</td></tr>';
                }
                $('#district-table').html(s);
            }
        })
    }

    function commune_fetch() {
        var com;
        $.ajax({
            url: "http://localhost/php/address/communeFromUser",
            method: "POST",
            data: {
                user_id: <?php echo $_SESSION['user_id'] ?>,
            },

            success: function(data) {
                com = JSON.parse(data);
                console.log(com);
                address_from_commune(com);
            }
        })
    }

    function address_from_commune(com) {
        $.ajax({
            url: "http://localhost/php/address/addressFromCommune",
            method: "POST",
            data: {
                commune_id: com[0].commune_id,
            },

            success: function(data) {
                dataJson = JSON.parse(data);
                var s = "";
                for (i = 0; i < dataJson.length; i++) {
                    s += '<tr><td>' + com[0].name + '</td><td>' + dataJson[i].address_id + '</td><td>' + dataJson[i].name + '</td></tr>';
                }
                $('#commune-table').html(s);
            }
        })
    }

    function official_fetch() {
        var com;
        $.ajax({
            url: "http://localhost/php/account/staff",
            method: "POST",
            data: {
                user_id: <?php echo $_SESSION['user_id'] ?>,
            },

            success: function(data) {
                com = JSON.parse(data);
                var s = "";
                for (i = 0; i < com.staff.length; i++) {
                    s += '<tr><td>' + com.staff[i].user_id + '</td><td>' + com.staff[i].name + '</td></tr>';
                }
                $('#official-table').html(s);
            }
        })
    }

    function resident_fetch() {
        var com;
        $.ajax({
            url: "http://localhost/php/citizen/all",
            method: "POST",
            data: {
                user_id: <?php echo $_SESSION['user_id'] ?>,
            },

            success: function(data) {
                console.log(data);
                com = JSON.parse(data);
                console.log(com);
                var s = "";
                for (i = 0; i < com.length; i++) {
                    s += '<tr><td>' + com[i].citizen_id + '</td><td>' + com[i].name + '</td><td>' + com[i].birth + '</td><td>' +
                        com[i].gender + '</td><td>' + com[i].identifier + '</td><td>' + com[i].address_name + '</td><td>' +
                        com[i].permanent_address_name + '</td><td>' + com[i].temp_address_name + '</td><td>' +
                        com[i].religion + '</td><td>' + com[i].education + '</td><td>' + com[i].job + '</td></tr>';
                }
                $('#resident-table').html(s);
            }
        })
    }

    function getReport() {
        $.ajax({
            url: 'http://localhost/php/report/get',
            method: 'POST',
            data: {
                user_id: <?php echo $_SESSION['user_id'] ?>
            },

            success: function(data) {
                data = JSON.parse(data)
                renderReport(data.boss_report, $('.boss_report'), true);
                renderReport(data.my_report, $('.my_report'), false)
            }
        })
    }

    function renderReport(data, parent, isBoss) {
        var length = data.length
        for (i = 0; i < length; i++) {
            item = "";
            if (isBoss) {
                item = `<div class='item' data=${data[i].report_id}><div><h4>${data[i].report_name}</h4><span>Từ ${data[i].start_date} đến </span><span>${data[i].end_date}</span>` +
                    `</div><div><button class='work'>Thực Hiện</button><button class='complete'>Hoàn Thành</button></div></div>`
            } else {
                item = `<div class='item' data=${data[i].report_id}><div><h4>${data[i].report_name}</h4><span>Từ ${data[i].start_date} đến </span><span>` +
                    `${data[i].end_date}</span></div><div><button class='viewbtn'>Xem Tiến Độ</button></div></div>`
            }
            parent.append(item)
        }
        if (isBoss) {
            $(".item .complete").click(function() {
                console.log('yes')
                $.ajax({
                    url: 'http://localhost/php/report/complete',
                    method: 'POST',
                    data: {
                        user_id: <?php echo $_SESSION['user_id'] ?>,
                        report_id: $(this).parent().parent().attr('data')
                    },

                    success: data => {
                        data = JSON.parse(data)
                        if (data.status == "ok") {
                            alert("Thành Công")
                        } else {
                            alert("Thất bại! Vui lòng thử lại")
                        }
                    }
                })
            })
        } else {
            $('.viewbtn').click(function(e) {
                $(e.target).toggleClass('added')
                if ($(e.target).hasClass('added')) {
                    $.ajax({
                        url: "http://localhost/php/report/area",
                        method: 'POST',
                        data: {
                            user_id: <?php echo $_SESSION['user_id'] ?>,
                            report_id: $(e.target).parent().parent().attr('data')
                        },

                        success: data => {
                            data = JSON.parse(data)
                            console.log(data)
                            complete = "Các khu vực đã hoàn thành: "
                            notComplete = "Các khu vực chưa hoàn thành: "
                            for (i = 0; i < data.length; i++) {
                                if (data[i].complete) {
                                    complete += data[i].name + ", "
                                } else
                                    notComplete += data[i].name + ", "
                            }

                            $(e.target).parent().parent().after(`<h5>${complete}</h5><h5>${notComplete}</h5>`)
                        }
                    })
                }else{
                    $(e.target).parent().parent().next().remove()
                    $(e.target).parent().parent().next().remove()
                }
            })

            $('.removeReportbtn').click(function(e){
                $.ajax({
                    url: "http://localhost/php/report/delete",
                    method: "POST",
                    data: {
                        report_id: $(e.target).parent().parent().attr('data')
                    },

                    success: data => {
                        data = JSON.parse(data)
                        if (data.status == "ok") {
                            alert("Thành Công")
                            $(e.target).parent().parent().remove()
                        } else {
                            alert("Thất bại! Vui lòng thử lại")
                        }
                    }
                })
            })
        }

    }

    function addReport() {
        $(".addReport").click(function(e) {
            $(e.target).toggleClass("added")
            if ($(e.target).hasClass('added')) {
                form = "<div class='addForm'><label>Tên báo cáo:</label><input type='text' id='report_name'><label>Ngày bắt đầu: </label><input type='date' id='start'>" +
                    "<label>Ngày Kết thúc: </label><input type='date' id='end'><label>Chọn nhân viên(nhấn giữ shift để chọn nhiều):</label>" +
                    "<select multiple id='staffs'></select><button id='addReportbtn'>Tạo</button></div>"
                $(e.target).after(form)
                a = 4;
                $.ajax({
                    url: "http://localhost/php/account/staff",
                    method: "post",
                    data: {
                        user_id: <?php echo $_SESSION['user_id'] ?>
                    },

                    success: function(data) {
                        data = JSON.parse(data)
                        length = data.staff.length
                        for (i = 0; i < length; i++) {
                            option = `<option data=${data.staff[i].user_id}>${data.staff[i].name}</option>`
                            $('#staffs').append(option)
                        }
                    }
                })

                $('#addReportbtn').click(function(e) {
                    selected = $('#staffs').find(':selected')
                    var staffs = [];

                    selected.each(function() {
                        staffs.push($(this).attr('data'));
                    });
                    $.ajax({
                        url: "http://localhost/php/report/create",
                        method: "POST",
                        data: {
                            user_id: <?php echo $_SESSION['user_id'] ?>,
                            start_date: $('#start').val(),
                            end_date: $('#end').val(),
                            staff: JSON.stringify(staffs),
                            report_name: $('#report_name').val()
                        },
                        success: function(data) {
                            data = JSON.parse(data)
                            if (status && data.status == "ok") {
                                alert('Thành công')
                            } else {
                                alert('Thất bại vui lòng thử lại')
                            }
                        }
                    })
                })
            } else {
                $(e.target).next().remove()
            }
        })
    }
</script>