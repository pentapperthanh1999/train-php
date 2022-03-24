$(document).ready(function() {
    // active nav
    $('.nav-link').click(function(e) {
        let tabName = $(this).attr('data-name');
        $('.nav-link').parent().removeClass('active');
        $(this).parent().addClass('active');
        let id = $(this).attr('href');
        $('.tab-item').hide();
        $(id).show();
        if (typeof tabName !== 'undefined' && tabName !== false) {
            const urlParam = `http://localhost/php_mvc/backend/api${tabName}`;
            e.preventDefault();
            $.ajax({
                url: urlParam,
                type: 'GET',
                dataType: 'JSON',
                contentType: "application/json; charset=utf-8",
                success: function(data) {
                    localStorage.setItem(tabName, JSON.stringify(data));
                    // data.map((data, index) => {
                    // 	console.log(data)
                    // })
                },
                error: function(e) {
                    localStorage.setItem(tabName, '')
                }
            })
        }
        if (localStorage.getItem(tabName)) {
            var data = localStorage.getItem(tabName);
        }
    })
    //render class
    function renderClass() {
        let url = 'http://localhost/php_mvc/backend/apiclasses';
        let html;
        $.ajax(url, {
            type: 'GET',
            dataType: "json",
            contentType: "application/json; charset=utf-8",
            success: function(data){
                let elm = '';
                if (data) {
                    // Store
                    localStorage.setItem("classes", JSON.stringify(data));
                    data.map((classes, index) => {
                        
                        let elm = `
                            <tr>
                                <th scope="row">${classes.id}</th>
                                <td>${classes.code}</td>
                                <td>${classes.name}</td>
                                <td>
                                    <button class="btn btn-primary edit_class" data-id="${classes.id}">Update
                                    </button>
                                    <button type="button" class="btn btn-danger delete_class" data-id="${classes.id}" confirm("Are you sure?")>Delete</button>
                                </td>
                            </tr>
                        `
                        html += elm;
                    });
                }
                $('#tab-classes .content tbody').html(html);
            },
            error: function(e) {
                $('#tab-classes .content tbody').text(`${e.responseJSON.message}`);
            }
        });
    }
    renderClass();
    //create
    let btnCreateClass = $('#create-class');
    let urlCreateClass = 'http://localhost/php_mvc/backend/apiclasses/create';
    var formCreateClass = $('.form_create_class');
    var formUpdateClass = $('.form_update_class');
    //cannel action
    $('.cancel').click(function(e) {
        formCreateClass.hide();
        formUpdateClass.hide();
        e.preventDefault();
    })

    btnCreateClass.click((e) => {
        formUpdateClass.hide();
        formCreateClass.show();
        e.preventDefault();
    })
    
    formCreateClass.submit(function(e) {
        
        let name = $('#class_name').val();
        let code = $('#class_code').val();
        
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

        let data = (code && name) ?  {
            code,
            name
        } : '';
        $.ajax({
            url: urlCreateClass,
            type: 'POST',
            dataType: "json",
            contentType: "application/json; charset=utf-8",
            data: JSON.stringify(data),
            beforeSend: function () {
                return data ? true : false;
            },
            success: function(result) {
                $('#tab-classes .notion').show();
                $('#tab-classes .notion').html(`
                    <p class="alert alert-success">${result.message}</p>
                `);
                setTimeout(function() {
                    $('#tab-classes .notion').fadeOut('fast');
                }, 1000);
                renderClass();
            },
            error: function(msg) {
                $('#tab-classes .notion').html(
                    '<div class="alert alert-danger">Something went wrong! Please try again!</div>'
                );
                $('#tab-classes .notion').hide(2000);
            },
            complete: function () {
                
                formCreateClass[0].reset();
                formCreateClass.hide();
            }
        });
        return false;
        e.preventDefault();
    });
    //delete class
    $(document).on('click', '.delete_class', function(e) {
        let result = confirm('Are you sure?');
        if (result) {
            let id = $(this).attr('data-id');
            let data = (id) ?  { id } : '';
            let urlDeleteClass = `http://localhost/php_mvc/backend/apiclasses/delete/${id}`;
            $.ajax({
                url: urlDeleteClass,
                type: "DELETE",
                dataType: "json",
                contentType: "application/json; charset=utf-8",
                data: JSON.stringify(data),
                beforeSend: function() {
                },
                success: function(result) {
                    $('.notion').show();
                    $('.notion').html(`
                        <p class="alert alert-success">${result.message}</p>
                    `);
                    setTimeout(function() {
                        $('.notion').fadeOut('fast');
                    }, 1000);
                    renderClass();
                    
                },
                error: function(msg) {
                    $('#tab-classes .notion').html(
                        '<div class="alert alert-danger">Something went wrong! Please try again!</div>'
                    );
                    $('#tab-classes .notion').hide(2000);
                }
            })
            
        }
        e.preventDefault();
    })
    // get class by id and show form edit class
    $(document).on('click', '.edit_class', function(e) {
        
        // formUpdate.show();
        let id = $(this).attr('data-id');
        let data = (id) ?  { id } : '';
        let urlSingleClass = `http://localhost/php_mvc/backend/apiclasses/single/${id}`;
        $.ajax({
            url: urlSingleClass,
            type: 'GET',
            dataType: "json",
            contentType: "application/json; charset=utf-8",
            data: JSON.stringify(data),
            beforeSend: function() {
                formCreateClass.hide();
            },
            success: function(result) {
                $('#class_code_update').attr('value', result.code);
                $('#class_name_update').attr('value', result.name);
                $('.update_class').attr('data-id', result.id);
                formUpdateClass.show();
            },
            error: function(msg) {
                $('#tab-classes .notion').html(
                    '<div class="alert alert-danger">Something went wrong! Please try again!</div>'
                );
                $('#tab-classes .notion').hide(2000);
            }
        })
    });

    $(document).on('click', '.update_class', function(e) {
        e.preventDefault();
        let id = $(this).attr("data-id");
        let name = $('#class_name_update').val();
        let code = $('#class_code_update').val();
        
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

        let data = (code && name) ?  {
            id,
            code,
            name
        } : '';
        let urlUpdateClass = `http://localhost/php_mvc/backend/apiclasses/update/${id}`;
        $.ajax({
            url: urlUpdateClass,
            type: 'PUT',
            dataType: "json",
            contentType: "application/json; charset=utf-8",
            data: JSON.stringify(data),
            beforeSend: function () {
                return data ? true : false;
            },
            success: function(result) {
                $('.notion').show();
                $('.notion').html(`
                    <p class="alert alert-success">${result.message}</p>
                `);
                $('.notion').hide(2000);
                renderClass();
            },
            error: function(msg) {
                $('#tab-classes .notion').html(
                    '<div class="alert alert-danger">Something went wrong! Please try again!</div>'
                );
                $('#tab-classes .notion').hide(2000);
            },
            complete: function () {
                formUpdate.hide();
                formUpdate[0].reset();
            }
        });
    })
})
