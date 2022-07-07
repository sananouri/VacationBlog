function login() {
    location.href = "../login/login.php";
}

function load_main() {
    location.href = "main/main.php"
}

function go_home() {
    location.href = "../main/main.php"
}

function select_img(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
        $('#pic').attr('src', e.target.result);
        };

        reader.readAsDataURL(input.files[0]);
        document.getElementById('remove-photo-btn').style.display = 'contents';
    }
}

function add_post() {
    location.href = "../add_post/add_post.php";
}

function add_city2() {
    document.getElementById('b1').style.display = 'none';
    document.getElementById('city2').style.display = 'flex';
}

function add_highlight2() {
    document.getElementById('h1').style.display = 'none';
    document.getElementById('highlight2').style.display = 'flex';
}

function add_highlight3() {
    document.getElementById('h2').style.display = 'none';
    document.getElementById('highlight3').style.display = 'flex';
}

function add_city3() {
    document.getElementById('b2').style.display = 'none';
    document.getElementById('city3').style.display = 'flex';
}

function edit_profile() {
    location.href = "../edit_profile/";
}

function remove_photo() {
    document.getElementById('remove-photo-btn').style.display = 'none';
    document.getElementById('remove-photo-btn').style.border = 'solid';
    document.getElementById('pic').src = '';
}

function admin_login() {
    location.href = "../admin_panel/admin_panel.php";
}

function edit() {
    location.href = "../edit/edit.php";
}

function change() {
    var file = document.getElementById("upload_bar");
    file.style.display = 'contents';
    var file = document.getElementById("file");
    var path = file.value.split("\\");
    var file = document.getElementById("file_name").innerHTML = path[path.length - 1];
}

function change1(id) {
    var file = document.getElementById("upload_bar_"+id);
    file.style.display = 'contents';
    var file = document.getElementById("file_"+id);
    var path = file.value.split("\\");
    var file = document.getElementById("file_name_"+id).innerHTML = path[path.length - 1];
}