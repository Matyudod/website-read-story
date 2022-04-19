<header class="container bg-dark text-white d-flex justify-content-center position-relative">
    <div class="d-flex justify-content-center p-3" style="width:100%">
        <div class="flex-grow-2 d-flex justify-content-center align-items-center" style="width: 20%;">
            <a href="/" class="w-100">
                <img src="/imgs/logo.png" class="h-100 w-100" alt="logo animehay">
            </a>
        </div>
        <div class="flex-grow-1 mx-4">
            <form class="d-flex" style="width:100%">
                <input type="text" placeholder="Nhập từ khoá..." class="p-2 flex-grow-1 bg-black text-gray"
                    name="keyword">
                <button type="submit" class="p-2 bg-black btn btn-dark">
                    <i class="fa fa-search"></i>
                </button>
            </form>
        </div>
        <div class=" flex-grow-2">
            <a href="#" onclick="clickEventDropDown(this,'reorder')"
                class="toggle-dropdown p-2 px-3 h3  bg-black btn btn-dark" bind="drop" title="Thể loại">
                <i class="fas fa-bars"></i>
            </a>

            <a href="/dang-nhap" class="p-2 px-3 h3  bg-black btn btn-dark" title="Đăng nhập Admin">
                <i class="fas fa-sign-in-alt"></i>
            </a>
        </div>
    </div>
    <div id="drop" class="menu-category bg-black">
        <div class="d-flex flex-wrap">
            <a href="#" class="bg-danger" style="color:aliceblue">Thể loại</a>
        </div>
        <div class="d-flex flex-wrap">
            <?php foreach ($categories as $ca) { ?>
            <a href="/the-loai/<?= $ca->category_slug ?>"><?= $ca->category_name ?></a>
            <?php } ?>
        </div>
    </div>
    <style>
    .menu-category {
        position: absolute;
        top: 100%;
        z-index: 12;
        display: none;
        transform: scale(.5);
        transition: transform .1s cubic-bezier(.1, 1, 1, 1);
    }

    #drop a {
        width: 20%;
        text-align: center;
        padding: 10px;
        box-sizing: border-box;
        border: 1px solid #141414;
        background: #000;
        color: #cac9c9;
    }

    #drop a:hover {

        color: white;
    }
    </style>
    <script>
    function clickEventDropDown(dropdown) {
        var _name = dropdown.getAttribute("bind");
        var _dropdown_menu = document.getElementById(_name);
        if (!_dropdown_menu.style.display || _dropdown_menu.style.display === "none") {
            dropdown.style.backgroundColor = "#ab3e3e";
            _dropdown_menu.style.display = "block";
            setTimeout(function() {
                _dropdown_menu.style.transform = "scale(1)";
            }, 50)
        } else {
            _dropdown_menu.style = null;
            dropdown.style = null;
        }
    }
    </script>
</header>