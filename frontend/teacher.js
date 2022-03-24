//handle teacher
$(document).ready(function() {
    function renderTeacher() {
        let url = 'http://localhost/php_mvc/backend/apiteachers';
        let html;
        $.ajax(url, {
            type: 'GET',
            dataType: "json",
            contentType: "application/json; charset=utf-8",
            success: function(data){
                let elm = '';
                if (data) {
                    data.map((teacher) => {
                        let elm = `
                            <tr>
                                <th scope="row">${teacher.id}</th>
                                <td>${teacher.code}</td>
                                <td>${teacher.name}</td>
                                <td>${teacher.birthday}</td>
                                <td>${teacher.gender == '0' ? 'Male' : 'Female'}</td>
                                <td>${teacher.address}</td>
                                <td>
                                    <button class="btn btn-primary edit_teacher" data-id="${teacher.id}">Update
                                    </button>
                                    <button type="button" class="btn btn-danger delete_teacher" data-id="${teacher.id}" confirm("Are you sure?")>Delete</button>
                                </td>
                            </tr>
                        `
                        html += elm;
                    });
                }
                $('#tab-teachers .content tbody').html(html);
            },
            error: function(e) {
                $('#tab-teachers .content tbody').text(`${e.responseJSON.message}`);
            },
            complete: function() {
                $('.form_create_teacher').hide();
                $('.form_update_teacher').hide();
            }
        });
    }
    renderTeacher();

    let btnCreateTeacher = $('#create-teacher');
    let urlCreateTeacher = 'http://localhost/php_mvc/backend/apiteachers/create';
    var formCreateTeacher = $('.form_create_teacher');
    var formUpdateTeacher = $('.form_update_teacher');
    // cancel form teacher
    $('.cancel').click(function(e) {
        formCreateTeacher.hide();
        formUpdateTeacher.hide();
        e.preventDefault();
    })
    // btn create teacher click 
    btnCreateTeacher.click(function(e) {
        formUpdateTeacher.hide();
        formCreateTeacher.show();
        e.preventDefault();
    });
    // submit create teacher
    formCreateTeacher.submit(function(e) {
        let name = $('#teacher_name').val();
        let code = $('#teacher_code').val();
		let birthday = $('#teacher_birthday').val();
        let gender = $('#teacher_gender').val();
        let address = $('#teacher_address').val();
        //vadilator form create teacher
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
            url: urlCreateTeacher,
            type: 'POST',
            dataType: "json",
            contentType: "application/json; charset=utf-8",
            data: JSON.stringify(data),
            beforeSend: function() {
                return data ? true : false;
            },
            success: function(result) {
                $('#tab-teachers .notion').show();
                $('#tab-teachers .notion').html(`
                    <p class="alert alert-success">${result.message}</p>
                `);
                $('#tab-teachers .notion').hide(2000);
                renderTeacher();
            },
            error: function(e) {
                console.log(e);
            },
            complete: function() {
                formCreateTeacher[0].reset();
                formCreateTeacher.hide();
            }
        })
        
        e.preventDefault();
    })

    //delete teacher
    $(document).on('click', '.delete_teacher', function(e) {
        let result = confirm('Are you sure?');
        if (result) {
            let id = $(this).attr('data-id');
            console.log(id)
            let data = (id) ?  { id } : '';
            let urlDeleteTeacher = `http://localhost/php_mvc/backend/apiteachers/delete/${id}`;
            $.ajax({
                url: urlDeleteTeacher,
                type: "DELETE",
                dataType: "json",
                contentType: "application/json; charset=utf-8",
                data: JSON.stringify(data),
                beforeSend: function() {
                    return data ? true : false;
                },
                success: function(result) {
                    $('#tab-teachers .notion').show();
                    $('#tab-teachers .notion').html(`
                        <p class="alert alert-success">${result.message}</p>
                    `);
                    $('#tab-teachers .notion').hide(2000);
                    renderTeacher();
                },
                error: function(msg) {
                    $('.message').text('404');
                }
            })
        }

        e.preventDefault();
    })

    //open form update teacher
    $(document).on('click', '.edit_teacher', function(e) {
		$('.message').text('');	
        // formUpdate.show();
        let id = $(this).attr('data-id');
        let data = (id) ?  { id } : '';
        let urlSingleTeacher = `http://localhost/php_mvc/backend/apiteachers/single/${id}`;
        $.ajax({
            url: urlSingleTeacher,
            type: 'DELETE',
            dataType: "json",
            contentType: "application/json; charset=utf-8",
            data: JSON.stringify(data),
            beforeSend: function() {
                formCreateTeacher.hide();
            },
            success: function(result) {
                $('#teacher_code_update').attr('value', result.code);
                $('#teacher_name_update').attr('value', result.name);
                $('#teacher_birthday_update').attr('value', result.birthday);
                $('#teacher_gender_update').attr('value', result.gender);
                $('#teacher_address_update').attr('value', result.address);
                $('.btn-update-teacher').attr('data-id', result.id);
                formUpdateTeacher.show();
            },
            error: function(msg) {
                $('.message').text('404');
            }
        })
    });
    //submit form update teacher;
    $('.btn-update-teacher').on('click', function(e) {
        e.preventDefault();
        let id = $(this).attr("data-id");
        let name = $('#teacher_name_update').val();
        let code = $('#teacher_code_update').val();
		let birthday = $('#teacher_birthday_update').val();
        let gender = $('#teacher_gender_update').val();
        let address = $('#teacher_address_update').val();
        //vadilator form create teacher
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
        let urlUpdateTeacher = `http://localhost/php_mvc/backend/apiteachers/update/${id}`;
        $.ajax({
            url: urlUpdateTeacher,
            type: 'PUT',
            dataType: "json",
            contentType: "application/json; charset=utf-8",
            data: JSON.stringify(data),
            beforeSend: function() {
                return data ? true : false;
            },
            success: function(result) {
                $('#tab-teachers .notion').show();
                $('#tab-teachers .notion').html(`
                    <p class="alert alert-success">${result.message}</p>
                `);
                $('#tab-teachers .notion').hide(2000);
                renderTeacher();
            },
            error: function(e) {
                console.log(e);
            },
            complete: function () {
                formUpdateTeacher.hide();
                formUpdateTeacher[0].reset();
            }
        })
        
    })
})