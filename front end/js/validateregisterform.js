function validateForm() {
		
	var firstName = document.forms["register_form"]["firstname"].value;
	var lastName = document.forms["register_form"]["lastname"].value;
	var companyName = document.forms["register_form"]["companyname"].value;
	var address = document.forms["register_form"]["address"].value;
	var city = document.forms["register_form"]["city"].value;
	var postalCode = document.forms["register_form"]["postalcode"].value;
	var phoneNumber = document.forms["register_form"]["phonenumber"].value;
	var phoneExt = document.forms["register_form"]["phone_ext"].value;
	var cellphoneNumber = document.forms["register_form"]["cellphonenumber"].value;
	var email = document.forms["register_form"]["email"].value;
	var username = document.forms["register_form"]["username"].value;
	var password = document.forms["register_form"]["password"].value;
	
	var regex1 = /^[a-zA-Z]+$/;
	var regex2 = /^[^\s][0-9a-zA-Z .]+$/;
	var regex3 = /^[0-9a-zA-Z]+$/;
	var regex4 = /^[ABCEGHJKLMNPRSTVXY]{1}\d{1}[A-Z]{1} *\d{1}[A-Z]{1}\d{1}$/;
	var regex5 = /^([a-zA-Z0-9_.-])+@([a-zA-Z0-9_.-])+\.([a-zA-Z])+([a-zA-Z])+/;
	var regex6 = /^[2-9]\d{2}-\d{3}-\d{4}$/;
	var regex7 = /^[^\s][0-9]+$/;
			
	// First Name
	if(firstName == null || firstName == "")
	{
		alert("First Name must be filled out.");
		return false;
	}
	
	if(! firstName.match(regex1))
	{
		alert("Invalid First Name.");
		return false;
	}
			
	// Last Name
	if(lastName == null || lastName == "")
	{
		alert("Last Name must be filled out.");
		return false;
	}
	
	if(! lastName.match(regex1))
	{
		alert("Invalid Last Name.");
		return false;
	}

	//Company Name

	if(companyName)
	{
		if(! companyName.match(regex2))
		{
			alert("Invalid Company Name.");
			return false;
		}
	}
			
	//Address
	if(address == null || address == "")
	{
		alert("Address must be filled out.");
		return false;
	}
	
	if(! address.match(regex2))
	{
		alert("Invalid Address.");
		return false;
	}
			
	//City
	if(city == null || city == "")
	{
		alert("City must be filled out.");
		return false;
	}
	
	if(! city.match(regex1))
	{
		alert("Invalid City.");
		return false;
	}
			
	//Postal Code
	if(postalCode == null || postalCode == "")
	{
		alert("Postal Code must be filled out.");
		return false;
	}
	
		
	if(! postalCode.match(regex4))
	{
		alert("Invalid Postal Code.");
		return false;
	}
			
	//Phone Number
	if(phoneNumber == null || phoneNumber == "")
	{
		alert("Phone Number must be filled out.");
		return false;
	}
	
	if(! phoneNumber.match(regex6))
	{
		alert("Invalid Phone Number.");
		return false;
	}

	//Phone Ext

	if(phoneExt)
	{
		if(! phoneExt.match(regex7))
		{
			alert("Invalid Phone Ext.");
			return false;
		}
	}

	//Cellphone Number

	if(cellphoneNumber)
	{
		if(! cellphoneNumber.match(regex6))
		{
			alert("Invalid Cellphone Number.");
			return false;
		}
	}
			
	//Email
	if(email == null || email == "")
	{
		alert("Email must be filled out.");
		return false;
	}
	
	if(! email.match(regex5))
	{
		alert("Invalid Email Address.");
		return false;
	}
			
	//Username
	if(username == null || username == "")
	{
		alert("Username must be filled out.");
		return false;
	}
	
		
	if(! username.match(regex3))
	{
		alert("Invalid Username.");
		return false;
	}
			
	//Password
	if(password == null || password == "")
	{
		alert("Password must be filled out.");
		return false;
	}
	
		
	if(! password.match(regex3))
	{
		alert("Invalid Password.");
		return false;
	}
}