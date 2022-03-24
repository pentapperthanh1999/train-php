//handle student
$(document).ready(function() {
    function renderStudent() {
        let url = 'http://localhost/php_mvc/backend/apistudents';
        let html;
        $.ajax(url, {
            type: 'GET',
            dataType: "json",
            contentType: "application/json; charset=utf-8",
            success: function(data){
                let elm = '';
                if (data) {
                    data.map((student) => {
                        let elm = `
                            <tr>
                                <th scope="row">${student.id}</th>
                                <td>${student.code}</td>
                                <td>${student.name}</td>
                                <td>${student.birthday}</td>
                                <td>${student.gender == '0' ? 'Male' : 'Female'}</td>
                                <td>${student.address}</td>
                                <td>
                                    <button class="btn btn-primary edit_student" data-id="${student.id}">Update
                                    </button>
                                    <button type="button" class="btn btn-danger delete_student" data-id="${student.id}" confirm("Are you sure?")>Delete</button>
                                </td>
                            </tr>
                        `
                        html += elm;
                    });
                }
                $('#tab-students .content tbody').html(html);
            },
            error: function(e) {
                $('#tab-students .content tbody').text(`${e.responseJSON.message}`);
            },
            complete: function() {
                $('.form_create_student').hide();
                $('.form_update_student').hide();
            }
        });
    }
    renderStudent();

    let btnCreateStudent = $('#create-student');
    let urlCreateStudent = 'http://localhost/php_mvc/backend/apistudents/create';
    var formCreateStudent = $('.form_create_student');
    var formUpdateStudent = $('.form_update_student');
    // cancel form student
    $('.cancel').click(function(e) {
        formCreateStudent.hide();
        formUpdateStudent.hide();
        e.preventDefault();
    })
    // btn create student click 
    btnCreateStudent.click(function(e) {
        formUpdateStudent.hide();
        formCreateStudent.show();
        e.preventDefault();
    });
    // submit create student
    formCreateStudent.submit(function(e) {
        let name = $('#student_name').val();
        let code = $('#student_code').val();
		let birthday = $('#student_birthday').val();
        let gender = $('#student_gender').val();
        let address = $('#student_address').val();
        //vadilator form create student
        if (!code && code == '') {
            $('.error_code').text('field required!');
        } else {
            $('.error_code').text('');
        }

        if (!name && name == '') {
            $('.error_name').text('field required!');
        } else {
            $('.error_name').text('');
        }

        if (!birthday && birthday == '') {
            $('.error_birthday').text('field required!');
        } else {
            $('.error_birthday').text('');
        }

        if (!gender && gender == '') {
            $('.error_gender').text('field required!');
        } else {
            $('.error_gender').text('');
        }

        if (!address && address == '') {
            $('.error_address').text('field required!');
        } else {
            $('.error_address').text('');
        }
        let data = '';
        if ( name && code && birthday && gender && address) {
            data = {
                name,
                code,
                birthday,
                gender,
                address
            }
        }

        $.ajax({
            url: urlCreateStudent,
            type: 'POST',
            dataType: "json",
            contentType: "application/json; charset=utf-8",
            data: JSON.stringify(data),
            beforeSend: function() {
                return data ? true : false;
            },
            success: function(result) {
                $('#tab-students .notion').show();
                $('#tab-students .notion').html(`
                    <p class="alert alert-success">${result.message}</p>
                `);
                $('#tab-students .notion').hide(2000);
                renderStudent();
            },
            error: function(e) {
                console.log(e);
            },
            complete: function() {
                formCreateStudent[0].reset();
                formCreateStudent.hide();
            }
        })
        
        e.preventDefault();
    })

    //delete student
    $(document).on('click', '.delete_student', function(e) {
        let result = confirm('Are you sure?');
        if (result) {
            let id = $(this).attr('data-id');
            console.log(id)
            let data = (id) ?  { id } : '';
            let urlDeleteStudent = `http://localhost/php_mvc/backend/apistudents/delete/${id}`;
            $.ajax({
                url: urlDeleteStudent,
                type: "DELETE",
                dataType: "json",
                contentType: "application/json; charset=utf-8",
                data: JSON.stringify(data),
                beforeSend: function() {
                    return data ? true : false;
                },
                success: function(result) {
                    $('#tab-students .notion').show();
                    $('#tab-students .notion').html(`
                        <p class="alert alert-success">${result.message}</p>
                    `);
                    $('#tab-students .notion').hide(2000);
                    renderStudent();
                },
                error: function(msg) {
                    $('.message').text('404');
                }
            })
        }

        e.preventDefault();
    })

    //open form update student
    $(document).on('click', '.edit_student', function(e) {
		$('.message').text('');	
        // formUpdate.show();
        let id = $(this).attr('data-id');
        let data = (id) ?  { id } : '';
        let urlSingleStudent = `http://localhost/php_mvc/backend/apistudents/single/${id}`;
        $.ajax({
            url: urlSingleStudent,
            type: 'GET',
            dataType: "json",
            contentType: "application/json; charset=utf-8",
            data: JSON.stringify(data),
            beforeSend: function() {
                formCreateStudent.hide();
            },
            success: function(result) {
                $('#student_code_update').attr('value', result.code);
                $('#student_name_update').attr('value', result.name);
                $('#student_birthday_update').attr('value', result.birthday);
                $('#student_gender_update').attr('value', result.gender);
                $('#student_address_update').attr('value', result.address);
                $('.btn-update-student').attr('data-id', result.id);
                formUpdateStudent.show();
            },
            error: function(msg) {
                $('.message').text('404');
            }
        })
    });
    //submit form update student;
    $('.btn-update-student').on('click', function(e) {
        e.preventDefault();
        let id = $(this).attr("data-id");
        let name = $('#student_name_update').val();
        let code = $('#student_code_update').val();
		let birthday = $('#student_birthday_update').val();
        let gender = $('#student_gender_update').val();
        let address = $('#student_address_update').val();
        //vadilator form create student
        if (!code && code == '') {
            $('.error_code').text('field required!');
        } else {
            $('.error_code').text('');
        }

        if (!name && name == '') {
            $('.error_name').text('field required!');
        } else {
            $('.error_name').text('');
        }

        if (!birthday && birthday == '') {
            $('.error_birthday').text('field required!');
        } else {
            $('.error_birthday').text('');
        }

        if (!gender && gender == '') {
            $('.error_gender').text('field required!');
        } else {
            $('.error_gender').text('');
        }

        if (!address && address == '') {
            $('.error_address').text('field required!');
        } else {
            $('.error_address').text('');
        }
        let data = '';
        if ( id && name && code && birthday && gender && address) {
            data = {
                id,
                name,
                code,
                birthday,
                gender,
                address
            }
        }
        console.log(data);
        let urlUpdateStudent = `http://localhost/php_mvc/backend/apistudents/update/${id}`;
        $.ajax({
            url: urlUpdateStudent,
            type: 'PUT',
            dataType: "json",
            contentType: "application/json; charset=utf-8",
            data: JSON.stringify(data),
            beforeSend: function() {
                return data ? true : false;
            },
            success: function(result) {
                $('#tab-students .notion').show();
                $('#tab-students .notion').html(`
                    <p class="alert alert-success">${result.message}</p>
                `);
                $('#tab-students .notion').hide(2000);
                renderStudent();
            },
            error: function(e) {
                console.log(e);
            },
            complete: function () {
                formUpdateStudent.hide();
                formUpdateStudent[0].reset();
            }
        })
        
    })
})