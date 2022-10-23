//this is getting the page and then add classlist active 
// so that i can change the background color of the current nav element and let the user know about the current page
// refer to the given link
// programmerprogrammer 4, Daniel ArandaDaniel Aranda 6, HugolpzHugolpz 16.4k2626 gold badges9292 silver badges184184 bronze badges, GIPSSTARGIPSSTAR 1, DarrenDarren 67.3k2424 gold badges134134 silver badges143143 bronze badges, EthanEthan 3, NaftaliNaftali 143k3939 gold badges240240 silver badges300300 bronze badges, Ali JamalAli Jamal 1, rebelzachrebelzach 2, Marco ConcasMarco Concas 1, Igor BeuermannIgor Beuermann 11311 silver badge99 bronze badges, &amp; DemnofocusDemnofocus 2166 bronze badges. (1960, August 1). How can I get the name of an HTML page in Javascript? Stack Overflow. Retrieved October 22, 2022, from https://stackoverflow.com/questions/16611497/how-can-i-get-the-name-of-an-html-page-in-javascript 
if(window.location.href.split("/").pop() != "login.php")
{
    if(window.location.href.split("/").pop() == "index.php"){
        document.getElementById("active").classList.add("active");
    }
    else if(window.location.href.split("/").pop() == "status_of_order.php"){
        document.getElementById("active2").classList.add("active");
    }
    else{
        document.getElementById("active3").classList.add("active");
    }
}

// mobile version of the navigation
// this is refer to my own website 
// Pranav Mahindru. Pranav Mahinrdru. (n.d.). Retrieved October 22, 2022, from http://web.cs.dal.ca/~mahindru/ 
function open_close_nav() 
{
    var getelement = document.getElementById("shownav");
    if (getelement.style.display === "block") {
        getelement.style.display = "none";
    } 
    else {
        getelement.style.display = "block";
    }
}

// add part in the user_select_Part022 table and also update the part table
function add(part_id, part_quantity, clientID, count)
{
    // ajax is refer to the given link 
    // Kezo. (2021, August 27). How to pass form data from javascript to PHP. WEB Creator's Room. Retrieved October 22, 2022, from https://arts-factory.net/en/javascriptphp/ 
    $.ajax({
        type: "POST",
        url: "PHP_URL/AddToUserSelectPart.php",
        data: {part_id: part_id, part_quantity: part_quantity, clientID: clientID, count: count},
        success: function(){
            window.location.reload();
        },
        error: function(){
            alert("Failed to add Part\nPlease try again.");
        }
    })
}

// sub part in the user_select_Part022 table and also update the part table
function sub(part_id, part_quantity, clientID, count)
{
    // ajax is refer to the given link 
    // Kezo. (2021, August 27). How to pass form data from javascript to PHP. WEB Creator's Room. Retrieved October 22, 2022, from https://arts-factory.net/en/javascriptphp/ 
    $.ajax({
        type: "POST",
        url: "PHP_URL/SubToUserSelectPart.php",
        data: {part_id: part_id, part_quantity: part_quantity, clientID: clientID, count: count},
        success: function(){
            window.location.reload();
        },
        error: function(){
            alert("Failed to add Part\nPlease try again.");
        }
    })
}

// checkout when user want to
function checkout(total_count_parts, clientID)
{
    if(total_count_parts > 0)
    {
        // ajax is refer to the given link 
        // Kezo. (2021, August 27). How to pass form data from javascript to PHP. WEB Creator's Room. Retrieved October 22, 2022, from https://arts-factory.net/en/javascriptphp/ 
        $.ajax({
            type: "POST",
            url: "PHP_URL/Checkout.php",
            data: {clientID: clientID},
            success: function(data){
                var obj = JSON.parse(data);
                // Login form. Login Form - SweetAlert2 example. (n.d.). Retrieved October 22, 2022, from https://sweetalert2.github.io/recipe-gallery/login-form.html 
                Swal.fire({
                    title: "Do you want to Checkout",
                    html: obj.html_text,
                    confirmButtonText: "Checkout",
                    showCancelButton: true,
                    cancelButtonColor: 'rgb(2, 93, 163)',
                    confirmButtonColor: 'rgb(2, 93, 163)',
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire("Checkout<br>You Can see the Order No on the Status Page","","success")
                        window.setTimeout(function(){
                           $.ajax({
                            type: "POST",
                            url: "PHP_URL/AddPOsUpdateLine.php",
                            data: {obj_array: obj.checkout_array},
                            success: function(data){
                                window.location.href = "status_of_order.php";
                            },
                            error: function(){
                                alert("Failed to add Part\nPlease try again.");
                            }
                        })
                       }, 1500)
                    }
                })
            },
            error: function(){
                alert("Failed to Checkout\nPlease try again.");
            }
        })
    }
    else
    {
        Swal.fire({
            title: "<h3> NO ITEMS IN THE CHECKOUT </h3>",
            showConfirmButton: false,
            timer: 1000
        })
    }
}

// add client form and client to the db 
function addClient()
{
    // create form is refer to the given link
    // Login form. Login Form - SweetAlert2 example. (n.d.). Retrieved October 22, 2022, from https://sweetalert2.github.io/recipe-gallery/login-form.html 
    Swal.fire({
        title: "Add Account",
        html: `
        <input type="text" id="name" class="swal2-input" placeholder="First Name" required/>
        <input type="text" id="city" class="swal2-input" placeholder="City" required/>
        <input type="password" id="pass" class="swal2-input" placeholder="Password" required/>
        <input type="number" id="dollaronorder" class="swal2-input" placeholder="Dollar On Order" required/>
        `,
        showCancelButton: true,
        confirmButtonText: "Add Account",
        cancelButtonColor: 'rgb(2, 93, 163)',
        confirmButtonColor: 'rgb(2, 93, 163)',
        focusConfirm: false,
        preConfirm: () =>
        {
            const name = Swal.getPopup().querySelector("#name").value
            const city = Swal.getPopup().querySelector("#city").value
            const pass = Swal.getPopup().querySelector("#pass").value
            const dollaronorder = Swal.getPopup().querySelector("#dollaronorder").value
            if (!name || !city || !pass || !dollaronorder) 
            {
                Swal.showValidationMessage('Please enter the all fields')
            }
            return {name: name, city: city, pass: pass, dollaronorder: dollaronorder}
        }
    }).then((result) => {
        // ajax is refer to the given link 
        // Kezo. (2021, August 27). How to pass form data from javascript to PHP. WEB Creator's Room. Retrieved October 22, 2022, from https://arts-factory.net/en/javascriptphp/ 
        $.ajax({
            type: "POST",
            url: "PHP_URL/AddtoClient.php",
            data: {name: result.value.name, city: result.value.city, pass: result.value.pass, dollaronorder: result.value.dollaronorder},
            success: function(data){
                alert(data);
                window.location.reload();
            },
            error: function(){
                alert("Failed to make account\nPlease try again.");
            }
        })
    })
}