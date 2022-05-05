<?php
include('./connect.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>VietStar Shipping Website</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
    <link href="./testcase.css" rel="stylesheet" type="text/css">
    <script src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rye&display=swap" rel="stylesheet"> 
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    <script src="js/datatables.js"></script>
    <script src="script.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    .err { background: #ffe6ee; border: 1px solid #b1395f; }
    .emsg { color: #c12020; font-weight: bold; }
    .required { color:red;}
</style> 
<script>
            function doSubmit()
			{
			if (validateName() == false)
				{
				alert("Required data missing!");
				return;
				}
                if (validateNumOfPackage() == false)
				{
				alert("Required data missing!");
				return;
				}
				if (validatePhone() == false)
				{
				alert("Required data missing!");
				return;
				}
				/*if (validateAddress() == false)
				{
				alert("Required data missing!");
				return;
				}
				if (validateCity() == false)
				{
				alert("Required data missing!");
				return;
				}
				if (validateZip() == false)
				{
				alert("Required data missing!");
				return;
				}
				if (validateState() == false)
				{
				alert("Required data missing!");
				return;
				}*/
                if (validaterecName() == false)
				{
				alert("Required data missing");
				return;
				}
			    if (validaterecAddress() == false)
				{
				alert("Required data missing");
				return;
				}
                if (validaterecPhone() == false)
				{
				alert("Required data missing");
				return;
				}
                if (validateITEM() == false)
				{
				alert("Required data missing");
				return;
				}
                if (validateSendto() == false)
				{
				alert("Required data missing");
				return;
				}else
				    //alert("Your Form has been submitted. You can now take your items to the store.");
                    var modalToggle = document.getElementById('MyModal') // relatedTarget
                        myModal.show(modalToggle)   
				    return;
				}
			function validateName()
			{
				var name = document.shippingForm_BE.full_name.value;
				if (name.length == 0) return false;
				return true;
			}
            function validateNumOfPackage()
			{
				var package = document.shippingForm_BE.num_of_package.value;
				if (package.length == 0) return false;
				return true;
			}
			function validatePhone()
			{
				var phone = document.shippingForm_BE.phone.value;
				if (phone.length == 0) return false;
				return true;
			}
			
			function validateAddress()
			{
				var address1 = document.shippingForm_BE.address1.value;
				if (address1.length == 0) return false;
				return true;
			}
			function validateCity()
			{
				var city = document.shippingForm_BE.city.value;
				if (city.length == 0) return false;
				return true;
			}
			function validateZip()
			{
				var zip = document.shippingForm_BE.zip_code.value;
				if (zip.length == 0) return false;
				return true;
			}
			function validateState()
			{
				var state = document.shippingForm_BE.state.value;
				if (state.length == 0) return false;
				return true;
			}
            function validaterecName()
			{
				var recName = document.shippingForm_BE.full_name_r.value;
				if (mail.length == 0) return false;
				return true;
			}
            function validaterecAddress()
			{
				var recAdress = document.shippingForm_BE.address_r1.value;
				if (recAddress.length == 0) return false;
				return true;
			}
            function validaterecPhone()
			{
				var recPhone = document.shippingForm_BE.phone_r.value;
				if (recPhone.length == 0) return false;
				return true;
			}
            function validateITEM()
			{
				var itemDesc = document.shippingForm_BE.pkg1.value;
				if (itemDesc.length == 0) return false;
				return true;
			}
            function validateSendto()
			{
				var sendTo = document.shippingForm_BE.location.value;
				if (sendTo.length == 0) return false;
				return true;
			}
			</script>
            <script type="text/javascript"> 
            function showmyModal() {

                    $('#MyModal').modal('show');
                    }</script>

</head>

<body>
    <nav class="navbar1  p-md-1 navbar-style navbar-topbar navbar-expand-lg  navbar-dark text-light">
        <div class="container">
            <ul class="navbar-nav">
                <li class="nav-item">
                    
                </li>
               
            </ul>
            <h6 style="text-align: center;"> Shipping service to Vietnam</h6>
        </div>
    </nav>
    <!--Navbar starts here-->
    
    <div id="header" class="p-md-4">
        
        
        <h1>VIETSTAR SHIPPING & TRAVEL</h1>
    </div>

    <!--Navigation Bar Starts-->
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-0 rounded sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="./Assets/redLogo.PNG" alt="Avatar Logo"
                        style="width:40px;" class="rounded-pill">
            </a>
            <a class="navbar-brand" href="./index.html">
                <img src="./Assets/logo/VIETSTAR.png" width="150" height="40" class="d-inline-block align-top" alt="Logo">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="./index.html">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Shipping
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="./shipping.php">Shipping Form</a></li>
                            <li><a class="dropdown-item" href="./customFees.html">Custom Fees</a></li>
                            <li><a class="dropdown-item" href="./trackPage.html">Track Shipment</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown2" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            About Us
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="./aboutus.html">Our Mission</a></li>
                            <li><a class="dropdown-item" href="./faq.html">FAQ</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="./hotItems.html">Hot Items</a></li>
                        </ul>
                    </li> 
                </ul>
                <ul class="navbar-nav">
                <li class="nav-item justify-content-end">
                    <a class="nav-link colors" href="./contactUs.html">Contact us</a></li>
                </ul>
            </div>
        </div>
    </nav>
    
    <!--Navigation Bar ends-->

    <!-- Carousel start-->
        <div id="carousel" class="carousel slide py-3" data-bs-ride="carousel">
            <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            </div>
            <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="./Assets/shipping.jpg" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                <h1 id="services">Shipping Form</h1>
                <h3>Please fill out the form below.</h3>
                </div>
            </div>
            </div>
        </div>
<!--Carousal ends-->

   
    <div class="container mt-5">
        <form name= "shippingForm_BE" action="shippingForm_BE.php" method="POST" data-toggle="modal" class="row g-5 "> 

            <div class="col-md-6" id="sender_border">
                <!-- Sender's information -->

                <h3 class="colors">Sender's Information</h3> </br></br>
                
                <div class="row">

                    <div class="col-md-6">
                        <label for="full_name" class="form-label">Full Name<span class="required">*</span></label>
                        <input type="text" class="form-control" id="full_name" name="full_name" tabindex="1" required>
                        <div id="emsg_first_name" class="emsg_first_name"></div>
                    </div>
                    
                    
                    <div class="col-md-12">
                        <label for="address1" class="form-label">Address</label>
                        <input type="text" class="form-control" id="address1" name="address1" placeholder="Street., Apt., MailboxBox#, etc." tabindex="2">
                    </div>
                    <div class="col-md-4">
                        <label for="city" class="form-label">City</label>
                        <input type="text" class="form-control" id="city" name="city" placeholder="City" tabindex="3">
                        <div id="emsg_city" class="emsg_city"></div>
                    </div>
                    <div class="col-md-4">
                        <label for="zip_code" class="form-label">Zip Code</label>
                        <input type="text" class="form-control" id="zip_code" name="zip_code" placeholder="Zip Code" tabindex="4" minlength="5" maxlength="10">
                        <div id="emsg_zip_code" class="emsg_zip_code"></div>
                    </div>
                    <div class="col-md-4">
                        <label for="state" class="form-label">State</label>
                        <select name="state" id="options" tabindex="7">
                            <option value=""></option>
                            <option value="AL">Alabama</option>
                            <option value="AK">Alaska</option>
                            <option value="AZ">Arizona</option>
                            <option value="AR">Arkansas</option>
                            <option value="CA">California</option>
                            <option value="CO">Colorado</option>
                            <option value="CT">Connecticut</option>
                            <option value="DE">Delaware</option>
                            <option value="DC">District Of Columbia</option>
                            <option value="FL">Florida</option>
                            <option value="GA">Georgia</option>
                            <option value="HI">Hawaii</option>
                            <option value="ID">Idaho</option>
                            <option value="IL">Illinois</option>
                            <option value="IN">Indiana</option>
                            <option value="IA">Iowa</option>
                            <option value="KS">Kansas</option>
                            <option value="KY">Kentucky</option>
                            <option value="LA">Louisiana</option>
                            <option value="ME">Maine</option>
                            <option value="MD">Maryland</option>
                            <option value="MA">Massachusetts</option>
                            <option value="MI">Michigan</option>
                            <option value="MN">Minnesota</option>
                            <option value="MS">Mississippi</option>
                            <option value="MO">Missouri</option>
                            <option value="MT">Montana</option>
                            <option value="NE">Nebraska</option>
                            <option value="NV">Nevada</option>
                            <option value="NH">New Hampshire</option>
                            <option value="NJ">New Jersey</option>
                            <option value="NM">New Mexico</option>
                            <option value="NY">New York</option>
                            <option value="NC">North Carolina</option>
                            <option value="ND">North Dakota</option>
                            <option value="OH">Ohio</option>
                            <option value="OK">Oklahoma</option>
                            <option value="OR">Oregon</option>
                            <option value="PA">Pennsylvania</option>
                            <option value="RI">Rhode Island</option>
                            <option value="SC">South Carolina</option>
                            <option value="SD">South Dakota</option>
                            <option value="TN">Tennessee</option>
                            <option value="TX">Texas</option>
                            <option value="UT">Utah</option>
                            <option value="VT">Vermont</option>
                            <option value="VA">Virginia</option>
                            <option value="WA">Washington</option>
                            <option value="WV">West Virginia</option>
                            <option value="WI">Wisconsin</option>
                            <option value="WY">Wyoming</option>
                        </select>
                        <div id="emsg_state" class="emsg_state"></div>
                    </div>
                    <div class="col-md-8">
                        <label for="email" class="form-label">Email (optional)</label>
                        <input type="email" class="form-control" id="email" name="email" tabindex="5" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$">
                        <div id="emsg_email" class="emsg_email"></div>
                    </div>
                    <div class="col-md-4">
                        <label for="phone" class="form-label">Phone No. (ex: 5712342345)<span class="required">*</span></label>
                        <input type="tel"class="form-control" id="phone" name="phone" tabindex="6" required length="10" pattern="[0-9]{10}">
                        <div id="emsg_phone" class="emsg_phone"></div>
                    </div>
                    
                </div>
            </div>

            <div class="col-md-6">
                <!-- Recipient's information -->
                
                <h3 class="colors">Recipient's Information</h3> </br></br>

                <div class="row">

                    <div class="col-md-6">
                        <label for="full_name_r" class="form-label">Full Name<span class="required">*</span></label>
                        <input type="text" class="form-control" id="full_name_r" name="full_name_r" tabindex="7" required>
                        <div id="emsg_first_name_r" class="emsg_first_name_r"></div>
                    </div>
                    <div class="col-md-12">
                        <label for="address_r1" class="form-label">Address<span class="required">*</span></label>
                        <textarea class="form-control" rows="6" cols="50" id="address_r1" name="address_r1" placeholder="Recipient Address" tabindex="8" required></textarea>
                        <div id="emsg_address_r1" class="emsg_address_r1"></div>
                    </div>
                    <div class="col-md-8">
                        <label for="email_r" class="form-label">Email (optional)</label>
                        <input type="text" class="form-control" id="email_r" name="email_r" tabindex="9" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$">
                    </div>
                    <div class="col-md-4">
                        <label for="phone_r" class="form-label">Phone No.<span class="required">*</span></label>
                        <input type="text" class="form-control" id="phone_r" name="phone_r" tabindex="10" required>
                    </div>
                    
                </div>
            </div>

            <div class="col-md-12" id="item_desc_area">
                <!-- Item description field -->
                
                </br></br> <h3 class="colors">Item Descriptions</h3> </br></br>

                <div class="row">
                <div class="col-md-6">
                        <label for="num_of_package" class="form-label">Number of Package<span class="required">*</span></label>
                        <input type="number" class="form-control" id="num_of_package" name="num_of_package" placeholder="" tabindex="11" required>
                        <div id="emsg_last_name" class="emsg_last_name"></div>
                    </div>
                    <div class="col-md-9">
                        <label for="pkg1" class="form-label">Items in Package<span class="required">*</span></label>
                        <textarea class="form-control" rows="6" cols="50"  id="pkg1" name="pkg1" placeholder="Item Descriptions" tabindex="12"required></textarea>
                    </div>
                    <div class="col-md-3">
                        <label for="package_value" class="form-label">Package Item Value</label>
                        <input type="number" class="form-control" id="package_value" name="package_value" placeholder="Optional" tabindex="13" >
                        <div id="emsg_address1" class="emsg_address1"></div>
                    </div>
                    <!--<div class="col-md-3">
                        <label for="pkg1_weight" class="form-label">Weight (lbs)</label>
                        <input type="text" class="form-control" id="pkg1_weight" name="pkg1_weight" placeholder="Optional" tabindex="14" ></input>
                    </div>-->
                    <div class="col-md-2">
                        <label for="location" class="form-label">Send To<span class="required">*</span></label>
                        <!--<select class="form-select" name="location" id="location" placeholder="Location"tabindex="15" required>
                            <option selected=""></option>
                            <option value="Sài Gòn">Sài Gòn</option>
                            <option value="Tỉnh (Province)">Tỉnh</option>
                        </select>-->
                        <input type="text"  name="location" list="location" value="<?=$tmp[0]['location']?>" required/>
                        <datalist id="location">
                            <option value="Sài Gòn (Saigon)" name="SG">Sài Gòn (Saigon)</option>
                            <option value="Tỉnh (Province)" name="province">Tỉnh (Province)</option>
                        </datalist>
                        <div id="emsg_state" class="emsg_state"></div>
                    </div>
                </div>
                <div class="form_buttons">
                    <button class="btn btn-danger" id="reset_button" type="reset">Reset</button>
                    <button class="btn btn-primary" id="submit_button" type="submit" onClick="doSubmit(); showmyModal()">Submit Shipping Form</button>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="MyModal" tabindex="-1" aria-labelledby="modal_label" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modal_label">Thank You!</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">You have successfully submitted your shipping form</div>
                            <div class="modal-footer">
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </form>

    </div>

    <!-- Footer -->

 
    <div id="google-element"></div>
        <script src="http://translate.google.com/translate_a/element.js?cb=loadGoogleTranslate"
            style="color: #474747;"></script>
        <script>
            function loadGoogleTranslate() {
                new google.translate.TranslateElement("google_element");
            }
        </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <Script>
        $("#click-me").click(function () {
            $("#show").toggle("slow", function () {
            });
        });

        $(".x").click(function () {
            $(".container").toggle("slow", function () {
                // Animation complete.  
            });
        });
    </Script>
<footer class="footer-long">
    <div class="mt-5 p-lg-5 text-black-50 text-center container-fluid">
    <div class="row">
            
        <!--end of col-->
        <div class="col-12 col-lg-3">
            <img src="./Assets/logo/VIETSTAR.png" alt="logo">
            <hr class="light">

        </div>
        <div class="col-12 col-md-9">
            <div class="row no-gutters">
                <div class="col-6 col-lg-3">
                    <h6>Navigate</h6>
                    <hr class="light">
                    <ul class="list-unstyled">
                        <li>
                            <a href="./index.html">Home</a>
                        </li>
                        <li>
                            <a href="./shipping.php">Shipping form</a>
                        </li>
                        <li>
                            <a href="./customFees.html">Customs fees</a>
                        </li>
                        <li>
                            <a href="./Assets/Reimbersement.pdf">Reimbursement Policy</a>
                        </li>
                    </ul>
                </div>
                <!--end of col-->

                <!--end of col-->
                <div class="col-6 col-lg-3">
                    <h6>Need help?</h6>
                    <hr class="light">
                    <ul class="list-unstyled">
                        
                        <li>
                            <a href="./trackPage.html">Track Shipment</a>
                        </li>
                        <li>
                            <a href="./faq.html">FAQ</a>
                        </li>
                        <li>
                            <a href="./contactUs.html">Contact</a>
                        </li>
                    </ul>
                </div>
                <!--end of col-->
                <div class="col-6 col-lg-3">
                    <h6>Company</h6>
                    <hr class="light">
                    <ul class="list-unstyled">
                        <li>
                            <a href="./aboutus.html">About company</a>
                        </li>
                        <li>
                            <a href="./aboutus.html">History</a>
                        </li>
                        <li>
                            <a href="./aboutus.html">Team</a>
                        </li>
                        <li>
                            <a href="./contactUs.html">Location</a>
                        </li>
                    </ul>
                </div>
                <!--end of col-->
                <div class="col-6 col-lg-3">
                    <ul class="list-unstyled social">
                        <li>
                            <a href="https://www.facebook.com/Vietstar-Shipping-Eden-Center-100594958786649/"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
                                <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"/>
                              </svg></a>
                            
                              <br>
                        </li>
                    </ul>  
                    <hr class="light">
                    <h6>Translate</h6>
                    <hr class="light">
                    <ul class="list-unstyled">
                        <li>
                            <div style="position: relative;">
                                <div id="google_element" style="position: relative; opacity: 100; color: black;"></div>
                               <!--<button id="translate" class="btn btn-secondary dropdown-toggle"
                                    style="position: absolute; left: 0; top: 0; z-index: -1; color: black;"></button>--> 
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <!--end of row-->
        </div>
        <!--end of col-->
        <hr class="my-4">
    </div>
   
        <div class="row">
            
            <div id="Register" class="col-md-6">
                <p>Copyright &copy; 2022 VIETSTAR SHIPPING</p>
            </div>
            <div class="col-md-6 text-md-end">
                <a href="./Assets/Reimbersement.pdf" class="text-light">Reimbursement Process</a>
                <span class="text-muted mx-2">|</span>
                <a href="./Assets/shippingpolicy.pdf" class="text-light">Shipping
                    Policy</a>
            </div>
        </div>
    </div>
</footer>
</body>
</html>
