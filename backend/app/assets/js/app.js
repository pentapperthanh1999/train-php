const toggle = document.querySelector('.toggle-sidebar');
const sidebar = document.querySelector('.sidebar-wrapper');
const content = document.querySelector('.main-content');

function checkHasDropdown() {

}

const navItems = document.querySelector('.navbar-block li').children;
(function showIconDropdown() {
    for (nav of navItems) {
        if (nav.nextElementSibling === null) {
            nav.children[2].classList.add('hidden');
        }
    }
})();
// toggle navigation
toggle.addEventListener('click', (e) => {
    sidebar.classList.toggle('collapse-sidebar');
    toggle.classList.toggle('rotate');
});
//Toggle Menu

$(document).ready(function(){
    // if ($('.navbar li').children().hasClass('dropdown')) {
    //     $(this).children('.dropdown').css('display', 'none');
    // }
    // $('.navbar-block li a').click(function(e){
    //     e.preventDefault();
    //     $(this).children('.dropdown').toggleClass('rotate');
    //     $(this).next('.sub-menu').slideToggle("slow");
    // });
    
    //show action in list data-table
    // $('td.action').click(function(e){
    //     console.log('das')
    //     $('td.action').removeClass('active');
    //     $(this).toggleClass('active')
    // });
    
    $(document).on('click', 'td.action', async function(e){
        $('td.action').removeClass('active');
        e.stopPropagation();
        $(this).addClass('active');
   });
});

function checkDelete(){
    return confirm('Are you sure?');
}


//show info assignment student
$(document).on('click', '.assign-box a', function(e) {
    $('.assign-info').hide();
    let data_code = $(this).attr('data-code');
    let data_type = $(this).attr('data-type');
    let url = `http://localhost/php_mvc/assignments/${data_type}/${data_code}`;
    let boxInfomation = $(this).siblings();
    const arrLocal = localStorage.getItem(data_type) || [];
    var data = [];
    $.ajax({
        url: url,
        type: 'GET',
        dataType: 'json',
        beforeSend: function() {
            if (arrLocal.length === 0) {
                localStorage.setItem(data_type, []);
            } else {
                
            }
        },
        success: function(result) {
            
            if (!localStorage.getItem(data_type).includes(data_code)) {
                localStorage.setItem(data_type, JSON.stringify(data));
            }
            if (data_type == 'getstudent' || data_type == 'getteacher') {
                $('.assign-info .content').html(`
                    <div class="content-block">
                        <h4 class="title">Id:</h4>
                        <span class="code">${result.id}</span>
                    </div>
                    <div class="content-block">
                        <h4 class="title">Code:</h4>
                        <span class="code">${result.code}</span>
                    </div>
                    <div class="content-block">
                        <h4 class="title">Name:</h4>
                        <span class="name">${result.name}</span>
                    </div>
                    <div class="content-block">
                        <h4 class="title">Birthday:</h4>
                        <span class="birthday">${result.birthday}</span>
                    </div>
                    <div class="content-block">
                        <h4 class="title">Gender:</h4>
                        <span class="gender">${result.gender == '0' ? 'male' : 'female'}</span>
                    </div>
                    <div class="content-block">
                        <h4 class="title">Address:</h4>
                        <span class="address">${result.address}</span>
                    </div>
                `);
            } else {
                $('.assign-info .content').html(`
                <div class="content-block">
                    <h4 class="title">Id:</h4>
                    <span class="code">${result.id}</span>
                </div>
                <div class="content-block">
                    <h4 class="title">Code:</h4>
                    <span class="code">${result.code}</span>
                </div>
                <div class="content-block">
                    <h4 class="title">Name:</h4>
                    <span class="name">${result.name}</span>
                </div>
                `);
            }
            boxInfomation.show();
        },
        error: function(msg) {
            console.log(msg);
        },
        complete: function() {
            
        }
    })
    e.preventDefault();
})

$(document).on('mouseout', '.assign-box a', function() {

})