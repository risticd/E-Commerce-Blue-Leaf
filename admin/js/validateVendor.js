function validateFormVendor() {
		
	var vendorName = document.forms["vendor_form"]["vend_name"].value;
	var vendorAddress = document.forms["vendor_form"]["vend_address"].value;
	var vendorCity = document.forms["vendor_form"]["vend_city"].value;
	var vendorProv = document.forms["vendor_form"]["vend_province"].value;
	var vendor_postal_code = document.forms["vendor_form"]["vend_postal_code"].value;
	var vendor_phone_number = document.forms["vendor_form"]["vend_phone_number"].value;
	var vendor_email = document.forms["vendor_form"]["vend_email"].value;

	var regex1 = /^[a-zA-Z]+$/;
	var regex2 = /^[^\s][0-9a-zA-Z .]+$/;
	var regex3 = /^[0-9a-zA-Z]+$/;
	var regex4 = /^[ABCEGHJKLMNPRSTVXY]{1}\d{1}[A-Z]{1} *\d{1}[A-Z]{1}\d{1}$/;
	var regex5 = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
	var regex6 = /^[2-9]\d{2}-\d{3}-\d{4}$/;

			
	// Vendor Name
	if(vendorName == null || vendorName == "" || vendorName == "Please enter vendor name")
	{
		alert("Vendor name must be filled out.");
		return false;
	}
	
		
	//Address
	if(vendorAddress == null || vendorAddress == "" || vendorAddress == "ex. 1234 Blue Leaf")
	{
		alert("Address must be filled out.");
		return false;
	}
	
	if(!vendorAddress.match(regex2) )
	{
		alert("Invalid Address");
		return false;
	}
		
	//City
	if(vendorCity == null || vendorCity == "" || vendorCity == "Please enter letters only")
	{
		alert("City must be filled out.");
		return false;
	}
	
	if(!vendorCity.match(regex1))
	{
		alert("Invalid City");
		return false;
	}

	//Province

	if(vendorProv ==  0)
	{
		alert("Please choose a province");
		return false;
	}
	
	//Postal Code
	if(vendor_postal_code == null || vendor_postal_code == "")
	{
		alert("Postal Code must be filled out.");
		return false;
	}
	
		
	if(!vendor_postal_code.match(regex4))
	{
		alert("Invalid Postal Code.");
		return false;
	}
		
	//Phone Number
	if(vendor_phone_number == null || vendor_phone_number == "")
	{
		alert("Phone Number must be filled out.");
		return false;
	}
	
	if(!vendor_phone_number.match(regex6))
	{
		alert("Invalid Phone Number.");
		return false;
	}

	//email

	if(vendor_email == null || vendor_email == "")
	{
		alert("Email must be filled out.");
		return false;
	}

	if(! vendor_email.match(regex5))
	{
		alert("Invalid email address.");
		return false;
	}
	


}