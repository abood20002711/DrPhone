    // show profile menu
    let profileMenu = document.querySelector(".profile-menu");
    let page = document.querySelector(".dashboard");

    function showProfileMenu() {
        if (profileMenu.classList.contains("active")) {
            profileMenu.classList.remove("active");
        } else {
            profileMenu.classList.add("active");
        }
    }

    // show Slidebar menu
    let Menu = document.querySelector(".menu-main");
    let SubMenu;
    Menu.addEventListener("click", e => {
        if (e.target.closest(".has-children")) {
            const hasChild = e.target.closest(".has-children");
            ShowSubMenu(hasChild);
        }

    });

    function ShowSubMenu(hasChild) {
        SubMenu = hasChild.querySelector(".drop-menu");
        SubMenu.classList.toggle("is-active");
    }
    const navbar = document.querySelector(".slidbar");

    function showslidbar() {
        if (navbar.classList.contains("active")) {
            navbar.classList.remove("active");
        } else {
            navbar.classList.add("active");
        }
    }


    // ================= get name of the uploding file =================
                    let input = document.getElementById("uplodeimg");
                    let imageName = document.getElementById("imageName")

                    input.addEventListener("change", () => {
                        let inputImage = document.querySelector("input[type=file]").files[0];

                        imageName.innerText = inputImage.name;
                    })

// ================= get sub Categories into Categories =================
    $(document).ready(function() {
        //when a category is selected, update the subcategory dropdown
        $('#category').change(function() {
            var category_id = $(this).val();
            $.ajax({
                type: 'POST',
                url: 'GetSubCat.php',
                data: {category_id: category_id},
                dataType: 'json',
                success: function(data) {
                    $('#subcategory').empty();
                    
                    $.each(data, function(index, subcategory) {
                        $('#subcategory').append('<option value="'+subcategory.SubCateID+'">'+subcategory.SubCatName+'</option>');
                    });
                },
                error: function() {
                    alert('Error: Could not retrieve subcategories.');
                }
            });
        });
    });


// ================= get  Categories into Main Categories =================

